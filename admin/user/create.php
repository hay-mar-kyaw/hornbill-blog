<?php
    $nameErr="";
    $emailErr="";
    $passwordErr="";
    if(isset($_POST['userCreateBtn'])){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $role=$_POST['role'];

        if($name===''){
            $nameErr="*Name field is required";
        }elseif($email===''){
            $emailErr="*Email field is required";
        }elseif($password===''){
            $passwordErr="*Password field is required";
        }else{
            $password=md5($password);
            $stmt=$db->prepare("INSERT INTO users(name,email,password,role) VALUES('$name','$email','$password','$role')");
            $result=$stmt->execute();
            if($result){
                echo"<script>sweetAlert('registered','users')</script>" ; 
            }
        }

        
    }


?>

<div class="container-fluid">

<!-- Page Heading -->
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">User Creation Form</h6>
                                <a href="index.php?page=categories" class="btn btn-sm btn-primary"><i class="fas fa-angle-double-left"></i> Back</a>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-2">
                                        <label for="">Name</label>
                                        <input type="text" name="name" class="form-control">
                                        <span class="text-danger"><?php echo $nameErr ; ?></span>
                                    </div>
                                    <div class="mb-2">
                                        <label for="">Email</label>
                                        <input type="email" name="email" class="form-control">
                                        <span class="text-danger"><?php echo $emailErr ; ?></span>
                                    </div>
                                    <div class="mb-2">
                                        <label for="">Role</label>
                                        <select name="role" id="" class="form-control">
                                            <option value="admin">admin</option>
                                            <option value="user">user</option>
                                        </select>
                                        
                                    </div>
                                    <div class="mb-2">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control">
                                        <span class="text-danger"><?php echo $passwordErr ; ?></span>
                                    </div>
                                    
                                    <button name="userCreateBtn" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
            </div>
        </div>
    </div>      
</div>              


                    