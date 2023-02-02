<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php
        require_once("admin/config.php");
        $sql = "SELECT * FROM post
       LEFT JOIN category ON post.category = category.category_id
       ORDER BY post.post_id DESC";

        $run = $config->query($sql) or die('Querry failed');
        if (mysqli_num_rows($run) > 0) {
            while ($data = mysqli_fetch_array($run)) {

        ?>

                <div class="recent-post">
                    <a class="post-img" href="single.php?id=<?php echo $data['post_id']; ?>">
                        <img src="admin/upload/<?php echo $data['post_img']; ?>" alt="" />
                    </a>
                    <div class="post-content">
                        <h5><a href="single.php?id=<?php echo $data['post_id']; ?>"><?php echo $data['title']; ?></a></h5>
                        <span>
                            <i class="fa fa-tags" aria-hidden="true"></i>
                            <a href='category.php?cid=<?php echo $data['category_id']; ?>'><?php echo $data['category_name']; ?></a>
                        </span>
                        <span>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?php echo $data['post_date']; ?>
                        </span>
                        <a class="read-more" href="single.php?id=<?php echo $data['post_id']; ?>">read more</a>
                    </div>
                </div>

        <?php
            }
        }
        ?>
    </div>
    <!-- /recent posts box -->
</div>