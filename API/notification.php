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


$des = new DES('1996');
$token = $_COOKIE['token'];

if(verifyToken($token)=="false"){
    echo "token invalid";
}else {
//echo $token.'<br>';
    $arr = explode('^&*', ($des->passport_decrypt($token)));
    $email = $arr[0];
    //echo $token;
    $dao = getQuery('topic');
//    $result = $dao->get(array("email" => $email));
//    //print_r($result);
//
//    $num = count($result);
//    $dao->table("topic_response");
//    for($i=0;$i<$num;$i++){
//        //echo $result[$i]["topic_id"];
//        $cnt = $dao->getByOrder("time",array("topic_id"=>$result[$i]["topic_id"],"isReport"=>'0',
//            "email !"=>$email,"forum"=>$result[$i]["forum"],"module_code"=>$result[$i]["module_code"]));
//        print_r($cnt);
//    }
    $result = $dao->query("select * from topic_response 
    where (topic_id,forum,module_code)in (select topic_id,forum,module_code from topic where email = '$email') AND 
    email != '$email' order by time desc limit 5");
    //print_r($result);
    $num = count($result);
    $total = array();
    $hash = array();
    for($i=0;$i<$num;$i++){
        $hash["name"] = $result[$i]["Username"];
        $hash["time"] = $result[$i]["time"];
        $hash["type"] = "response to your topic";
        $hash["topic"]["id"] = $result[$i]["topic_id"];
        $hash["topic"]["forum"] = $result[$i]["forum"];
        $hash["topic"]["code"] = $result[$i]["module_code"];

        $total[] = $hash;
    }

    echo json_encode($total);
}
?>