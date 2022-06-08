<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/d0d49aaf67.js" crossorigin="anonymous"></script>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
        <body>
        <form method='post' action="<?php echo $_SERVER['PHP_SELF'] ;?>">
            <label for="pwd">Create New Password : </label>
            <input type='password' name='pwd' id='pwd'/>
            <button type='button' name='pwd' id='show' onclick="return password()"><i id='icon' class="fa-regular fa-eye" name='show'></i></button><br>
            <label for="cpwd">Confirm Password : </label>
            <input type='password' name='cpwd' id='cpwd'/>
            <button type='button' name='cpwd' id='cshow' onclick="return cpassword()"><i id='cicon' class="fa-regular fa-eye" name='show'></i></button>
            <button type='submit' name="change" id='change'>Change Password </button>
            <input type='hidden' name='uname' value="<?php echo $_GET['uname']; ?>">
        </form>
    </body>
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
</html>