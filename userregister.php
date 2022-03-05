<?php

require './db/connect.php';
$obj = new User();
if(isset($_POST['sbtn']))
{
    $name = $obj->validate($_POST['name']);
    $email =  $obj->validate($_POST['email']);
    $pass =  sha1($_POST['password']);
    $mb =  $obj->validate($_POST['mb']);
    $address =  $obj->validate($_POST['address']);
    $photo = time() .$_FILES['photo']['name'];


    if($photo)
    {
        move_uploaded_file($_FILES['photo']['tmp_name'],"userimg/".$photo);
        $condition_arr=array('user_name'=>$name,'user_email'=>$email,'user_password'=>$pass,'user_mobile'=>$mb,'user_address'=>$address,'user_photo'=>$photo);
        $result = $obj->insert("tbl_user",$condition_arr);
        return $result;
    }else
    {
        move_uploaded_file($_FILES['photo']['tmp_name'],$photo);
        $condition_arr=array('user_name'=>$name,'user_email'=>$email,'user_password'=>$pass,'user_mobile'=>$mb,'user_address'=>$address);
        $result = $obj->insert("tbl_user",$condition_arr);
        return $result;
    }

  
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
    Name<input type="name" name="name"><br>
    Email<input type="name" name="email"><br>
    Password<input type="name" name="password"><br>
    Mobile<input type="name" name="mb"><br>
    Address<input type="name" name="address"><br>
    Photo<input type="file" name="photo"><br>
    <input type="submit" name="sbtn">

    </form>
</body>
</html>