<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- meta description need for SEO  -->
    <title>Digg | <?= $page_title; ?></title>
    <!-- css link - boostrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary  text-light">
            <div class="container">

                <a class="navbar-brand" href="./">Digg</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="blog.php">Blog</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <?php if( ! isset($_SESSION['user_id']) ): ?>

                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="signin.php">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="signup.php">Sign Up</a>
                        </li>
                        <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="profile.php"><span
                                    style="color: lime; display:inline-flex; align-items: center; margin-right: 5px; transform: scale(2); width: max-content; height: 20px;">•</span><?= htmlentities($_SESSION['user_name']); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="logout.php">Logout</a>
                        </li>
                        <?php endif; ?>

                    </ul>
                </div>

            </div>
        </nav>
    </header>