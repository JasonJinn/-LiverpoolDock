<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 06/04/2017
 * Time: 9:42 PM
 */
include "../DAO/Database.php";

$dao = getQuery("User");
$result = $dao->get(array("email"=>213,"password"=>123123));
echo json_encode($result);
?>