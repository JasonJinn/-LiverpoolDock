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


$des = new DES('1996');
$token = $_COOKIE['token'];
$type = $_REQUEST["type"]; //lecture, lab, assessment
$code = $_REQUEST["code"];
//echo "asd";
if(verifyToken($token)=="false"){
    echo "token invalid";
}else {
    $dao = getQuery("module_material");
    $result = $dao->getByOrder("time",array("module_code"=>$code,"file_type"=>$type));
    //$result = $dao->get();
    print_r($result);

    $hash = array();
    $num = count($result);
    for($i=0;$i<$num;$i++){
        $hash[] = array("name"=>$result[$i]["file_name"],"deadline"=>$result[$i]["deadline"]);
    }
}
?>