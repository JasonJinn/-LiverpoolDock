<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 12/04/2017
 * Time: 12:43 AM
 */
include_once '../DAO/Database.php';
include_once '../Controller/method/DES.php';
include_once '../Controller/method/tokenVerify.php';


$des = new DES('1996');
$token = $_GET['token'];

if(verifyToken($token)=="false"){
    echo "token invalid";
}else {
//echo $token.'<br>';
    $dao = getQuery('User_profile');
    $arr = explode('^&*', ($des->passport_decrypt($token)));
    $email = $arr[0];
    //echo $token;
    $result = $dao->get(array("email" => $email));
    //print_r($result);
    if(isset($result)){
        $hash = array("profile"=>$result[0]["profile"],
            "facebook"=>$result[0]["facebook"],
            "google"=>$result[0]["google"],
            "twitter"=>$result[0]["twitter"],
            "education"=>$result[0]["education"],
            "experience"=>$result[0]["experience"]);
    }
    echo json_encode($hash);
}
?>