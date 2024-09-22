<?php 
class validator{
    public function is_required($field){
        foreach($field as $field){
            if($_POST[$field]==''){
                // flase break and stop the loop 
            return false;
            } 
        }
        return true;
     
    }
    public function checkEmail($email){
        if(filter_var($email,FILTER_SANITIZE_EMAIL)){
            return true;
        }
        else{
            return false;
        }
    }
    public function checkPass($pass1,$pass2){
        if($pass1==$pass2){
            return true;
        }
        else{
            return false;
        }
    }
}
?>