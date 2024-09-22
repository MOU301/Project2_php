<?php
include "core/init.php";
$chat=new chat;
$name=trim($_GET['name']);
$id=$_GET['id'];
$users=$chat->getAllUsers();
$find=[];
if($name!=''){
    $name=strtolower($name);
    $len=strlen($name);
foreach($users as $user){
  if(stristr(substr($user->name,0,$len),$name)){
    if($user->id!=$id){
      array_push($find,$user);
    }
  }
}
echo json_encode($find);
}
?>