<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                    $auther_id = $_GET["aid"];

                    $sql1 = "SELECT* FROM user WHERE user_id='{$auther_id}'";
                    $run1 = $config->query($sql1) or die("querry failed");
                    $result = mysqli_fetch_array($run1);

                    ?>
                    <h2 class="page-heading"><?php echo $result['username']; ?></h2>

                    <?php

                    require_once("admin/config.php");
                    $sql = "SELECT * FROM post
                    LEFT JOIN category ON post.category = category.category_id
                    LEFT JOIN user ON post.author = user.user_id
                    WHERE post.author='{$auther_id}'
                    ORDER BY post.post_id DESC";



                    $run = $config->query($sql) or die('Querry failed');
                    if (mysqli_num_rows($run) > 0) {
                        while ($data = mysqli_fetch_array($run)) {
                    ?>

                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?id=<?php echo $data['post_id']; ?>"><img src="admin/upload/<?php echo $data['post_img']; ?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?php echo $data['post_id']; ?>'><?php echo $data['title']; ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php?aid=<?php echo $data['category_id']; ?>'><?php echo $data['category_name']; ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a><?php echo $data['username']; ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo $data['post_date']; ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php echo substr($data['description'], 0, 120) . "...."; // substr use for limit the text(description) 
                                                ?>
                                            </p>
                                            <a class='read-more pull-right' href='single.php?id=<?php echo $data['post_id']; ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                    <?php
                        }
                    }
                    ?>

                    <ul class='pagination'>
                        <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                    </ul>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>