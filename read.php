<?php 
include "core/init.php";
$chat=new chat;
$friends=$_GET['friends'];
$messages=$chat->getMessageById($friends);
if(!empty($messages)){
echo json_encode($messages);
}
else{
    echo json_encode(array('message'=>'no messages'));
}

