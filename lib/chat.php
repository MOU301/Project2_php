<?php
class chat{
private $db;
public function __construct(){
    $this->db=new database;
}

public function Register($data){
  $q="INSERT INTO users 
  (name,password,work,email,country,old)
  VALUES 
  (:username,:password,:work,:email,:country,:old)";
$this->db->query($q);
$this->db->bind(":username",$data["username"]);
$this->db->bind(":password",$data["password"]);
$this->db->bind(":work",$data["work"]);
$this->db->bind(":email",$data["email"]);
$this->db->bind("country",$data["country"]);
$this->db->bind(":old",$data['old']);
if($this->db->execute()){
    return true;
}
else{
    return false;
}
}
public function CheckUser($username){
   $q="SELECT * FROM users WHERE name=:username"; 
   $this->db->query($q);
   $this->db->bind(":username",$username);
   return $this->db->Single();
}

public function login($row){
    $_SESSION['is_login']=true;
    $_SESSION['username']=$row->name;
    $_SESSION['id']=$row->id;
    $id=$_SESSION['id'];
    $this->UpdateStateOn($id);
    return true;
}
public function logout($id){
    $this->UpdateStateOff($id);
    unset($_SESSION['is_login']);
    unset($_SESSION["username"]);
    unset($_SESSION['id']);
}

public function getRespons($id){
$q="SELECT `friends`.* ,`users`.`name` FROM `friends`
INNER JOIN `users`
ON `friends`.`user2_id`=`users`.`id`
  WHERE `friends`.`user1_id`=:id && `friends`.`state`='0'";
$this->db->query($q);
$this->db->bind(":id",$id);
return $this->db->ResutSet();
}
public function getRequests($id){
    $q="SELECT `friends`.* ,`users`.`name` FROM `friends`
    INNER JOIN `users`
    ON `friends`.`user1_id`=`users`.`id`
      WHERE `friends`.`user2_id`=:id && `friends`.`state`='0'";
    $this->db->query($q);
    $this->db->bind(":id",$id);
    return $this->db->ResutSet();  
}

public function getAllFriends($id){
    $q="SELECT `friends`.* ,`users`.`name`,`users`.`id` FROM `friends`
    INNER JOIN `users`
    ON IF(user1_id=:id,`friends`.`user2_id`=`users`.`id` , `friends`.`user1_id`=`users`.`id`)
    WHERE (`friends`.`user1_id`=:id || `friends`.`user2_id`=:id) && `friends`.`state`='1'";
    $this->db->query($q);
    $this->db->bind(":id",$id);
    return $this->db->ResutSet();
}
public function getFriendById($id){
    $q="SELECT `users`.*,`friends`.`state` FROM `users`
    INNER JOIN `friends` 
    ON `users`.`id`=`friends`.`user1_id`|| `users`.`id`=`friends`.`user2_id`
    WHERE `users`.`id`=:id && `friends`.`state`='1'";
    $this->db->query($q);
    $this->db->bind(":id",$id);
    return $this->db->Single();
}
public function getFriendsById($id1,$id2){
    $q="SELECT * FROM `friends`
    WHERE (`user1_id`=:id1 && `user2_id`=:id2) ||  (`user2_id`=:id1 && `user1_id`=:id2) ";
    $this->db->query($q);
    $this->db->bind(":id1",$id1);
    $this->db->bind(":id2",$id2);
    return $this->db->Single();
}
public function AddFriend($id1,$id2){
    $q="INSERT INTO `friends` (user1_id,user2_id,state) VALUES (:id1,:id2,'0')";
    $this->db->query($q);
    $this->db->bind(":id1",$id1);
    $this->db->bind(":id2",$id2);
    if($this->db->execute()){
        return true;
    }else {
        return false;
    }
}

public function Accept($id){
$q="UPDATE friends SET state=1 WHERE user2_id=:id";
$this->db->query($q);
$this->db->bind(":id",$id);
if($this->db->execute()){
    return true;
}else {
    return false;
}
}
public function DeleteRequest($id){
    $q="DELETE FROM friends WHERE user2_id=:id && state='0'";
    $this->db->query($q);
    $this->db->bind(":id",$id);
    if($this->db->execute()){
        return true;
    }
    else {
        return false ;
    }
}
public function DeleteRespons($id ,$ida){
    $q="DELETE FROM friends WHERE user2_id=:id && user1_id=:ida && state='0'";
    $this->db->query($q);
    $this->db->bind(":id",$id);
    $this->db->bind(":ida",$ida);
    if($this->db->execute()){
        return true;
    }
    else {
        return false ;
    }
}
public function getAllUsers(){
    $q="SELECT * FROM users";
    $this->db->query($q);
    return $this->db->ResutSet();
}
public function getUserById($id){
    $q="SELECT * FROM users WHERE id=:id";
    $this->db->query($q);
    $this->db->bind(":id",$id);
   return $this->db->Single();
}
public function InsertMessage($user_id,$friend_id,$message){
$q="INSERT INTO `chats` (`user_id`,`friend_id`,`message`)
 VALUES (:user_id,:friend_id,:message)";
 $this->db->query($q);
 $this->db->bind(':user_id',$user_id);
 $this->db->bind(":friend_id",$friend_id);
 $this->db->bind(":message",$message);
 if($this->db->execute()){
    return true;
 }
 else {
    return false;
 }
}
public function getMessageById($friend_id){
    $q="SELECT `chats`.* , `users`.`name` FROM `chats` 
    INNER JOIN `users` 
    ON `chats`.`user_id` = `users`.`id`
    WHERE `friend_id`=:friend_id ";
    $this->db->query($q);
    $this->db->bind(":friend_id",$friend_id);
    return $this->db->ResutSet();
}
public function UpdateStateOn($id){
$q="UPDATE users SET state='1' WHERE id=:id";
$this->db->query($q);
$this->db->bind(":id",$id);
if($this->db->execute()){
    return true; 
}
else{
    return false; 
}
}
public function UpdateStateOff($id){
    $q="UPDATE users SET state='0' WHERE id=:id";
    $this->db->query($q);
    $this->db->bind(":id",$id);
    if($this->db->execute()){
        return true; 
    }
    else{
        return false; 
    }
}
public function Check_Friend($id,$id_info){
    // respo
    $q1="SELECT * FROM `friends` WHERE `user1_id`=:id && `user2_id`=:id_info && state='0'"; 
    // request
    $q2="SELECT * FROM `friends` WHERE `user2_id`=:id &&  `user1_id`=:id_info && state='0'";
    // friend
    $q3="SELECT * FROM `friends` WHERE ((`user2_id`=:id &&  `user1_id`=:id_info) || (`user1_id`=:id &&  `user2_id`=:id_info)) && state='1'";
    $this->db->query($q1);
    $this->db->bind(":id",$id);
    $this->db->bind(':id_info',$id_info);
    $this->db->execute();
    if($this->db->rowCount()>0){
        return "sendto";
    }
    else{
        $this->db->query($q2);
        $this->db->bind(":id",$id);
        $this->db->bind(':id_info',$id_info);
        $this->db->execute();
        if($this->db->rowCount()>0){
            return "resevied";
        }else{
            $this->db->query($q3);
            $this->db->bind(":id",$id);
            $this->db->bind(':id_info',$id_info);
            $this->db->execute();
              if($this->db->rowCount()>0){
                  return "friend";
              }
              else{
                return "nofriend";
              }
        }
    }
}
public function getMessageFriends($id){
    $q="SELECT `chats`.* FROM `chats`
    INNER JOIN `friends`
    ON `chats`.`friend_id`=`friends`.`friends_id`
     WHERE (`friends`.`user2_id`=:id  || `friends`.`user1_id`=:id )  && `friends`.state='1'
     ORDER BY `chats`.`id` DESC";
     $this->db->query($q);
     $this->db->bind(":id",$id);
     return $this->db->ResutSet();
}
// public function getLastMessage($friend_id){
//     $q="SELECT *  FROM `chats` 
//     WHERE  `friend_id`=:friend_id
//       ORDER BY `id` DESC";
//     $this->db->query($q);
//     $this->db->bind(":friend_id",$friend_id);
//     return $this->db->ResutSet();
// }   
}
?>