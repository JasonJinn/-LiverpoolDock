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


$dao = getQuery('User_module');
$des = new DES('1996');
$token = $_GET['token'];

if(verifyToken($token)=="false"){

}else {
//echo $token.'<br>';
    $arr = explode('^&*', ($des->passport_decrypt($token)));
    $email = $arr[0];
    //echo $token;
    $result = $dao->get(array("email" => $email));
    //print_r(array_values($result));
    $hash = array();
    $des_module_name = getQuery("module");
    for ($i = 0; $i < count($result); $i++) {
        $module_code = $result[$i]["module_code"];
        $hash[$module_code] = $des_module_name->get(array("Module_code" => $module_code))[0]["module_name"];
    }
}
echo json_encode($hash);
?>