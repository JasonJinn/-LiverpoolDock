<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 14/04/2017
 * Time: 12:52 AM
 */
include "method/DES.php";
include_once "../DAO/Database.php";
include_once "method/tokenVerify.php";

$token=$_COOKIE["token"];
$code=$_REQUEST["code"];
$option =$_REQUEST["option"];
$id =$_REQUEST["id"];

if(verifyToken($token)=="true"){


    $des = new DES("1996");
    $arr = explode('^&*', ($des->passport_decrypt($token)));
    $email = $arr[0];


    $dao = getQuery("User_module");
    $result=$dao->get(array("email"=>$email,"module_code"=>$code));
    if(count($result)!=0) {
        $dao->table("votingOption");
        $result=$dao->getDistinct("poll_option",array("poll_id"=>$id,"module_code"=>$code));

        $num=count($result);
        $flag=0;
       // print_r($result);
        for($i=0;$i<$num;$i++)
        {
            //echo $result[$i][0],$option,"<br/>";
            if($result[$i][0]==$option)
                $flag=1;
        }
        if($flag){
            $result=$dao->insert(array("poll_id"=>$id,"poll_option"=>$option,
                                    "email"=>$email,"module_code"=>$code));
            if($result==0){
                echo "transaction success";
            }else{
                echo "you have voted the same option";
            }
        }else{
            echo "dont have that option";
        }
    }else{
        echo "you cannot access this module";
    }
}else{
    echo "token verify fail";
}
?>