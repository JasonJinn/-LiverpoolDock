<?php
error_reporting(E_ALL);
set_time_limit(0);// set time out
date_default_timezone_set('Etc/GMT');
include_once '../DAO/Database.php';

class WebSocket {
    const LOG_PATH = '/';
    const LISTEN_SOCKET_NUM = 1000;                                             //socket pool

    /**
     * @var array $sockets
     *    [
     *      (int)$socket => [
     *                        info
     *                      ]
     *      ]
     */
    private $sockets = [];
    private $nameHash = array();
    private $master;
    private $dao;

    public function __construct($host, $port) {
        try {
            $this->master = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
            // set port
            socket_set_option($this->master, SOL_SOCKET, SO_REUSEADDR, 1);
            // bind socket
            socket_bind($this->master, $host, $port);

            socket_listen($this->master, self::LISTEN_SOCKET_NUM);
            $this->dao = getQuery("message");
        } catch (\Exception $e) {
            $err_code = socket_last_error();
            $err_msg = socket_strerror($err_code);

            $this->error([
                'error_init_server',
                $err_code,
                $err_msg
            ]);
        }

        $this->sockets[0] = ['resource' => $this->master];
        $pid = posix_getpid();
        $this->debug(["server: {$this->master} started,pid: {$pid}"]);

        while (true) {
            try {
                $this->doServer();
            } catch (\Exception $e) {
                $this->error([
                    'error_do_server',
                    $e->getCode(),
                    $e->getMessage()
                ]);
            }
        }
    }

    private function doServer() {
        $write = $except = NULL;
        $sockets = array_column($this->sockets, 'resource');
        $read_num = socket_select($sockets, $write, $except, NULL);
        //echo $read_num;
        //print_r($sockets);

        // listen function
        if (false === $read_num) {
            $this->error([
                'error_select',
                $err_code = socket_last_error(),
                socket_strerror($err_code)
            ]);
            return;
        }

        foreach ($sockets as $socket) {
            // if the socket is main socket
            if ($socket == $this->master) {
                $client = socket_accept($this->master);
                print_r($client);
                // accept a new socket
                if (false === $client) {
                    $this->error([
                        'err_accept',
                        $err_code = socket_last_error(),
                        socket_strerror($err_code)
                    ]);
                    continue;
                } else {
                  print_r($client);
                    self::connect($client);         //
                    continue;
                }
            } else {
                $bytes = @socket_recv($socket, $buffer, 2048, 0);
                if ($bytes < 9) {
                    $recv_msg = $this->disconnect($socket);
                } else {
                    if (!$this->sockets[(int)$socket]['handshake']) {
                        self::handShake($socket, $buffer);
                        continue;
                    } else {
                        $recv_msg = self::parse($buffer);
                        //print_r($recv_msg);
                    }
                }
                array_unshift($recv_msg, 'receive_msg');
                $msg = self::dealMsg($socket, $recv_msg);

                print_r($msg);
                if(isset($msg))
                    $this->broadcast($msg);
            }
        }
    }

    /**
     * add socket into pool
     *
     * @param $socket
     */
    public function connect($socket) {
        socket_getpeername($socket, $ip, $port);
        $socket_info = [
            'resource' => $socket,
            'uname' => '',
            'handshake' => false,
            'ip' => $ip,
            'port' => $port,
        ];
        $this->sockets[(int)$socket] = $socket_info;
        $this->debug(array_merge(['socket_connect'], $socket_info));
    }

    /**
     * close the connection
     *
     * @param $socket
     *
     * @return array
     */
    private function disconnect($socket) {
        $recv_msg = [
            'type' => 'logout',
            'content' => $this->sockets[(int)$socket]['uname'],
        ];
        unset($this->sockets[(int)$socket]);

        return $recv_msg;
    }

    /**
     * use public handshake algorithm
     *
     * @param $socket
     * @param $buffer
     *
     * @return bool
     */
    public function handShake($socket, $buffer) {
        // get the key of client
        $line_with_key = substr($buffer, strpos($buffer, 'Sec-WebSocket-Key:') + 18);
        $key = trim(substr($line_with_key, 0, strpos($line_with_key, "\r\n")));

        // upgrade key
        $upgrade_key = base64_encode(sha1($key . "258EAFA5-E914-47DA-95CA-C5AB0DC85B11", true));// upgrade key algorithm
        $upgrade_message = "HTTP/1.1 101 Switching Protocols\r\n";
        $upgrade_message .= "Upgrade: websocket\r\n";
        $upgrade_message .= "Sec-WebSocket-Version: 13\r\n";
        $upgrade_message .= "Connection: Upgrade\r\n";
        $upgrade_message .= "Sec-WebSocket-Accept:" . $upgrade_key . "\r\n\r\n";

        socket_write($socket, $upgrade_message, strlen($upgrade_message));// write info
        $this->sockets[(int)$socket]['handshake'] = true;

        socket_getpeername($socket, $ip, $port);
        $this->debug([
            'hand_shake',
            $socket,
            $ip,
            $port
        ]);

        // send successful
        $msg = [
            'type' => 'handshake',
            'content' => 'done',
        ];
        $msg = $this->build(json_encode($msg));
        socket_write($socket, $msg, strlen($msg));
        return true;
    }

    /**
     * parse information
     *
     * @param $buffer
     *
     * @return bool|string
     */
    private function parse($buffer) {
        $decoded = '';
        $len = ord($buffer[1]) & 127;
        if ($len === 126) {
            $masks = substr($buffer, 4, 4);
            $data = substr($buffer, 8);
        } else if ($len === 127) {
            $masks = substr($buffer, 10, 4);
            $data = substr($buffer, 14);
        } else {
            $masks = substr($buffer, 2, 4);
            $data = substr($buffer, 6);
        }
        for ($index = 0; $index < strlen($data); $index++) {
            $decoded .= $data[$index] ^ $masks[$index % 4];
        }

        return json_decode($decoded, true);
    }

    /**
     * break message into websocket frame
     *
     * @param $msg
     *
     * @return string
     */
    private function build($msg) {
        $frame = [];
        $frame[0] = '81';
        $len = strlen($msg);
        if ($len < 126) {
            $frame[1] = $len < 16 ? '0' . dechex($len) : dechex($len);
        } else if ($len < 65025) {
            $s = dechex($len);
            $frame[1] = '7e' . str_repeat('0', 4 - strlen($s)) . $s;
        } else {
            $s = dechex($len);
            $frame[1] = '7f' . str_repeat('0', 16 - strlen($s)) . $s;
        }

        $data = '';
        $l = strlen($msg);
        for ($i = 0; $i < $l; $i++) {
            $data .= dechex(ord($msg{$i}));
        }
        $frame[2] = $data;

        $data = implode('', $frame);

        return pack("H*", $data);
    }

    /**
     * make up message
     *
     * @param $socket
     * @param $recv_msg
     *          [
     *          'type'=>user/login
     *          'content'=>content
     *          ]
     *
     * @return string
     */
    private function dealMsg($socket, $recv_msg) {
        $msg_type = $recv_msg['type'];
        $msg_content = $recv_msg['content'];
        $msg_to = $recv_msg['to'];
        $isToUser = false;
        $response = [];

        switch ($msg_type) {
            case 'login':
                $this->sockets[(int)$socket]['uname'] = $msg_content;
                $this->nameHash[$msg_content] = (int)$socket;
                // get the newest name
                $user_list = array_column($this->sockets, 'uname');
                $response['type'] = 'login';
                $response['content'] = $msg_content;
                $response['user_list'] = $user_list;
                break;
            case 'logout':
                $user_list = array_column($this->sockets, 'uname');
                unset($this->nameHash[$msg_content]);
                //print_r($recv_msg);
                $response['type'] = 'logout';
                $response['content'] = $msg_content;
                $response['user_list'] = $user_list;
                break;
            case 'user':
                $uname = $this->sockets[(int)$socket]['uname'];
                $response['type'] = 'user';
                $response['from'] = $uname;
                $response['content'] = $msg_content;
                $response['to'] = $msg_to;
                $data = $this->build(json_encode($response));
                $isToUser = true;
                $dates = date("Y/m/d H:i:s", time());
                $cnt = $this->dao->insert(array("from_user"=>$uname, "to_user"=>$msg_to,
                    "content"=>$msg_content,"time"=>$dates,"isRead"=>0));
                //echo "cnt:$cnt"."<br/>";
                break;
        }
        $data = $this->build(json_encode($response));
        if($msg_type == 'user')
        {
            if(isset($this->nameHash[$msg_to]))
            {
                socket_write($this->sockets[$this->nameHash[$msg_to]]['resource'],$data,strlen($data));
                $cnt2 = $this->dao->update(array("isRead"=>1),array("mid"=>$cnt));
            }
            socket_write($this->sockets[$this->nameHash[$uname]]['resource'],$data,strlen($data));
        }
        return $isToUser?null:$data;
    }

    /**
     * broadcast
     *
     * @param $data
     */
    private function broadcast($data) {
        foreach ($this->sockets as $socket) {
            if ($socket['resource'] == $this->master) {
                continue;
            }
            socket_write($socket['resource'], $data, strlen($data));
        }
    }

    /**
     * record debug
     *
     * @param array $info
     */
    private function debug(array $info) {
        $time = date('Y-m-d H:i:s');
        array_unshift($info, $time);

        $info = array_map('json_encode', $info);
        file_put_contents(self::LOG_PATH . 'websocket_debug.log', implode(' | ', $info) . "\r\n", FILE_APPEND);
    }

    /**
     * record error
     *
     * @param array $info
     */
    private function error(array $info) {
        $time = date('Y-m-d H:i:s');
        array_unshift($info, $time);

        $info = array_map('json_encode', $info);
        file_put_contents(self::LOG_PATH . 'websocket_error.log', implode(' | ', $info) . "\r\n", FILE_APPEND);
    }
}

$ws = new WebSocket("0.0.0.0", "8080");
