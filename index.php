<?php
session_start();
require_once 'app/healpers.php';
$page_title = 'Home Page';

?>
<?php get_header() ?>

<main class="mh-900"> 
        <div class="container-fluid">
            <div class="container">
        
            <section id="join-us">
                <div class="row mt-5">
                    <div class="col-12 text-center mt-5">
                        <h1 class="display-4">Welcome to Dig Site!</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, officiis?</p>
                        <p class="mt-4">
                            <a class="btn btn-outline-warning btn-lg" href="singup.php" >Join us and start Digg</a>
                        </p>
                    </div>
                </div>
            </section>
        
            <section id="about-dig">
                <div class="row">
                    <div class="col-12 mt-5">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum mollitia nesciunt amet nam explicabo rem totam placeat beatae dolores, quia quasi ea praesentium veritatis ut nobis, impedit dolor dolorum necessitatibus!</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum mollitia nesciunt amet nam explicabo rem totam placeat beatae dolores, quia quasi ea praesentium veritatis ut nobis, impedit dolor dolorum necessitatibus!</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum mollitia nesciunt amet nam explicabo rem totam placeat beatae dolores, quia quasi ea praesentium veritatis ut nobis, impedit dolor dolorum necessitatibus!</p>
                    </div>
                </div>
            </section>

            </div>
        </div>
    </main>

    <?php get_footer() ?>