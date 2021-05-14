<?php 

session_start();

if( ! isset($_SESSION['user_id']) ){
    header('location: signin.php');
}
require_once 'app/helpers.php';
$page_title = 'Add Post Page';
$errors = ['title' => '', 'article' => '',];

if( isset($_POST['submit']) ){

    $title = !empty($_POST['title']) ? trim($_POST['title']) : '';
    $article = !empty($_POST['article']) ? trim($_POST['article']) : '';
    $valid_form = true;
    

    if( !$title || mb_strlen($title) < 2 || mb_strlen($title) > 70 ){
        $errors['title'] = '* Title is required for minimum 2 chars';
        $valid_form = false;
    }
    if( !$article ){
        $errors['article'] = '* Article is required for minimum 10 chars';
        $valid_form = false;
    } 
    if($valid_form){
        $uid = $_SESSION['user_id'];
        $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
        $sql = "INSERT INTO posts VALUE(null, '$uid', '$title', '$article', NOW() )";
        $result = mysqli_query($link, $sql);
        
        if( $result && mysqli_affected_rows($link) ){
            header('location: blog.php');
        }
    }
}


?>

<?php get_header() ?>

<main class="mh-900">

    <div class="container-fluid">
        <div class="container">

            <section id="profile-content">
                <div class="row mt-5">
                    <div class="col-12 mt-5">
                        <h1 class="display-4">Profile Page</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
            </section>


            <section id="profile-form">
                <div class="row">
                    <div class="col-lg-4">
                        <form action="" method="POST" autocomplete="off" novalidate="novalidate">
                            <div class="mb-3">
                                <label for="fname" class="form-label">Edit name</label>
                                <input type="text" class="form-control" id="fname" name="fname"
                                    value="<?= old('fname'); ?>">
                                <!-- <span class="text-danger"><?= $errors['fname']; ?></span> -->
                            </div>
                            <div class="mb-3">
                                <label for="lname" class="form-label">Upload image profile</label>
                                <input type="text" class="form-control" id="lname" name="lname"
                                    value="<?= old('lname'); ?>">
                                <!-- <span class="text-danger"><?= $errors['lname']; ?></span> -->
                            </div>

                            <div class="mb-3">
                                <label for="lname" class="form-label">Change password</label>
                                <input type="text" class="form-control" id="lname" name="lname"
                                    value="<?= old('lname'); ?>">
                                <!-- <span class="text-danger"><?= $errors['lname']; ?></span> -->
                            </div>
                            <div class="mb-3">
                                <label for="lname" class="form-label">Confirm password</label>
                                <input type="text" class="form-control" id="lname" name="lname"
                                    value="<?= old('lname'); ?>">
                                <!-- <span class="text-danger"><?= $errors['lname']; ?></span> -->
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary">Save</button>
                            <a class="btn btn-secondary" href="blog.php">Cancel</a>
                        </form>
                    </div>
                </div>
            </section>

        </div>
    </div>
</main>

<?php get_footer() ?>