<?php
require_once("../config.php");
$did = $_REQUEST['did'];
$cat_id = $_REQUEST['catid'];

$sql1 = "SELECT * FROM post WHERE post_id='$did'";
$run = $config->query($sql1);
while ($data = mysqli_fetch_array($run)) {
    unlink("../upload/" . $data['post_img']); // for remove photos from folder
}




$sql = "DELETE FROM post WHERE post_id='$did';";
$sql .= "UPDATE category SET post=post-1 WHERE category_id='$cat_id'";

//$run = $config->mysqli_multi_query($sql);

if (mysqli_multi_query($config, $sql)) {
    header("location:../post.php");
} else {
    echo "Querry failed";
}
