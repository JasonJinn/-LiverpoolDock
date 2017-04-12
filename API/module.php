<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 2017/4/3
 * Time: 下午7:58
 */
include "../DAO/Database.php";
include "../Controller/method/variable.php";

$token = $_GET["token"];

$code = $_GET["code"];

$moduleList=json_decode(file_get_contents($baseUrl."API/moduleList/moduleList.php?token=".urlencode($token)),true);
//print_r($moduleList);
if(isset($moduleList["$code"])) {
    $dao = getQuery("module");
    $result = $dao->get(array("Module_code" => $code));
    //print_r($result);
    $hash=array("code"=>$result[0]["Module_code"],
        "name"=>$result[0]["module_name"],
        "description"=>$result[0]["module_description"],
        "material"=>$result[0]["materials_path"]);
    echo json_encode($hash);
}else{
    echo "You are not permitted to access the this module";
}
?>