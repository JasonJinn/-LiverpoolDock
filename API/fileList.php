<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 07/04/2017
 * Time: 11:44 PM
 */
include_once '../DAO/Database.php';
include_once '../Controller/method/DES.php';
include_once '../Controller/method/tokenVerify.php';


$dao = getQuery('file');
$des = new DES('1996');
$token = $_COOKIE['token'];
$Repo = $_REQUEST["repo"];          //private or public
$operation = $_REQUEST["operation"];    //list or totalsize, size return byte.

if(verifyToken($token)=="false"){
    echo "token invalid";
}else {
    //echo $token;
    if($operation=="list") {
        $result = $dao->get(array("mail" => $_COOKIE['mail'], "Repo" => $Repo, "isDelete" => "0"));
        //print_r(array_values($result));
        $hash = array();
        //$total = array();
        $des_module_name = getQuery("module");
        for ($i = 0; $i < count($result); $i++) {
            $hash[] = array("file_name" => $result[$i]['name'],
                "file_size" => $result[$i]['size'],
                "upload_time" => $result[$i]['time']);
        }
        echo json_encode($hash);
    }else if($operation=="totalsize"){
        $hash = array();
        $result = $dao->getSum("size",array("mail"=>$_COOKIE['mail'],"Repo"=>"public","isDelete"=>"0"));
        if(isset($result[0][0])){
            $hash["public_size"] = $result[0][0];
        }else{
            $hash["public_size"] = 0;
        }

        $result = $dao->getSum("size",array("mail"=>$_COOKIE['mail'],"Repo"=>"private","isDelete"=>"0"));
        if(isset($result[0][0])){
            $hash["private_size"] = $result[0][0];
        }else{
            $hash["private_size"] = 0;
        }

        echo json_encode($hash);
    }else{
        echo "wrong operation";
    }
}
?>