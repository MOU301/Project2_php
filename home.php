
<?php
include "core/init.php";
$template=new template('templates/pages/home.php');
$chat=new chat;
$id=$_SESSION['id'] ?? null;
$friend_id=$_GET['id'] ?? null;
$friends_id=$_REQUEST['friends'] ?? null;
$template->sender=$chat->getFriendById($friend_id);
$template->respons=$chat->getRespons($id);
$template->requests=$chat->getRequests($id);
$template->friends=$chat->getAllFriends($id);
$template->messages=$chat->GetMessageById($friends_id);
$template->title=$chat->getUserById($id)->name;
$user=$_GET['user'] ?? null;
// 
$template->allmessage=$chat->getMessageFriends($id);
if(!is_null($friend_id)){
    $id_info=$friend_id;
   }
   else if(!is_null($user)){
    $id_info=$_GET['user'];
   }
   else{
    $id_info=null;
   }
 if(!is_null($id_info)){
        $template->check_friend=$chat->Check_Friend($id,$id_info);
   
 }

// 


if(!is_null($user)){
    echo $_SESSION['id'];
    echo "</br>";
    echo $user;
    echo "</br>"; 
    echo "the name is ".$chat->getUserById($user)->name; 
  $template->user_details=$chat->getUserById($user);
}

//start logout
if(isset($_POST['logout'])){
if($chat->logout($id)){
    redirect("login.php","success logout ","success");
}
}
// end logout
//
if(isset($_POST['accept'])){
    $id_request=$_GET['id'];
    if($chat->Accept($id_request)){
        
        redirect("home.php","ok accept the friend","success");
    }
    else{
        redirect('home.php',"there is wrong in accept the friend",'error');
    }
}
if(isset($_POST['contact'])){
    $friends_id=$chat->getFriendsById($id,$friend_id)->friends_id;
    echo "</br>"; 
    echo "id of the friends is : ". $friends_id;
    echo "</br>";
redirect("home.php?id=". $id."&&friends=". $friends_id,'','success');
}
if(isset($_POST['delete'])){
    $id_request=$_GET['id'];
    if($chat->DeleteRequest($id_request)){
        redirect("home.php","delete the request ","success");
    }
    else{
        redirect('home.php',"there is wrong in delete the request",'error');
    }
}
if(isset($_POST['detials'])){
    echo "the details is : code is here now ";
    $id_request=$_GET['id'];
    if($chat->getUserById($id_request)){
    $template->user_details=$chat->getUserById($id_request);
    }
       
}
// else{
//     $template->user='';
 
// }
// start the message send 

// $template->message=$chat->getMessageById($id,$friend_id);


if(isset($_POST['deleteFD'])){
    $id=$_SESSION['id'];
    $ida=$_POST['friend_id'];
   echo $id;
   echo '</br>';
   echo $ida;
    if($chat->DeleteRespons($id,$ida)){
        redirect("home.php","delete the respons ","success");
    }
    else{
        redirect('home.php',"there is wrong in delete the respons",'error');
    }

}
// from send by ajax
// if(isset($_POST['send'])){
//     if(!empty($_POST['message'])){
//         $message=$_POST['message'];
//          if($chat->InsertMessage($id,$friends_id,$message)){
//             redirect("home.php?id=". $id."&&friends=". $friends_id,'add message','success');
//          }
//          else{
//             redirect("home.php?id=". $id."&&friends=". $friends_id,'add not message','error');
//          }
//     }
//     else{
//         redirect("home.php?id=". $id."&&friends=". $friends_id,'fill the message please ','error');

//     }
// }

// get message by freinds_id from query

if(isset($_POST['add_friend'])){
  $id2= $_POST['user_details_id'];
    if($chat->AddFriend($id,$id2)){
        echo "add friends ";
    }
}
echo $template;
?>
