<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!--Custom CSS-->
    <link rel="stylesheet" href="style/style.css">

    <title><?php echo $headerInfo["title"]; ?></title>
</head>

<body class="bg-custom">
    <nav class="navbar navbar-expand-md navbar-dark bg-custom">
        <!--Toggler for the navbar-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!--SpaceAir logo and name-->
        <a class="navbar-brand mx-auto" href="#">
            <img src="/spaceair/res/icons/logo.svg" class="d-inline-block align-top logo-header" alt="logo" loading="lazy">
            SPACEAIR
        </a>

        <!--Navbar icons near logo for device screen-->
        <div class="navbar-brand align-top ml-auto d-inline-block d-md-none">
            <?php require $_SERVER["DOCUMENT_ROOT"] . "/spaceair/view/template/nav-icons.html"; ?>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto p-2">
                <li class="nav-item">
                    <a class="nav-link" href="#">Destinazioni</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pacchetti</a>
                </li>
            </ul>
        </div>

        <!--Navbar icons, need to repeat in order to move them on the extreme right after the nav-item when over md view-->
        <div class="navbar-brand align-top ml-auto d-none d-md-block">
            <?php require $_SERVER["DOCUMENT_ROOT"] . "/spaceair/view/template/nav-icons.html"; ?>
        </div>
    </nav>




        
        <section>
            <header class="offset-1 mb-3">
                <div class="row">
                    <div class="col-12 pl-0">
                            <h1 class="text-left col-title font-weight-lighter">Destinazioni</h1>
                    </div>
                </div>
            </header>
            <div class="row">

            <div class="col-10 offset-1 mb-5">
                <div class="row">
                    <input type="search" class="form-control col-11" name="searchBar" id="searchBar" autocomplete="on"/>
                    <button class="btn col-1" type="submit">
                        <span class="input-group-addon">
                            <img src="/spaceair/res/icons/search-white-18dp.svg" alt="Cerca" class="scale-x2">
                        </span>
                    </button>
                </div>
            </div>

            <div class="col-10 offset-1 col-md-6 offset-md-3">
                <ul class="list-group">
                    <li class="col-12 list-group-item rounded mb-3 col-back-white space-vertical">
                        <a href="#" class="col-dark list-impo-text col-8 col-md-10">Luna</a>
                        <button class="btn pull-right" type="button">
                            <img src="/spaceair/res/icons/edit-black-18dp.svg" class="float-right" alt="Modifica">
                        </button>
                        <button class="btn pull-right" type="button">
                            <img src="/spaceair/res/icons/delete-black-18dp.svg" class="float-right" alt="Elimina">
                        </button>
                    </li>
                    <li class="col-12 list-group-item rounded mb-3 col-back-white space-vertical">
                        <a href="#" class="col-dark list-impo-text col-8 col-md-10">Mercurio</a>
                        <button class="btn pull-right" type="button">
                            <img src="/spaceair/res/icons/edit-black-18dp.svg" class="float-right" alt="Modifica">
                        </button>
                        <button class="btn pull-right" type="button">
                            <img src="/spaceair/res/icons/delete-black-18dp.svg" class="float-right" alt="Elimina">
                        </button>
                    </li>
                    <li class="col-12 list-group-item rounded mb-3 col-back-white space-vertical">
                        <a href="#" class="col-dark list-impo-text col-8 col-md-10">Venere</a>
                        <button class="btn pull-right" type="button">
                            <img src="/spaceair/res/icons/edit-black-18dp.svg" class="float-right" alt="Modifica">
                        </button>
                        <button class="btn pull-right" type="button">
                            <img src="/spaceair/res/icons/delete-black-18dp.svg" class="float-right" alt="Elimina">
                        </button>
                    </li>
                </ul>
            </div>
        </section>












    <div class="container-fluid">
        <div class="row bg-sec justify-content-center">
            <div class="col-12">
                <footer>
                    <nav class="nav text-monospace">
                        <a href="#" class="px-1 py-2  col-text nav-link col-4 col-md-3 text-center">ABOUT US</a>
                        <a href="#" class="px-1 py-2 col-text nav-link col-4 col-md-3 text-center">CONTACTS</a>
                        <a href="#" class="px-1 py-2 col-text nav-link col-4 col-md-3 text-center">COOKIE POLICY</a>
                        <a href="#" class="px-1 py-2 col-text nav-link col-12 col-md-3 text-center">PRIVACY POLICY</a>
                    </nav>
                </footer>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>

</html>