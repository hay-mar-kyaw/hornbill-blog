<?php

#select users for edit

$userId=$_GET['user_id'];
$stmt=$db->prepare("SELECT * FROM users WHERE id=$userId");
$stmt->execute();
$user=$stmt->fetchObject();

#Update user
    $nameErr="";
    $emailErr="";
    $passwordErr="";
    if(isset($_POST['userUpdateBtn'])){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $role=$_POST['role'];

        if($name===''){
            $nameErr="*Name field is required";
        }elseif($email===''){
            $emailErr="*Email field is required";
        }else{
            if($password==''){
                $stmt=$db->prepare("UPDATE users SET name='$name',email='$email',role='$role' WHERE id=$userId");
            }else{
                $password=md5($password);
                $stmt=$db->prepare("UPDATE users SET name='$name',email='$email',password='$password',role='$role' WHERE id=$userId");
            }
            $result=$stmt->execute();
            if($result){
                echo"<script>sweetAlert('updated a user information','users')</script>" ; 
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
                                        <input type="text" name="name" value="<?php echo $user->name ?>" class="form-control">
                                        <span class="text-danger"><?php echo $nameErr ; ?></span>
                                    </div>
                                    <div class="mb-2">
                                        <label for="">Email</label>
                                        <input type="email" name="email" value="<?php echo $user->email ?>" class="form-control">
                                        <span class="text-danger"><?php echo $emailErr ; ?></span>
                                    </div>
                                    <div class="mb-2">
                                        <label for="">Role</label>
                                        <select name="role" id="" class="form-control">
                                            <option value="admin"
                                                <?php if($user->role=='admin'): ?>   
                                                    selected
                                                <?php endif ?>      
                                            >Admin</option>
                                            <option value="user"
                                                <?php if($user->role=='user'): ?>
                                                    selected
                                                <?php endif ?>    
                                            >User</option>
                                        </select>
                                        
                                    </div>
                                    <div class="mb-2">
                                        <label for="">Password</label>
                                        <input type="checkbox" onclick="showPasswordInput()" id="checkbox">
                                        <input type="password" name="password" placeholder="Enter new password" class="form-control" id="passwordInput" style="display:none;">
                                        <span class="text-danger"><?php echo $passwordErr ; ?></span>
                                    </div>
                                    
                                    <button name="userUpdateBtn" class="btn btn-primary">Update</button>
                                </form>
                            </div>
            </div>
        </div>
    </div>      
</div>   

<script>
    function showPasswordInput(){
        let checkbox=document.getElementById('checkbox');
        if(checkbox.checked)
        {
            document.getElementById('passwordInput').style.display="block"
        }else{
            document.getElementById('passwordInput').style.display="none"
        }
       
    }
</script>


                    