<?php
    require 'config.php';
    $uname=$_POST['uname'];
    $pwd=$_POST['pwd'];
    $cpwd=$_POST['cpwd'];
    $patternsp ="/[!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?]+/";
    $patternd = "/[0-9]/";
    $patternsm ="/[a-z]/";
    $patterncap="/[A-Z]/";
    $m=true;
    if($pwd===$cpwd and preg_match($patternsp, $pwd) and preg_match($patternd, $pwd) and preg_match($patternsm, $pwd) and preg_match($patterncap, $pwd) and strlen($pwd)>=8){
        $sql2="UPDATE `users` SET `password`= (?) WHERE `username` = (?) ";
        if($stmt2=mysqli_prepare($conn,$sql2)){
            mysqli_stmt_bind_param($stmt2,"ss",$p_p,$p_u);
            $p_p=$pwd;
            $p_u=$uname;
            if(mysqli_stmt_execute($stmt2)){
                $m=false;
                header("Location:loginPage.php?msg=Account's Password updated successfully");

                // echo "Account's Password updated successfully";
            }
        }
    }
    else if($pwd!=$cpwd){
        header("Location:forgotPassword.php?error=confirm password does not match to the password.");
        echo "confirm password does not match to the password.";
    }
    else if($m){
        header("Location:forgotPassword.php?error=Password need to be more <br>than 8 characters and should have <br>atleast one small case character, <br>one upper case character, <br>one digit and <br>one special character.");
        // echo "Password need to be more than 8 characters and should have atleast one small case character, one upper case character, one digit and one special character.";
    }
    mysqli_close($conn);
?>