<?php
    $nameErr="";
    if(isset($_POST['categoryCreateBtn'])){
        $name=$_POST['name'];
        if($name === ''){
            $nameErr="* Name field is required";
        }else{
            $stmt=$db->prepare("INSERT INTO categories(name) VALUES('$name')");
            $stmt->execute();
            //Change route with JS
        echo"<script>sweetAlert('created a category','categories')</script>" ;               
        }
    }
?>

<div class="container-fluid">

<!-- Page Heading -->
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Category Creation Form</h6>
                                <a href="index.php?page=categories" class="btn btn-sm btn-primary"><i class="fas fa-angle-double-left"></i> Back</a>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-2">
                                        <label for="">Name</label>
                                        <input type="text" name="name" class="form-control">
                                        <span class="text-danger"><?php echo $nameErr ; ?></span>
                                    </div>
                                    
                                    <button name="categoryCreateBtn" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
            </div>
        </div>
    </div>      
</div>              


                    