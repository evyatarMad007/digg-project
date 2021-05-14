<?php
session_start();
require_once 'app/helpers.php';
$page_title = 'About Us';

?>
<?php get_header() ?>

<main class="mh-900">
    <div class="container-fluid">
        <div class="container">

            <section id="about-digg-content">
                <div class="row mt-5">
                    <div class="col-12 mt-5">
                        <h1 class="display-4">About Digg Site</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
            </section>

            <section id="more-about-digg">
                <div class="row">
                    <div class="col-12">
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Qui nostrum facere eveniet.</p>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Qui nostrum facere eveniet.</p>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Qui nostrum facere eveniet.</p>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Qui nostrum facere eveniet.</p>
                    </div>
                </div>
            </section>

        </div>
    </div>
</main>

<?php get_footer() ?>