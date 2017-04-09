<?php

/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 2017/4/3
 * Time: 下午8:53
 */
class Database
{
    private $_table = null;
    private $_con = null;

    public function Database(){
        if($this->con == null) {
            $this->_con = new mysqli("localhost", "root", "password", "dock");

            if ($this->_con == FALSE) {
                echo("Database connection failed");
                $this->_con = null;
                return;
            }
        }
    }

    public function table($tbname){
        $this->_table = $tbname;
        return $this;
    }

    public function query($sql){
        $result = $this->_con->query($sql);
        $ret = array();
        //echo $sql;
        if($result){
            while($row = mysqli_fetch_array($result)){
                $ret[] = $row;
                //print_r(array_values($row));
            }
        }
        //print_r(array_values($ret));
        return $ret;
    }
    //unfinished
    public function get($where = null){
        $sql = "select * from ".$this->_table;
        $sql = $sql.$this->_getWhereString($where);
        //echo $sql;
        return $this->query($sql);
    }

    public function insert($params) {
        if ($params == null || !is_array($params)) {
            return -1;
        }
        $keys = $this->_getParamKeyString($params);
        $vals = $this->_getParamValString($params);
        $sql = "insert into ".$this->_table."(".$keys.") values(".$vals.")";
        //echo "[insert]".$sql."<br>";
        $result = mysqli_query($this->_con,$sql);
        if (! $result) {
            return -1;
        }
        return mysqli_insert_id($this->_con);
    }

    public function update($params, $where = null) {
        if ($params == null || !is_array($params)) {
            return -1;
        }
        $upvals = $this->_getUpdateString($params);
        $wheres = $this->_getWhereString($where);
        $sql = "update ".$this->_table." set ".$upvals." ".$wheres;
        //echo "[update]".$sql."<br>";
        $result = mysqli_query($this->_con,$sql);
        if (! $result) {
            return -1;
        }
        return mysqli_affected_rows($this->_con);
    }

    public function delete($where) {
        $wheres = $this->_getWhereString($where);
        $sql = "delete from ".$this->_table.$wheres;
        //echo "[delete]".$sql."<br>";
        $result = mysqli_query($this->_con,$sql);
        if (! $result) {
            return -1;
        }
        return mysqli_affected_rows($this->_con);
    }

    protected function _getParamKeyString($params) {
        $keys = array_keys($params);
        return implode(",", $keys);
    }

    protected function _getParamValString($params) {
        $vals = array_values($params);
        return "'".implode("','", $vals)."'";
    }

    private function _getUpdateString($params) {
        $sql = "";
        if (is_array($params)) {
            $sql = $this->_getKeyValString($params, ",");
        }
        return $sql;
    }

    private function _getWhereString($params) {
        $sql = "";
        if (is_array($params)) {
            $sql = " where ";
            $where = $this->_getKeyValString($params, " and ");
            $sql = $sql.$where;
        }
        return $sql;
    }

    private function _getKeyValString($params, $split) {
        $str = "";
        if (is_array($params)) {
            $paramArr = array();
            foreach($params as $key=>$val) {
                $valstr = $val;
                if (is_string($val)) {
                    $valstr = "'".$val."'";
                }
                $paramArr[] = $key."=".$valstr;
            }
            $str = $str.implode($split, $paramArr);
        }
        return $str;
    }


    public function __destruct()
    {
        $this->_con->close();
        $this->_con = null;
    }
}
function getQuery($table){
    return (new Database())->table($table);
}
?>