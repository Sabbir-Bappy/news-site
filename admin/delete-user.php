<?php
if ($_SESSION['user_role'] == "0") {
    header("location:post.php");
}

require_once("config.php");
$did= $_REQUEST['did'];
$sql="DELETE FROM `user` WHERE `user`.`user_id` ='$did'";
$run=$config->query($sql);
if($run==true){

    header("location:users.php?Data Deleted");
}









?>