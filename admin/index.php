<?php 
    ob_start();
    session_start();
    if(!isset($_SESSION['user'])){
        header('location:../index.php');
    }else{
        if($_SESSION['user']->role !== 'admin'){
            header('location:../index.php');
        }
    }
    require_once('layout/header.php');

    // get table count 
    function getRowCount($table){
        global $db;
        $stmt=$db->prepare("SELECT COUNT(*) as blog_count FROM $table");
        $stmt->execute();
        $data=$stmt->fetchObject();

        return $data;
    }

    //get row count of table
    $category=getRowCount('categories');
    $blog=getRowCount('blogs');
    $comment=getRowCount('comments');
    $user=getRowCount('users');


?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php 
            require_once('layout/sidebar.php');

        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php 
                    require_once('layout/topnavbar.php');

                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <?php 
                    if($_SERVER['QUERY_STRING']):
                        switch($_REQUEST['page']){
                            case 'categories':
                                require_once('category/index.php');
                            break;   
                            case 'categories-create':
                                require_once('category/create.php');
                            break;
                            case 'categories-edit':
                                require_once('category/edit.php');  
                            break;
                            case 'blogs':
                                require_once('blog/index.php');
                            break;
                            case 'blogs-create':
                                require_once('blog/create.php');
                            break;
                            case 'blogs-edit':
                                require_once('blog/edit.php');
                            break; 
                            case 'blogs-comments':
                                require_once('blog/comments.php');
                            break;               
                            case 'users':
                                require_once('user/index.php');
                            break;
                            case 'users-create':
                                require_once('user/create.php');
                            break;
                            case 'users-edit':
                                require_once('user/edit.php');
                            break;
                            case 'users-profile':
                                require_once('user/profile.php');
                            break;                   
                        }
                    else:
                ?>
                    <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Categories Count -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Categories</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $category->blog_count ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blogs Count -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Blogs</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $blog->blog_count ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Count -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Users
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $user->blog_count ?></div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Comments Count -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Comments</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $comment->blog_count ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


                    </div>
                <?php
                    endif    
                ?>
                
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php 
                require_once('layout/copyright.php');
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

<?php 

    require_once('layout/footer.php');

?>    