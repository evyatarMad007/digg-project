<?php 

session_start();

if( ! isset($_SESSION['user_id']) ){
    header('location: singin.php');
}
require_once 'app/healpers.php';
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
        
            <section id="add-post-content">
                <div class="row mt-5">
                    <div class="col-12 mt-5">
                        <h1 class="display-4">Add new Post</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
            </section>

            <section id="new-post-form">
      <div class="row">
        <div class="col-lg-6">
          <form action="" method="POST" autocomplete="off" novalidate="novalidate">
            <div class="mb-3">
              <label for="title" class="form-label">* Title</label>
              <input type="text" class="form-control" id="title" name="title" value="<?= old('title'); ?>">
              <span class="text-danger"><?= $errors['title']; ?></span>
            </div>
            <div class="mb-3">
              <label for="article" class="form-label">* Article</label>
              <textarea class="form-control" name="article" id="article" cols="30"
                rows="10"><?= old('article'); ?></textarea>
                <span class="text-danger"><?= $errors['article']; ?></span>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Save Post</button>
            <a class="btn btn-secondary" href="blog.php">Cancel</a>
          </form>
        </div>
      </div>
    </section>

        
            </div>
        </div>
    </main>

<?php get_footer() ?>