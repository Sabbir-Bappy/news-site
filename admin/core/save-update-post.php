<?php

require_once("../config.php");

if (empty($_FILES['new-image']['name'])) {
    $file_name = $_POST['old-image'];
} else {
    $error = array();

    $file_name = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $file_tmp = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
    $file_ext = end(explode('.', $file_name));
    $extension = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $extension) === false) {
        // in array used for search value in array. here file_ext search value in $extension
        $error[] = "This file not supported. Please choose png or Jpeg file";
    }
    if ($file_size > 2097152) {
        $error[] = "File size must be 2mb or lower";
    }
    if (empty($error)) {
        move_uploaded_file($file_tmp, "upload/" . $file_name);
    } else {
        print_r($error);
        die();
    }
}
    session_start();
    $title = mysqli_real_escape_string($config, $_REQUEST['post_title']);
    $postdesc = mysqli_real_escape_string($config, $_POST['postdesc']);
    $category = mysqli_real_escape_string($config, $_POST['category']);
    $post_id = mysqli_real_escape_string($config, $_POST['post_id']);

    $sql = "UPDATE post SET title='$title',description='$postdesc',category='$category',post_img='$file_name'WHERE post_id='$post_id';";
    if ($_REQUEST['old_category'] != $_POST['category']) {
        $sql .= "UPDATE category SET post=post-1 WHERE category_id='{$_REQUEST['old_category']}';";
        $sql .= "UPDATE category SET post=post+1 WHERE category_id='{$_POST['category']}';";  // for post count
    }

    $run = $config->multi_query($sql);
    if ($run == true) {
        header("location:../post.php");
    } else {
        echo "Querry Failed";
    }
   