<?php 
function redirect($page=false,$message=null,$type=null){
if(is_string($page)){
    $location=$page;
}else {
    $location=$_SERVER["SCRT_NAME"];
}
if($type != null){
    $_SESSION['type']=$type;
}
if($message != null){
    $_SESSION["message"]=$message;
}
header("location:".$location);
exit;

}

function Display(){
    if(!empty($_SESSION['message'])){
        $message=$_SESSION['message'];
        if(!empty($_SESSION['type'])){
            $type=$_SESSION['type'];
            if($type=='error'){
                echo '<div class="alert alert-danger mt-3">'.$message.'</div>';
            }
            else{
                echo '<div class="alert alert-success mt-3">'.$message.'</div>'; 
            }
        unset($_SESSION['message']);
        unset($_SESSION['type']);      
    }
    }
    else{
        echo '';
    }

}

function lastmessage($arr,$id,$admin){
    $info=[];
   foreach($arr as $chat){
   if($chat->friend_id==$id){
     array_push($info,$chat->message); 
   
        if($chat->user_id==$admin){
            array_push($info,'i');
        }
        else{
            array_push($info,'he');
        }
    }
   }
   return $info; 
}

function format_date($date){
    $date=date('F j: Y  g:i a',strtotime($date));
    return $date;
    }

?>