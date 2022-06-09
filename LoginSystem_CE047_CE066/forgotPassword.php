<link rel="stylesheet" href="StyleSheetLogin.css">
<?php 
    // echo $_SERVER['REQUEST_METHOD'];
    require_once "config.php";
    if(isset($_POST['uname'])){
        require 'changePassword.php';
    }
    if($_SERVER['REQUEST_METHOD']==='GET' and !isset($_GET['usernameValid'])){
        require 'userForm.php';
    }
    if(isset($_POST['email'])){
        $uname = $_POST['email'];
        require 'validateUser.php';
    }
    if(isset($_GET['usernameValid'])){
        require 'passwordForm.php';
    }
    if(isset($_POST['check'])){
        $flag=false;
        $sql="SELECT * FROM `users` ";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            if($uname==$row['username']){
                // echo "<input type='hidden' name='uname' value='$uname'>";
                $flag=true;
            }
        }
        if(!$flag){
            header("Location:forgotPassword.php?msg=invalid username");
        }
        else{
            // header("Location:forgotPassword.php?change=pending");
        }
    }
?>
    <?php if(isset($_GET['msg']) or isset($_GET['error'])): ?>
        <p style="color: pink; width:100vh;font-size:3vh;line-height:3vh;word-spacing:1vh;font-weight:bold;
"> <?=  $_GET['msg']; ?> </p>
        <p style="color: pink; width:100vh;font-size:3vh;line-height:3vh;word-spacing:1vh;font-weight:bold;"> <?= $_GET['error']; ?> </p>
    <?php endif; ?>
