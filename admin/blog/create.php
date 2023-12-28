<?php

    #get categories list
    $catStmt=$db->prepare("SELECT * FROM categories");
    $catStmt->execute();
    $categories=$catStmt->fetchAll(PDO::FETCH_OBJ);

    #create blog
    $titleErr="";
    $contentErr="";
    $imageErr="";
    $categoryErr="";
    if(isset($_POST['blogCreateBtn'])){
        $title=$_POST['title'];
        $categoryId=$_POST['category_id'];
        $content=$_POST['content'];
        $userId=$_SESSION['user']->id; //User Id ကို Login ဝင်တဲ့ User Id ယူသုံး
        $created_at=date('Y-m-d H:i:s');
              
        $imageName=$_FILES['image']['name'];
        $imageType=$_FILES['image']['type'];
        $imageTmp=$_FILES['image']['tmp_name'];

        if($title==''){
            $titleErr="*Title field is required";
        }elseif($categoryId==""){
            $categoryErr="*Category field is required";
        }elseif($content==''){
            $contentErr="*Content field is required";
        }elseif($imageName==''){
            $imageErr="*Image field is required";
        }else{
            $imageName=uniqid().'_'.$imageName;
            if(in_array($imageType,['image/png','image/jpg','image/jpeg'])){
                move_uploaded_file($imageTmp,"../assets/blog-images/$imageName");
            }
            $stmt=$db->prepare("INSERT INTO blogs(title,category_id,content,image,user_id,created_at) VALUES ('$title',$categoryId,'$content','$imageName',$userId,'$created_at')");
            $result=$stmt->execute();
            if($result){
                echo"<script>sweetAlert('created a blog','blogs')</script>" ; 
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
                                <h6 class="m-0 font-weight-bold text-primary">Blog Creation Form</h6>
                                <a href="index.php?page=blogs" class="btn btn-sm btn-primary"><i class="fas fa-angle-double-left"></i> Back</a>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="mb-2">
                                        <label for="">Title</label>
                                        <input type="text" name="title" class="form-control">
                                        <span class="text-danger"><?php echo $titleErr ; ?></span>
                                    </div>
                                    <div class="mb-2">
                                        <label for="">Category</label>
                                        <select name="category_id" id="" class="form-control">
                                            <?php foreach($categories as $category): ?>
                                            <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <span class="text-danger"><?php echo $categoryErr ; ?></span>
                                    </div>
                                    <div class="mb-2">
                                        <label for="">Content</label>
                                        <textarea name="content" id="" cols="30" rows="10" class="form-control"></textarea>
                                        <span class="text-danger"><?php echo $contentErr ; ?></span>
                                    </div>
                                    <div class="mb-2">
                                        <label for="">Image</label>
                                        <input type="file" name="image" class="form-control">
                                        <span class="text-danger"><?php echo $imageErr ; ?></span>
                                    </div>
                                    
                                    <button name="blogCreateBtn" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
            </div>
        </div>
    </div>      
</div>             
