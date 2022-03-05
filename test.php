<?php

require './connect.php';

$obj = new User();
$condition_arr=array('user_name'=>'lalit','user_email'=>'lalit258@gmail.com','user_password'=>'123','user_mobile'=>'964305533','user_address'=>'ahmedabad','user_photo'=>'aki.jpg');

//$result = $obj->insert('tbl_user',$condition_arr);

$result = $obj->update('tbl_user',$condition_arr,'user_id','1');
echo "<pre>";
print_r($result);

?>