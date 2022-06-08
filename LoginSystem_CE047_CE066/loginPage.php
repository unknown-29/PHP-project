<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="StyleSheetLogin.css">
<script src="https://kit.fontawesome.com/d0d49aaf67.js" crossorigin="anonymous"></script>
</head>
<body>
<form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
<label for="email">Enter your email : </label>
<input class="ip" type="email" id="email" name="email"/><br>
<label for="pwd">Password : </label>
<input class="ip" type='password' name='pwd' id='pwd'/>
<button type='button' name='pwd' id='show' onclick="return password()"><i id='icon' class="fa-regular fa-eye" name='show'></i></button><br>
<label for="cpwd" style="<?php if(!isset($_POST['signUp']) and !isset($_GET['signUp'])){echo 'display: none';} ?>">Confirm Password : </label>
<input class="ip" type='password' name='cpwd' id='cpwd' style="<?php if(!isset($_POST['signUp']) and !isset($_GET['signUp'])){echo 'display: none';} ?>"/>
<button type='button' name='cpwd' id='cshow' onclick="return cpassword()" style="<?php if(!isset($_POST['signUp']) and !isset($_GET['signUp'])){echo 'display: none';} ?>"><i id='cicon' class="fa-regular fa-eye" name='show'></i></button>
<script>
    function password(){
        let a=document.getElementById('pwd');
        let b=document.getElementById('icon').className;
        if(b=="fa-regular fa-eye"){
            a.setAttribute('type','text');
            document.getElementById('icon').className="fa-regular fa-eye-slash";
        }
        else{
            a.setAttribute('type','password');
            document.getElementById('icon').className="fa-regular fa-eye";
        }
    }
    function cpassword(){
        let a=document.getElementById('cpwd');
        let b=document.getElementById('cicon').className;
        if(b=="fa-regular fa-eye"){
            a.setAttribute('type','text');
            document.getElementById('cicon').className="fa-regular fa-eye-slash";
        }
        else{
            a.setAttribute('type','password');
            document.getElementById('cicon').className="fa-regular fa-eye";
        }
    }
</script>
<br>
<div style="<?php if(isset($_POST['signUp']) or isset($_GET['signUp'])){echo 'display: none';} ?>">
<img src="captcha.php" style="float:right; width:40vh; height:5vh"></br>
<label for='cap' style="position:relative;top:4.4vh;">Enter the captcha :</label></br>
<input type='text' name='cap' style="margin-left:30vh;"></br>
</div>
<a href="forgotPassword.php"><button type='button' style="<?php if(isset($_POST['signUp']) or isset($_GET['signUp'])){echo 'display: none';} ?>">Forgot Password ?</button></a></br>
<input type='submit' name='back' style="<?php if(!isset($_POST['signUp']) and !isset($_GET['signUp'])){echo 'display:none;';}?>" value='back' class='back' onmouseover="this.style.backgroundColor='tomato';this.style.color='white';" onmouseout="this.style.backgroundColor='white';this.style.color='black';"></br>
<button type="submit" name="signUp" value="signUp">signUp</button>
<input type="submit" value="Login" style="<?php if(isset($_POST['signUp']) or isset($_GET['signUp'])){echo 'display: none';} ?>"/>
<input type="reset" value="Clear"/></br>
</form>
</body>
</html>
<?php if (isset($_GET["msg"])): ?> 
    <p style="color: pink;font-size:2vh;word-spacing:1vh;font-weight:bold;
"> <?=  $_GET['msg']; ?> </p>
<?php endif;?>
<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	require_once "config.php";
    session_start();
    if (!empty($_POST["email"]) and !empty($_POST["pwd"]) and isset($_POST["email"]) and isset($_POST["pwd"])) {
        session_start();
        $uname = $_POST["email"];
        $password = $_POST["pwd"];
        $flagp=true;
        $flag=false;
        $patternsp ="/[!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?]+/";
        $patternd = "/[0-9]/";
        $patternsm ="/[a-z]/";
        $patterncap="/[A-Z]/";
        $sql="SELECT * FROM `users` ";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
		    if($uname == $row['username']){
                $flag=true;
		    	if($password == $row['password']){
		        	$_SESSION['name'] = $uname;
                    if($_POST['cap']==$_SESSION['CAPTCHA_CODE'])
                    header("Location:home.php");
                    else{
                        $msg="invalid captcha";
                        header("Location:loginPage.php?msg=$msg");
                        
                    }
		    	}
		    	else if($row['password']!=$password or empty($password)){
                    $msg="invalid password";
		    		header("Location:loginPage.php?msg=$msg");
                    break;
		    	}	
		    }
		    else{
                if(isset($_POST['signUp']) or isset($_GET['signUp'])){
                    if($_POST['pwd']===$_POST['cpwd'] and preg_match($patternsp, $password)and preg_match($patternd, $password)and preg_match($patternsm, $password)and preg_match($patterncap, $password) and strlen($password)>8){
                        $sql="INSERT INTO `users` (`username`, `password`) VALUES (?,?)";
                        if($stmt=mysqli_prepare($conn,$sql)){
                            mysqli_stmt_bind_param($stmt,"ss",$p_u,$p_p);
                            $p_u=$_POST["email"];
                            $p_p=$_POST["pwd"];
                            if(mysqli_stmt_execute($stmt)){
                                $msg= "Account created successfully <br/> Please login with new account details";
                                header("Location:loginPage.php?msg=$msg");
                            }
                        }	
                    }
                    else{
                        $flagp=false;
                    }
                }
		    }
		}
        if(!$flag){
            $msg= "Please Sign Up to Create Your New Account<br/>";
            header("Location:loginPage.php?msg=$msg");
            
        }
        else if(!$flagp){
            if($_POST['cpwd']!=$_POST['pwd']){
                // $_POST['signUp']="set";
                $msg= "confirm password does not match to the password";
                // echo $msg;
                header("Location:loginPage.php?msg=$msg&signUp=1");
                
            }
            else{
                $msg ="Password need to be more than 8 characters and should have <br> atleast one small case character, <br>one upper case character,<br> one digit and one special character<br>";
                echo $msg;
                // $_POST['signUp']="set";
                header("Location:loginPage.php?msg=$msg&signUp=1");
            }
        }
    }
    if((empty($_POST['email']) or empty($_POST['pwd']) or empty($_POST['cap'])) and !isset($_POST['signUp'])){
        $msg= "kindly fill the information";
        header("Location:loginPage.php?msg=$msg");
    }
}

mysqli_close($conn);
?>
