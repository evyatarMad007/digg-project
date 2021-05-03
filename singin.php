<?php

require_once 'app/healpers.php';
$page_title = 'Sing In';

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
              <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <button name="submit" type="submit" class="btn btn-primary">Sign In</button>
          </form>
        </div>
      </div>
    </section>

        
            </div>
        </div>
    </main>

    <?php get_footer() ?>