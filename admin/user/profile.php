<?php
    $userId=$_SESSION['user']->id;
    $stmt=$db->prepare("SELECT * FROM users WHERE id=$userId");
    $stmt->execute();
    $user=$stmt->fetchObject();
?>

<div class="container-fluid">

<!-- Page Heading -->
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">User Profile</h6>
                                
                            </div>
                            <div class="card-body">
                                
                                    <div class="mb-2">
                                        <label for="">Name</label>
                                        <input type="text" name="name" class="form-control" value="<?php echo $user->name ?>" disabled>
                                        
                                    </div>
                                    <div class="mb-2">
                                        <label for="">Email</label>
                                        <input type="email" name="email" class="form-control" value="<?php echo $user->email ?>" disabled>
                                        
                                    </div>
                                    <div class="mb-2">
                                        <label for="">Role</label>
                                        <input type="role" name="role" class="form-control" value="<?php echo $user->role ?>" disabled>
                                        
                                    </div>
                                    
                            </div>
            </div>
        </div>
    </div>      
</div>              


                    