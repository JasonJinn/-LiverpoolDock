<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 12/04/2017
 * Time: 8:23 PM
 */
include "../DAO/Database.php";
include_once "../Controller/method/variable.php";

$user = $_REQUEST["name"];
if(isset($user)){
    $dao = getQuery("User");

    $result = $dao->getLike("username",$user);

    $num = count($result);
    $hash =array();
    for($i=0;$i<$num&&$i<5;$i++)
    {
        $dao->table("User_profile");
        $cnt = $dao->get(array("email"=>$result[$i]["email"]));
        $path = $cnt[0]["photoname"];

        if(isset($path))
            $path = $repositoryUrl1."/../".md5(md5($email).md5($email))."/".$path;
        else
            $path = $repositoryUrl1."/../default.jpg";
        $hash[] = array("username"=>$result[$i]["username"],"email"=>$result[$i]["email"],"photo"=>$path);
    }
}
echo json_encode($hash,JSON_UNESCAPED_SLASHES);
?>