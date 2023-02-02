<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-post.php">add post</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">

                    <thead>
                        <th>S.No.</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Author</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>

                    <?php
                    require_once("config.php");

                    if ($_SESSION['user_role'] == "1") {  // admin see all post but normal user dont see all post 
                        $sql = "SELECT * FROM post
                        LEFT JOIN category ON post.category = category.category_id
                        LEFT JOIN user ON post.author = user.user_id
                        ORDER BY post.post_id DESC";
                    } elseif ($_SESSION['user_role'] == "0") {
                        $sql = "SELECT * FROM post
                        LEFT JOIN category ON post.category = category.category_id
                        LEFT JOIN user ON post.author = user.user_id
                        WHERE post.author={$_SESSION['user_id']}
                        ORDER BY post.post_id DESC";
                    }


                    $run = $config->query($sql) or die("Querry failed");
                    $c = 1;
                    if (mysqli_num_rows($run) > 0) {
                        while ($data = mysqli_fetch_array($run)) {

                    ?>
                            <tbody>
                                <tr>
                                    <td class='id'><?php echo $c; ?></td>
                                    <td><?php echo $data['title']; ?></td>
                                    <td><?php echo $data['category_name']; ?></td>
                                    <td><?php echo $data['post_date']; ?></td>
                                    <td><?php echo $data['username']; ?></td>
                                    <td class='edit'><a href='update-post.php?eid=<?php echo $data['post_id']; ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='core/delete-post.php?did=<?php echo $data['post_id']; ?>&catid=<?php echo $data['category_id']; ?>'>
                                            <i class='fa fa-trash-o'></i></a></td>
                                </tr>
                            </tbody>
                    <?php $c++;
                        }
                    }
                    ?>
                </table>
                <ul class='pagination admin-pagination'>
                    <li class="active"><a>1</a></li>
                    <li><a>2</a></li>
                    <li><a>3</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>