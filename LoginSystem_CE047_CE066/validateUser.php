<?php
    $flag=false;
    $sql="SELECT * FROM `users` ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
        if($uname==$row['username']){
            $flag=true;
        }
    }
    if(!$flag){
        header("Location:forgotPassword.php?msg=invalid username");
    }
if(isset($_GET['msg'])){
    echo $_GET['msg'];
}
else{
    header("Location:forgotPassword.php?usernameValid=1&uname=$uname");
}
echo $uname;
?>