<?php 

session_start();

if( ! isset($_SESSION['user_id']) ){
    header('location: singin.php');
}
require_once 'app/healpers.php';
$page_title = 'Add Post Page';
$errors = ['title' => '', 'article' => '',];

if( isset($_POST['submit']) ){

    // security - xss attack  
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $title = trim($title); // trim clean
    $article = filter_input(INPUT_POST, 'article', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $article = trim($article); // trim clean
    // -------------------------------
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
        // security = sql injection:
        $title = mysqli_real_escape_string($link,$title);
        $article = mysqli_real_escape_string($link,$article);
        // ---------------------------
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
                <div class="row mt-5 text-center">
                    <div class="col-12 mt-5">
                        <h1 class="display-4">Add new Post</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
            </section>

            <section id="new-post-form">
                <div class="row" style="display: flex; justify-content: center;">
                    <div class="col-lg-4 mt-3">
                        <form action="" method="POST" autocomplete="off" novalidate="novalidate">
                            <div class="mb-3">
                                <label for="title" class="form-label">* Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="<?= old('title'); ?>">
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