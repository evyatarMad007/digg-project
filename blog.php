<?php
session_start();
require_once 'app/healpers.php';
$page_title = 'Blog';

?>
<?php get_header() ?>

<main class="mh-900"> 

        <div class="container-fluid">
            <div class="container">
        
            <section id="blog-digg-content">
                <div class="row mt-5">
                    <div class="col-12 mt-5">
                        <h1 class="display-4">Write your Blog</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>


                        <?php if( isset($_SESSION['user_id']) ): ?>
                            <p><a class="btn btn-success" href="add_post.php">+ Add New Post</a></p>
                        <?php else: ?>
                            <p><a href="singup.php">Create free account and start digg</a></p>
                        <?php endif; ?>
                    
                    </div>
                </div>
            </section>
        
            </div>
        </div>
    </main>

    <?php get_footer() ?>