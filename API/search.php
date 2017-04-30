<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 12/04/2017
 * Time: 8:23 PM
 */
include "../DAO/Database.php";

$user = $_REQUEST["name"];
if(isset($user)){
    $dao = getQuery("User");

    $result = $dao->getLike("username",$user);

    $num = count($result);
    $hash =array();
    for($i=0;$i<$num&&$i<5;$i++)
    {
        $hash[] = array("username"=>$result[$i]["username"],"email"=>$result[$i]["email"]);
    }
}
echo json_encode($hash);
?>