<?php 
    $stmt=$db->prepare("SELECT * FROM categories");
    $stmt->execute();
    $categories=$stmt->fetchAll(PDO::FETCH_OBJ);

    if(isset($_POST['categoryDeleteBtn'])){
        $category_id=$_POST['category_id'];

        $stmt=$db->prepare("DELETE FROM categories WHERE id=$category_id");
        $stmt->execute();

        echo"<script>sweetAlert('deleted a category','categories')</script>" ;  
                
    }

    

?>
<div class="container-fluid">

<!-- Page Heading -->
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                                    <a href="index.php?page=categories-create" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add New</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Actions</th>
                                                    
                                            </thead>
                                            
                                            <tbody>
                                                <?php 
                                                    $i=1;
                                                    foreach($categories as $category):
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $category->name ?></td>
                                                    <td>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="category_id" value="<?php echo $category->id ?>">
                                                            <a href="index.php?page=categories-edit&category_id=<?php echo $category->id ?>" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>
                                                            <button name="categoryDeleteBtn" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete')"><i class="far fa-trash-alt"></i></button>
                                                        </form>
                                                        
                                                    </td>
                                                </tr>  
                                                <?php
                                                    endforeach    
                                                ?>
                                                  
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
            </div>
        </div>
    </div>
</div>