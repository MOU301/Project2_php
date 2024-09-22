<?php 
include "core/init.php";
$template=new template("templates/pages/register.php");
$validator=new validator();
$chat=new chat;
if(isset($_POST['register'])){
    $field=['username',"country",'password1','password2','old','work','email'];
    if($validator->is_required($field)){
        echo "the field is ok";
      if($validator->checkEmail($_POST['email'])){
        echo '</br> the email is ok ';
        if($validator->checkPass($_POST['password1'],$_POST['password2'])){
            $data=[];
            $data['username']=$_POST['username'];
            $data['country']=$_POST["country"];
            $data["old"]=$_POST["old"];
            $data["email"]=$_POST["email"];
            $data["work"]=$_POST["work"];
            $data['password']=password_hash($_POST["password1"],PASSWORD_DEFAULT);
            if($chat->Register($data)){
                redirect("login.php","success the register please login","success");
            }
            else{
                redirect("register.php","please retry the register","error");
            }
        }
        else{
            redirect("register.php","please check the passwork","error");
        }
        

      }else{
        redirect("register.php","please check the email ","error");
      }
    }
    else{
        redirect("register.php","please fill the field ",'error');
    }
}




echo $template;
;?>