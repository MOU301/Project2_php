<?php

 if(isset($_SESSION['is_login'])) : ?>
<?php include '../inc/header.php';?>
<!-- ich bin hier home.php the main  -->
 <form action="home.php" method="post">
    <input type="submit" name="logout" class="btn btn-dark" value="logout">
 </form>
    <div class="container p-3">
        <?php Display(); ?>
       <div class="chat p-3">
        <div class="row">
            <div class=" col-lg-3 bg-danger pt-4">
                <div class="search d-flex">
                    <input type="search" onkeyup="search(this.value)">
                    <input type="hidden" id='id_user' value="<?php echo $_SESSION['id']; ?>" > 
                    <input type="submit" class="btn btn-primary" value="search">
                </div>
               <ul class="my-3">
                    <li id="friends">Friends</li>
                    <li id="requests">Requests</li>
                    <li id="responses">Responses</li>
                    <li id="settes">Settes</li>
               </ul>
               <div class="bg-white">
                <ul class="text-dark" id="findUser"></ul>
               </div>
                <div class="friends mt-5" >
                    <h3 class="text-light bg-danger">friends</h3>
                    <span class="close float-end m-2">
                        <i class="fa-solid fa-xmark"></i>
                    </span>
                    <ul >
                        <?php foreach($friends as $friend) : ?>
                        <li class="friend-item">
                            <h6 class="text-dark">
                                <a href="home.php?id=<?php echo $friend->id; ?>&&friends=<?php echo $friend->friends_id; ?>">
                                    <?php echo $friend->name; ?>
                                </a>
                            </h6>
                            <?php $info=lastmessage($allmessage,$friend->friends_id,$_SESSION['id']); ?>
                             <p class="<?php echo(($info[1]=='i') ? 'text-red':'text-success'); ?>"><?php 
                           
                             
                              if(!empty($info)){
                                echo $info[0];
                             } ?></p>
                        </li>
                      <?php endforeach; ?>
                        
                    </ul>
                </div>
                <div class="requests mt-5 " >
                    <h3 class="text-light bg-danger">Requests</h3>
                    <span class="close float-end m-2">
                        <i class="fa-solid fa-xmark"></i>
                    </span>
                 <ul>
                 <?php foreach($requests as $request) : ?>
                        <li class="requests-item">
                            <h6 class="text-dark"><?php echo $request->name; ?></h6>
                            <form action="home.php?id=<?php echo $request->user2_id; ?>" method="post" class="d-flex justify-content-around p-1">
                                <input type="submit" class="btn btn-success" name="accept" value="Accept">
                                <input type="submit" class="btn btn-dark" name="detials" value="Details">
                                <input type="submit" class="btn btn-danger" name="delete" value="Delete">
                            </form>
                        </li>
                        <?php endforeach ; ?>
                    </ul>
                   
                </div>
                
                <div class="respons mt-5 " >
                    <h3 class="text-light bg-danger">Respos</h3>
                    <span class="close float-end m-2">
                        <i class="fa-solid fa-xmark"></i>
                    </span>
                 <ul>
                 <?php foreach($respons as $respons) : ?>
                        <li class="respons-item">
                            <h6 class="text-dark"><?php echo $respons->name; ?></h6>
                            <form action="home.php" method="post" class="d-flex justify-content-around p-1">
                                <input type="submit" class="btn btn-danger" name="deleteFD" value="delete">
                                <input type="hidden" name="friend_id" value="<?php echo $respons->user1_id ; ?> ">
                            </form>
                        </li>
                        <?php endforeach ; ?>
                    </ul>
                   
                </div>
            </div> 

            <?php if(!empty($sender)) : ?>
            <div class=" col-lg-9 bg-dark two">
                <div class="head d-flex justify-content-around p-3">
                    <div>
                        <h4><?php echo $sender->name; ?></h4>
                        <?php if($sender->state=='1'): ?>
                            <div class="green"></div>
                        <?php else : ?>
                            <div class="red"></div>
                        <?php endif ; ?>
                    </div>
                    <div class="image">
                        <img src="" alt="">
                    </div>

                </div>
                <div id="messages" class="message text-white p-3">
                 <!-- code from js -->
                  
                </div>
                <div class="create-message my-2 p-3" >
                    <form action="send.php" method="post">
                        <div class="d-flex">
                            <input type="text" name="message" class="form-control" placeholder="enter message">
                            <input type="button"  name="send" value="send" class="btn btn-danger">
                        </div>
                        <input type="hidden" id="id"  value="<?php echo $_SESSION['id'] ; ?>">
                        <input type="hidden" id='friends_id' value="<?php echo $_GET['friends']; ?>">
                    </form>
                </div>
            </div>
            <?php elseif(!empty($user_details)): ?>
                <div class=" col-lg-9 bg-dark two d-flex justify-content-center align-content-center align-items-center">
          
                    <div class="details">
                        <div>
                                <div class="image"></div>
                                <h2><?php echo $user_details->name;?></h2>
                                <h3><?php echo $user_details->country ;?></h3>
                                <h4><?php echo $user_details->work; ?></h4>
                                <form class="p-5" action="home.php?id=<?php echo $user_details->id ; ?>" method="post">
                                <?php if($check_friend=="sendto"): ?>
                                    <input type="submit" name="delete" class="btn btn-success" value="Delete">
                                <?php elseif($check_friend=='resevied'): ?>
                                    <input  type="submit" name="accept" class="btn btn-success form-control" value="Accept">
                                <?php elseif($check_friend=='friend') : ?>
                                    <input type="submit" name="contact" class="btn btn-primary" value="Contact" >
                                <?php else : ?>
                                    <input  type="submit" name="add_friend" class="btn btn-success form-control" value="Add">
                                     
                                <?php endif; ?>
                                <input type="hidden" name="user_details_id" value="<?php echo $user_details->id; ?>">
                                
                                </form>
                                <!-- add button to send message if the user is friend  -->
                            </div>

                        </div>

                </div>
            <?php else : ?>
                <?php endif ; ?>
           </div>
       </div>
    </div>
    <!-- ich bin in chat_app->home.php -->
<?php include '../inc/footer.php'; ?>
<?php else : 
   redirect("login.php","you must login ","error");
    ?>
    <?php endif ; ?>