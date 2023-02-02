<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <?php
                require_once("admin/config.php");
                $post_id = $_REQUEST['id'];

                $sql = "SELECT * FROM post
                    LEFT JOIN category ON post.category = category.category_id
                    LEFT JOIN user ON post.author = user.user_id
                    WHERE post_id='$post_id'
                    ORDER BY post.post_id DESC";

                $run = $config->query($sql) or die('Querry failed');
                if (mysqli_num_rows($run) > 0) {
                    while ($data = mysqli_fetch_array($run)) {

                ?>
                        <div class="post-container">
                            <div class="post-content single-post">
                                <h3><?php echo $data['title']; ?></h3>
                                <div class="post-information">
                                    <span>
                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                        <?php echo $data['category_name']; ?>
                                    </span>
                                    <span>
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <a href='author.php?aid=<?php echo $data['user_id']; ?>'><?php echo $data['username']; ?></a>
                                    </span>
                                    <span>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <?php echo $data['post_date']; ?>
                                    </span>
                                </div>
                                <img class="single-feature-image" src="admin/upload/<?php echo $data['post_img']; ?>" alt="" />
                                <p class="description">
                                    <?php echo $data['description']; ?>
                            </div>
                        </div>
                        <!-- /post-container -->
                <?php
                    }
                }
                ?>
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>