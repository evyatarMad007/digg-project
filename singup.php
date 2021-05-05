<?php

session_start();
if( isset($_SESSION['user_id']) ){
    header('location: blog.php' );
} 
require_once 'app/healpers.php';
$page_title = 'Sing Up';




// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
$errors = ['name' => '','email' => '','password' => '',];



if( isset($_POST['submit']) ){

    $name = !empty($_POST['name']) ? trim($_POST['name']) : '';
    $email = !empty($_POST['email']) ? trim($_POST['email']) : '';
    $password = !empty($_POST['password']) ? trim($_POST['password']) : '';
    $valid_form = true;
    $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);


    if( !$name || mb_strlen($name) < 2 || mb_strlen($name) > 70 ){
        $errors['name'] = '* Name is required for 2-70 chars';
        $valid_form = false;
    }
    if( !$email ){
        $errors['email'] = '* a valid email is required!';
        $valid_form = false;
    } elseif(email_exist($link, $email)){
        $errors['email'] = '* Email is taken';
        $valid_form = false;
    }


    if( !$password || mb_strlen($password) < 6 || mb_strlen($password) > 20 ){
        $errors['password'] = '* Password is required for 6-20 chars';
        $valid_form = false;
    }


    if($valid_form){
        // save data in mysql db 
        // הקוד הזה עם בעיות אבטחה כבדות
        $sql = "INSERT INTO users VALUE(null, '$name', '$email', '$password', 'empty', NOW())";
        $result = mysqli_query($link, $sql);

        // mysqli_effected_rows =  שורות מושפעות (בוצעו שינויים)
        //  במידה והנתונים נשמרו תרוץ הפרודצורה הבאה
        if( $result && mysqli_affected_rows($link) ){
            header('location: blog.php'); // מעביר את הגולש לדף שנבחר
        }

        if( $result && mysqli_affected_rows($link) ){
            //  במידה והנתונים נשמרו תרו. הפרודצורה הבאה
            $_SESSION['user_name'] = $name;
            $_SESSION['user_id'] = mysqli_insert_id($link); // שהתקבל אחרון בשורות למעלה ID בודקת מה ה

            header('location: blog.php'); // מעביר את הגולש לדף שנבחר
            // שרוצים url  ניתן להזין פה איזה 

            
        }
    }
}




?>
<?php get_header() ?>

<main class="mh-900"> 
        <div class="container-fluid">
            <div class="container">
        
            <section id="singup">
            <div class="row mt-5">
                    <div class="col-12 mt-5 text-center">
                        <h1 class="display-4">Sing up</h1>
                        <p>Opening an account is free</p>
                        <p>Have an account?<a href="singin.php">Sing In</a></p>
                    </div>
                </div>
                
            </section>

            <section id="signup-form-content">
                <div class="row" style="display: flex; justify-content: center;">
                    <div class="col-lg-4 mt-5">
                        <form id="singup-form" action="" method="POST" novalidate="novalidate">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="name" class="form-control" id="name" name="name" value="<?= old('name') ?>">
                                <span class="text-danger"><?= $errors['name']; ?></span> 
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>">
                                <span class="text-danger"><?= $errors['email']; ?></span>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <span class="text-danger"><?= $errors['password']; ?></span>
                            </div>
                            <button name="submit" type="submit" class="btn btn-primary">Sign Up</button>
                        </form>
                    </div>
                </div>
            </section>
        
            </div>
        </div>
    </main>

    <?php get_footer() ?>