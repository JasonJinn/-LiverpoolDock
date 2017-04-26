<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 25/04/2017
 * Time: 1:42 AM
 */
include_once '../DAO/Database.php';
include_once '../Controller/method/DES.php';
include_once '../Controller/method/tokenVerify.php';


$des = new DES('1996');
$token = $_COOKIE['token'];
$code = $_REQUEST['code'];
$operation = $_REQUEST["operate"];

if(verifyToken($token)=="false"){
    echo "token invalid";
}else {
    $dao = getQuery('module');
    $arr = explode('^&*', ($des->passport_decrypt($token)));
    $email = $arr[0];
    //echo $token;
    $result = $dao->get(array("Module_code" => $code));
    //print_r(array_values($result));
    //echo isset($result[0]);
    if(isset($result[0])){
        $dao->table("User_module");
        if($operation=="add"){
            $cnt = $dao->insert(array("email"=>$email,"module_code"=>$code));
            if($cnt==0){
                echo "add successfully";
            }else{
                echo "User has chosen the same module";
            }
        }else if($operation=="delete"){
            $cnt = $dao->delete(array("email"=>$email,"module_code"=>$code));
            //print_r($cnt);
            if($cnt==1){
                echo "delete successfully";
            }else{
                echo "User doesn't have that module";
            }
        }else{
            echo "wrong operation instruction";
        }
    }else{
        echo "wrong module code";                                               //not exist module code
    }

}
?>