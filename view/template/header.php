<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!--Custom CSS-->
    <link rel="stylesheet" href="/spaceair/view/template/style/style.css">
    <!-- Custom CSS -->
    <?php foreach ($headerInfo["css"] as $cssFile) : ?>
        <link rel="stylesheet" href="<?php echo $cssFile ?>" />
    <?php endforeach ?>

    <title><?php echo $headerInfo["title"]; ?></title>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="/spaceair/view/js/notification.js"></script>
    <!-- Custom Js -->
    <?php foreach ($headerInfo["js"] as $jsFile) : ?>
        <script src="<?php echo $jsFile ?>"></script>
    <?php endforeach ?>

</head>

<body class="bg-custom d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-md navbar-dark bg-custom">
        <!--Toggler for the navbar-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!--SpaceAir logo and name-->
        <a class="navbar-brand mx-auto" href="/spaceair/homepage.php" title="Vai alla home">
            <img src="/spaceair/res/icons/logo.svg" class="d-inline-block align-top logo-header" alt="logo" loading="lazy">
            SPACEAIR
        </a>

        <!--Navbar icons near logo for device screen-->
        <div class="navbar-brand align-top ml-auto d-inline-block d-md-none">   
            <?php if(session_status() != PHP_SESSION_NONE && Utils::checkAdmin()) {  
                require $_SERVER["DOCUMENT_ROOT"] . "/spaceair/view/template/nav-icons-admin.html";
            } else {
                require $_SERVER["DOCUMENT_ROOT"] . "/spaceair/view/template/nav-icons.html";
            } ?>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto p-2">
                <?php if(session_status() != PHP_SESSION_NONE && Utils::checkAdmin()) :?>
                    <li class="nav-item">
                        <a class="nav-link" href="/spaceair/destinationsadmin.php">Destinazioni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/spaceair/packetlist.php">Pacchetti</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/spaceair/destinations.php">Destinazioni</a>
                    </li>
                <?php endif?>
            </ul>
        </div> 

        <!--Navbar icons, need to repeat in order to move them on the extreme right after the nav-item when over md view-->
        <div class="navbar-brand align-top ml-auto d-none d-md-block">
            <?php if(session_status() != PHP_SESSION_NONE && Utils::checkAdmin()) {  
                require $_SERVER["DOCUMENT_ROOT"] . "/spaceair/view/template/nav-icons-admin.html";
            } else {
                require $_SERVER["DOCUMENT_ROOT"] . "/spaceair/view/template/nav-icons.html";
            } ?>
        </div>
    </nav>

    <div class="container-fluid">
        <main class="my-4">
            <div class="col-2 fixed-top d-none d-md-flex my-toast" aria-live="polite" aria-atomic="true">
                <!-- Position it -->
                <div class="my-toast-position">
                </div>
            </div>