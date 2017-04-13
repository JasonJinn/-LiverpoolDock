<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 2017/4/3
 * Time: 下午7:58
 */
include "method/DES.php";
include_once "../DAO/Database.php";
include_once "method/tokenVerify.php";

$token=$_REQUEST["token"];
$code=$_REQUEST["code"];
$option_array =$_REQUEST["option"];
$title =$_REQUEST["title"];

if(verifyToken($token)=="true"){


    $des = new DES("1996");
    $arr = explode('^&*', ($des->passport_decrypt($token)));
    $email = $arr[0];


    $dao = getQuery("User_module");
    $result=$dao->get(array("email"=>$email,"module_code"=>$code));
    if(count($result)!=0) {

        $dao->table("User");
        $result = $dao->get(array("email" => $email));
        $username = $result[0]["username"];


        $dao->table("votingpoll");
        $result = $dao->getMax("poll_id", array("module_code" => $code));
        $max = $result[0][0] + 1;

        $date = date("Y/m/d H:m:s", time());
        $result1 = $dao->insert(array("poll_id" => $max, "poll_title" => $title,
                                    "name" => $username, "email" => $email,
                                     "module_code" => $code, "poll_date" =>$date));
       // echo $result1;
        $dao->table("votingOption");
        $num=0;
        foreach($option_array as $key => $value) {
        $result2 = $dao->insert(array("poll_id" => $max, "module_code" => $code,
            "email" => "null", "poll_option" => $option_array[$key]));
        if($result2==0)
            $num++;
        }
        //echo $num,count($option_array);
        if ($result1 == "0" && $num == count($option_array))
            echo "transaction success";
        else
            echo "transaction failed";
    }else{
        echo "you cannot access this module";
    }
}else{
    echo "token verify fail";
}
?>