<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 12/04/2017
 * Time: 8:23 PM
 */
include "../DAO/Database.php";

$input = $_REQUEST["input"];
if(isset($input)){
    $dao = getQuery("module");

    $result = $dao->getLike("Module_code",$input);
    //print_r($result);
    $total=array();
    $hash = array();
    $num = count($result);
    for($i=0;$i<$num;$i++)
    {
        //$code = $result[$i]["Module_code"];
        $hash["code"] = $result[$i]["Module_code"];
        $hash["name"] = $result[$i]["module_name"];

        $total[] = $hash;
    }

    $result = $dao->getLike("module_name",$input);
    $num = count($result);
    for($i=0;$i<$num;$i++)
    {
        //$code = $result[$i]["Module_code"];
        $hash["code"] = $result[$i]["Module_code"];
        $hash["name"] = $result[$i]["module_name"];

        $total[] = $hash;
    }
}
echo json_encode($total);
?>