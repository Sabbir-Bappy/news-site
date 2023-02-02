<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">

                <?php
                require_once("config.php");
                $eid = $_REQUEST['eid'];

                $sql = "SELECT * FROM post  /* post.post_id,post.title,post.description,post.post_img,category.category_name,post.category   */                                     
                LEFT JOIN category ON post.category = category.category_id
                LEFT JOIN user ON post.author = user.user_id
                WHERE post.post_id='$eid'";
                $run = $config->query($sql) or die("Querry failed");
                if (mysqli_num_rows($run) > 0) {
                    while ($data = mysqli_fetch_array($run)) {

                ?>

                        <!-- Form for show edit-->
                        <form action="core/save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group">
                                <input type="hidden" name="post_id" class="form-control" value=" <?php echo $data['post_id']; ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputTile">Title</label>
                                <input type="text" name="post_title" class="form-control" id="exampleInputUsername" value=" <?php echo $data['title']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"> Description</label>
                                <textarea name="postdesc" class="form-control" required rows="5">
                                 <?php echo $data['description']; ?>
                              </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputCategory">Category</label>
                                <select class="form-control" name="category">
                                    <?php
                                    require_once("config.php");
                                    $sql1 = "SELECT * FROM category";
                                    $run1 = $config->query($sql1) or die("Querry failed");
                                    if (mysqli_num_rows($run1) > 0) {
                                        while ($result = mysqli_fetch_array($run1)) {
                                            if ($data['category'] == $result['category_id']) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }

                                            echo "<option {$selected} value={$result['category_id']}>{$result['category_name']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="old_category" value="<?php echo $data['category'] ?>">

                            </div>
                            <div class="form-group">
                                <label for="">Post image</label>
                                <input type="file" name="new-image">
                                <img src="upload/<?php echo $data['post_img']; ?>" height="150px">
                                <input type="hidden" name="old-image" value="<?php echo $data['post_img']; ?>">
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                        </form>
                        <!-- Form End -->
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>