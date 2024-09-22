<?php 
include "core/init.php";
$chat= new chat;
$validator=new validator;
$template=new template("templates/pages/login.php");
if(isset($_POST['login'])){
    $field=['username','password'];
    if($validator->is_required($field)){
        $row=$chat->CheckUser($_POST['username']);
        if(!empty($row)){
           if(password_verify($_POST['password'],$row->password)){
               if($chat->login($row)){
               redirect("home.php","success login welcome with you  :".$_SESSION['username'],'success');
               }
           }else{
              redirect("login.php",'the password is wrong ','error');
           }
          
        }
        else{
            redirect('login.php','the username is wrong ','error');
        }
    }
    else{
        redirect('login.php',"fill the field please",'error');
    }


}
echo $template;
 ?>