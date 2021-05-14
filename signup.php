<?php

session_start();
if( isset($_SESSION['user_id']) ){
    header('location: blog.php');
} 

require_once 'app/helpers.php';
$page_title = 'Sign Up';
$errors = ['name' => '', 'email' => '', 'password' => '', 'image' => '',];
define('ALLOWED_EXT',['png','jpg','jpeg','gif','bmp']); // סוגי הקבצים שאנו מסכימים לעלות
$image_name = 'default-profile.png'; // תמונה דיפולטיבית
define('MAX_FILE_SIZE', 1024 * 1024 * 5);



if( isset($_POST['submit']) ){

    // security = xss attack & validation:
    $name=filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $name=trim($name);
    $email=filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
    $email=trim($email);
    $password=filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
    $password=trim($password);
    // -----------------------------------------------------------------------------------
    $valid_form = $uploaded_image =  true; // אם הוא העלה כבר קובץ חובה שיהיה תקין
    $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
    // security = sql injection:
    $name = mysqli_real_escape_string($link,$name);
    $email = mysqli_real_escape_string($link,$email);
    $password = mysqli_real_escape_string($link,$password);
    // -----------------------------------------------------------------------------------

    if( !$name || mb_strlen($name) < 2 || mb_strlen($name) > 70 ){
        $errors['name'] = '* Name is required for 2-70 chars';
        $valid_form = false;
    }
    if( !$email ){
        $errors['email'] = '* a valid email is required!';
        $valid_form = false;
    }
     elseif(email_exist($link, $email)){
        $errors['email'] = '* Email is taken';
        $valid_form = false;
    }

    if( !$password || mb_strlen($password) < 6 || mb_strlen($password) > 20 ){
        $errors['password'] = '* Password is required for 6-20 chars';
        $valid_form = false;
    }

    if( isset($_FILES['image']['error']) && $_FILES['image']['error'] === 0 ){
        
        if(   isset($_FILES['image']['size']) && $_FILES['image']['size'] <= MAX_FILE_SIZE  ){
            
            if( isset($_FILES['image']['name']) ){ 

                $file_info = pathinfo($_FILES['image']['name']); // של הקובץ extantion  עם ה key  מפרק את שם הקובץ לגורמים, ומייצר לנו 
                

                if( in_array(strtolower($file_info['extension']), ALLOWED_EXT) ){ 
                // בודק אם הסיומת הזו נמצאת במערך
                // באותיות גדולות או קטנות extantion ממיר לאותיות קטנות, כי לא משנה אם ה
                
                    if( is_uploaded_file($_FILES['image']['tmp_name']) ){ 
                        // PHP רק במידה אם הוא העלה לנו קובץ שנמצא בזכרון הזמני של 
                        // txt וזה על מנת שהאקרים לא יזינו של של קבצים סודיים בשרת שלנו ויקבלו אותם כקובץ 
                        // לכן אנו מאפשרים גישה רק לקובץ שנמצא בזכרון הזמני
                        
                        $image_name = date('d.m.Y.H.i.s') . '-' . str_random(5) . '-' . $_FILES['image']['name'];
                        move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image_name);
                        
                    } else {
                        $uploaded_image = false;
                    }

                    
                } else {
                  $uploaded_image = false;
                }
        
              }
        
        }
         else {
            $uploaded_image = false;
        }
    }

    if( ! $uploaded_image ){
        $errors['image'] = '* Profile Image must be an image (max 5MB)';
    }
    

    if($valid_form && $uploaded_image){
        
        
        // @@@@@@@@@@ db insert 
        $image_name = mysqli_real_escape_string($link, $image_name);
        $password = password_hash($password, PASSWORD_BCRYPT); // verify שנבדקת רק ע''י פונקציית  HASH הצפנת הסיסמא ע''י פונקציית 
        // save data in mysql db 
        $sql = "INSERT INTO users VALUES(null, '$name', '$email', '$password', '$image_name')";
        $result = mysqli_query($link, $sql);
        // mysqli_effected_rows =  שורות מושפעות (בוצעו שינויים)
        //  במידה והנתונים נשמרו תרוץ הפרודצורה הבאה
        
        if( $result && mysqli_affected_rows($link) ){
            //  במידה והנתונים נשמרו תרוץ הפרודצורה הבאה
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

            <section id="signup">
                <div class="row mt-5">
                    <div class="col-12 mt-5 text-center">
                        <h1 class="display-4">Sign up</h1>
                        <p>Opening an account is free</p>
                        <p>Have an account?<a href="signin.php">Sign In</a></p>
                    </div>
                </div>

            </section>

            <section id="signup-form-content">
                <div class="row" style="display: flex; justify-content: center;">
                    <div class="col-lg-4 mt-5">
                        <form id="signup-form" action="" method="POST" novalidate="novalidate"
                            enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label">* Name</label>
                                <input type="name" class="form-control" id="name" name="name"
                                    value="<?= old('name') ?>">
                                <span class="text-danger"><?= $errors['name']; ?></span>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">* Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?= old('email') ?>">
                                <span class="text-danger"><?= $errors['email']; ?></span>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">* Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <span class="text-danger"><?= $errors['password']; ?></span>
                            </div>
                            <div class="mb-3">
                                <label for="image-profile" class="form-label">Profile image</label>
                                <input name="image" class="form-control" type="file" id="image-profile">
                                <span class="text-danger"><?= $errors['image']; ?></span>
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