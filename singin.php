<?php
session_start();
if( isset($_SESSION['user_id']) ){
  header('location: blog.php' );
} 
require_once 'app/healpers.php';
$page_title = 'Sing In';
$error = '';

if( isset($_POST['submit']) ){ // when submit is clicked (and sending data to post object)
  $email = !empty($_POST['email']) ? trim($_POST['email']) : '';
  $password = !empty($_POST['password']) ? trim($_POST['password']) : '';

  if(! $email){ // if email empty

    $error = '* email is required';
    
  }
  else if(! $password){ // if password empty

    $error = '* Password is required';

  } 
  else { // if all not empty

    $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($link, $sql);
    
      if( $result && mysqli_num_rows($result) ){ // If the data is equal to one of the existing data in DB
        
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_id'] = $user['id'];
        header('location: blog.php');

      } else { // If the data is incorrect
        $error = '* Email or password are incorect!';
      }
  }
}

?>
<?php get_header() ?>

<main class="mh-900"> 
        <div class="container-fluid">
            <div class="container">
        
            <section id="singin-to-dig">
                <div class="row mt-5">
                    <div class="col-12 mt-5 text-center">
                        <h1 class="display-4">Sing in</h1>
                        <p>Don't have an account yet?<a href="singup.php">create one now</a></p>
                    </div>
                </div>
            </section>


        <section id="signin-form-content">
      <div class="row">
        <div class="col-lg-6">
          <form id="signin-form" action="" method="POST" novalidate="novalidate">
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="<?= old('email'); ?>">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <button name="submit" type="submit" class="btn btn-primary">Sign In</button>
            <span class="text-danger"><?= $error; ?></span>
          </form>
        </div>
      </div>
    </section>

        
            </div>
        </div>
    </main>

    <?php get_footer() ?>