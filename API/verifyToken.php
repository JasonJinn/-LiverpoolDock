<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 06/04/2017
 * Time: 9:21 PM
 */
include_once '../Controller/method/tokenVerify.php';

echo verifyToken($_GET['token']);
?>