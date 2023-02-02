<?php
require_once("config.php");
session_start();
if (isset($_SESSION['username'])) {
    header("location:post.php");
}

?>


<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN | Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../css/style.css">
    
</head>

<body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="js/main.js"></script>


    <div id="wrapper-admin" class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <img class="logo" src="images/news.jpg">
                    <h3 class="heading">Admin</h3>
                    <!-- Form Start -->
                    <form action="" method="POST">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="" required>
                        </div>
                        <input type="submit" name="login" class="btn btn-primary" value="login" />
                    </form>
                    <!-- /Form  End -->

                    <?php
                    //require_once("config.php");


                    if (isset($_POST['login'])) {
                        require_once("config.php");
                        $username = mysqli_real_escape_string($config, $_POST['username']);
                        $password = md5($_POST['password']);

                        $sql = "SELECT user_id, username, role FROM user WHERE username='$username' AND password='$password'";

                        $run = $config->query($sql) or die('querry Failed');
                        if (mysqli_num_rows($run) > 0) {

                            while ($data = mysqli_fetch_array($run)) {
                                session_start();
                                $_SESSION['username'] = $data['username'];
                                $_SESSION['user_id'] = $data['user_id'];
                                $_SESSION['user_role'] = $data['role'];

                                header("location:post.php");
                            }
                        } else {
                            echo '<div class="alert alert-danger">Username & Password incorrect</div>';
                        }
                    }

                    ?>

                </div>
                
            </div>
        </div>
    </div>
</body>

</html>