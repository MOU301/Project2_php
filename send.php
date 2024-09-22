<?php 
include 'core/init.php';
$chat=new chat;
$message=$_GET['message'];
$id=$_GET['id'];
$friends=$_GET['friends'];
if($message!=""){
    if($chat->InsertMessage($id,$friends,$message)){
        echo  'ok';
    }
    else{
        echo 'on';
    }
}
else{
    echo "the message is field please fill the message now ";
}
