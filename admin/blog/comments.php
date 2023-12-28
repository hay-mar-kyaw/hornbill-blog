<?php 
    $blogId=$_GET['blog_id'];

    #show comment depend on blog
    $stmt=$db->prepare("SELECT comments.id,comments.text,comments.created_at,users.name FROM comments INNER JOIN users ON comments.user_id=users.id WHERE comments.blog_id=$blogId ORDER BY comments.id DESC");
    $stmt->execute();
    $comments=$stmt->fetchAll(PDO::FETCH_OBJ);
?>
<div class="container-fluid">

<!-- Page Heading -->
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Comment List</h6>
                                    <a href="index.php?page=blogs" class="btn btn-sm btn-primary"><i class="fas fa-angle-double-left"></i> Back</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <?php if(count($comments) >=1): ?>
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>User</th>
                                                    <th>Comment</th>
                                                    <th>Created at</th>
                                                </tr>    
                                           </thead>
                                            
                                            <tbody>
                                                <?php 
                                                    $i=1;
                                                    foreach($comments as $comment):
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $comment->name ?></td>
                                                    <td><?php echo $comment->text ?></td>
                                                    <td><?php echo $comment->created_at ?></td>
                                                    
                                                </tr>  
                                                <?php
                                                    endforeach    
                                                ?>
                                                  
                                            </tbody>
                                        </table>
                                        <?php else: ?>
                                            No comment
                                        <?php endif ?>
                                    </div>
                                </div>                 
                                
            </div>
        </div>
    </div>
</div>
