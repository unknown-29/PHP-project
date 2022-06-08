<?php
    if(isset($_POST['logout'])){
        header("Location:logout.php");
    }
?>
<?php
    session_start();
    $x=explode('@',$_SESSION['name']);
    $y=explode('.',$_SESSION['name']);
    $z= "$y[0]"."$y[1]";
    $name=$_SESSION['name'];
?>
<?php
    if(isset($_POST['save'])){
        // echo $_POST['notes'];
        // $t=false;
        // echo $y[0];
        session_start();
        $notes=$_POST['notes'];
        if(!empty($notes)){
            setcookie($z,$notes,time()+60*60);
            // setcookie('name',$notes,time()+60*60);
        }
        // echo $_COOKIE['name'];
    }
?>
<?php if (isset($_SESSION['name'])):?>
    <link rel="stylesheet" href="StyleSheetLogin.css">
    <body style="margin-left:40vh;margin-top:20vh;border-color:yellow;">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <p style="color: tomato; width:100vh;font-size:8vh;line-height:3vh;word-spacing:1vh;font-weight:bold;text-align:center;">Welcome, <?= $x[0] ?> </p>
    </body>
    <label for='notes' style="position:relative; bottom:2vh;">Notes:</label></br>
    <textarea name='notes' id='note'><?php if($_SERVER['REQUEST_METHOD']=='POST'){echo $_POST['notes'];}else{echo $_COOKIE[$z];}?></textarea></br>
    <input id='save' name='save' value='save' type="submit">
    <input type="submit" value="logout" name='logout'>
    </form>
<?php endif; ?>