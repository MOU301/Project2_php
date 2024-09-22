<!-- <?php 
function gg(){
    return "two";
    return "one";
   
}
echo gg();
?> -->
<!-- if we have tow return in function the first return run the second return no run  -->

<?php include "../inc/header.php" ; ?>
    <div class="container p-5">
        
        <div class="hlogin d-flex justify-content-center align-content-center align-items-center">
           
            <div class="login">
                <h4>Register</h4>
                
                <form action="register.php" method="post">
                <?php Display(); ?>
                    <div>
                        <label class="my-2"><strong>username :</strong></label>
                        <input type="text" class="form-control" name="username" placeholder="Enter user">
                    </div>
                    <div>
                        <label class="my-2"><strong>country :</strong></label>
                        <input type="text" class="form-control" name="country" placeholder="Enter country">
                    </div>
                    <div>
                        <label class="my-2"><strong>old :</strong></label>
                        <input type="text" class="form-control" name="old" placeholder="your old">
                    </div>
                    <div>
                        <label class="my-2"><strong>work:</strong></label>
                        <input type="text" class="form-control" name="work" placeholder="Enter work">
                    </div>
                    <div>
                        <label class="my-2"><strong>email :</strong></label>
                        <input type="text" class="form-control" name="email" placeholder="Enter email">
                    </div>
                    
                    <div class="my-4"> 
                        <label class="my-2"><strong>Password :</strong></label>
                        <input type="password" class="form-control" name="password1" placeholder="Enter password">
                    </div>
                    <div class="my-4"> 
                        <label class="my-2"><strong>Confirm Password :</strong></label>
                        <input type="password" class="form-control" name="password2" placeholder="Enter password">
                    </div>
                    <input type="submit" name="register" value="Register" class="btn btn-success">
                    <a href="login.php" class="btn btn-danger">login</a>
                </form>
                
                  
              
            </div>
        </div>
    </div>

<?php include "../inc/footer.php" ; ?>
