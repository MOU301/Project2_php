<?php
 set_time_limit(30);
// problem 1  
// function sum($arr){
//     $sum=0;
//     for($i=0; $i<=count($arr)-1; $i++){
//         if($arr[$i]%2==0){
//             $sum+=$arr[$i];
//         }
//     }
//     return $sum;
// }
// function func($arr){
//     $large=$arr[count($arr)-1];
//     if($large<=4000000){
//         $a=$arr[count($arr)-1];
//         $b=$arr[count($arr)-2];
//         $c=$a+$b;
//         array_push($arr,$c);
//         return func($arr);
//     }
//     else{
//         return sum($arr);
//     }

// }

// $arr=[1,2];
// echo func($arr);
// end problem one
// problem 2 ; 
// function prim($a){
// for($i=2; $i<=floor($a/2); $i++){
//     if($a%$i==0){
//         return false;
//         break;
//     }   
// }
// return true;

// }
// function func($a){
    
//     for($i=floor($a/2) ; $i>=2 ; $i=$i-1){
         
//       if($a%$i==0){
//           if(prim($i)){
//            return $i;
//            break;
//            }
//            }

//     }
// }


// 600851475143
// $num=13195;
// echo func($num);
// end problem two 




?>
<?php include "../inc/header.php"; ?>
    <div class="container">
        <div class="hlogin d-flex justify-content-center align-content-center align-items-center">
            
            <div class="login">
                <h4>Login </h4>
                <form action="" method="post">
                <?php  Display(); ?>
                    <div>
                        <label class="my-2"><strong>username :</strong></label>
                        <input type="text" class="form-control" name="username" placeholder="Enter user">
                    </div>
                    <div class="my-4"> 
                        <label class="my-2"><strong>Password :</strong></label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                    </div>
                    <input type="submit" name="login" value="Login" class="btn btn-success">
                </form>
              <div class="d-flex justify-content-center py-3">
                <div class="text-center">
                    <p>if you have not acount please creat  acount</p>
                <a href="register.php" class="btn btn-danger">create acount</a>
                </div>
              </div>
            </div>
        </div>
    </div>
<?php include '../inc/footer.php'; ?>