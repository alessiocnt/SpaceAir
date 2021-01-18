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
            <header class="offset-1 mb-3 col-md-6 offset-md-3">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-left col-title font-weight-lighter">Luna</h1>
                    </div>
                </div>
            </header>
            <!-- Pianeta -->
            <article class="mb-5 col-10 offset-1 col-md-6 offset-md-3">
                <div class="row mb-3">
                    <ul class="col-text col-2 space-vertical">
                        <li class="w-100">Temperatura 25°C</li>
                        <li class="w-100">Massa 25°C</li>
                        <li class="w-100">Composizione 25°C</li>
                    </ul>
                    <img alt="Luna" src="/spaceair/res/img/moon.png" class="col-8 img-fluid">
                    <ul class="col-text col-2 space-vertical">
                        <li class="w-100">Distanza dal Sole 25°C</li>
                        <li class="w-100">Superficie 25°C</li>
                        <li class="w-100">Giornata 25°C</li>
                    </ul>
                </div>
                <p class="col-text mb-0 mt-5 pb-3">
                    Troianas ut opes et lamentabile regnum eruerint Danai, quaeque ipse miserrima vidi et quorum pars magna fui. Quis talia fando Myrmidonum Dolopumve aut duri miles Ulixi temperet a lacrimis?
                </p>
                <footer>
                    <button class="btn float-right col-dark col-back-white" type="button">
                        Espandi
                    </button>
                </footer>
            </article>
            <!-- Voli disponibili -->
            <div class="row mb-3 col-md-6 offset-md-3">
                <div class="col-12 p-0">
                    <h2 class="mt-3 mb-3 col-text font-weight-light">Voli disponibili</h2>
                    <ul class="list-group">
                        <li class="list-group-item rounded mb-3 col-back-white py-4">
                            <button class="btn mt-2 mr-2 float-right" type="button">
                                <img src="/spaceair/res/icons/shopping_cart-24px.svg" class="scale-x2" alt="Preferiti">
                            </button>
                            <img src="/spaceair/res/img/moon.png" class="planet-img mw-25 float-left mr-4" alt="">
                            <p class="col-dark font-weight-bold list-impo-text my-0">15 febbraio 2021</p>
                            <p class="col-dark font-weight-normal list-impo-text my-0">$ 7500</p>
                        </li>
                        <li class="list-group-item rounded mb-3 col-back-white py-4">
                            <button class="btn mt-2 mr-2 float-right" type="button">
                                <img src="/spaceair/res/icons/shopping_cart-24px.svg" class="scale-x2" alt="Preferiti">
                            </button>
                            <img src="/spaceair/res/img/moon.png" class="planet-img mw-25 float-left mr-4" alt="">
                            <p class="col-dark font-weight-bold list-impo-text my-0">15 febbraio 2021</p>
                            <p class="col-dark font-weight-normal list-impo-text my-0">$ 7500</p>
                        </li>
                        <li class="list-group-item rounded mb-3 col-back-white py-4">
                            <button class="btn mt-2 mr-2 float-right" type="button">
                                <img src="/spaceair/res/icons/shopping_cart-24px.svg" class="scale-x2" alt="Preferiti">
                            </button>
                            <img src="/spaceair/res/img/moon.png" class="planet-img mw-25 float-left mr-4" alt="">
                            <p class="col-dark font-weight-bold list-impo-text my-0">15 febbraio 2021</p>
                            <p class="col-dark font-weight-normal list-impo-text my-0">$ 7500</p>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Nuova recensione -->
            <div class="row mb-3 col-md-6 offset-md-3">
                <div class="col-12 p-0">
                    <h2 class="mt-3 mb-3 col-text font-weight-light">Inserisci la tua recensione</h2>
                    <form action="">
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="inputTitle">Titolo</label>
                                <input type="text" class="form-control" name="inputTitle" id="inputTitle" required/>
                            </div>
                            <div class="col-6 py-0">
                                <button class="btn float-right" type="button">
                                    <img src="/spaceair/res/icons/star_rate-white-18dp.svg" class="scale-x2 img-fluid" alt="star 1">
                                </button>
                                <button class="btn float-right" type="button">
                                    <img src="/spaceair/res/icons/star_rate-white-18dp.svg" class="scale-x2 img-fluid" alt="star 2">
                                </button>
                                <button class="btn float-right" type="button">
                                    <img src="/spaceair/res/icons/star_rate-white-18dp.svg" class="scale-x2 img-fluid" alt="star 3">
                                </button>
                                <button class="btn float-right" type="button">
                                    <img src="/spaceair/res/icons/star_rate-white-18dp.svg" class="scale-x2 img-fluid" alt="star 4">
                                </button>
                                <button class="btn float-right" type="button">
                                    <img src="/spaceair/res/icons/star_rate-white-18dp.svg" class="scale-x2 img-fluid" alt="star 5">
                                </button>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="container col-12">
                                <label for="inputReview">Recensione</label>
                                <textarea class="form-control" name="inputReview" id="inputReview" rows="5"></textarea>
                            </div>
                        </div>
                        <button class="btn float-right col-dark col-back-white" type="submit">
                            Pubblica
                        </button>
                    </form>
                </div>
            </div>
            <!-- Recensione -->
            <div class="row mb-3 col-md-6 offset-md-3">
                <div class="col-12 p-0">
                    <div class="my-3 px-0 float-right">
                        <img src="/spaceair/res/icons/star_rate-white-18dp.svg" class="img-fluid" alt="star 1">
                        <img src="/spaceair/res/icons/star_rate-white-18dp.svg" class="img-fluid" alt="star 2">
                        <img src="/spaceair/res/icons/star_rate-white-18dp.svg" class="img-fluid" alt="star 3">
                        <img src="/spaceair/res/icons/star_rate-white-18dp.svg" class="img-fluid" alt="star 4">
                        <img src="/spaceair/res/icons/star_rate-white-18dp.svg" class="img-fluid" alt="star 5">
                    </div>
                    <h2 class="my-3 col-text font-weight-light">Recensioni</h2>
                    <ul class="list-group">
                        <li class="list-group-item rounded mb-3 col-back-white py-4">
                            <div class="mb-2 px-0 float-right">
                                <img src="/spaceair/res/icons/star_rate-24px.svg" class="scale-x075 img-fluid" alt="star 1">
                                <img src="/spaceair/res/icons/star_rate-24px.svg" class="scale-x075 img-fluid" alt="star 2">
                                <img src="/spaceair/res/icons/star_rate-24px.svg" class="scale-x075 img-fluid" alt="star 3">
                                <img src="/spaceair/res/icons/star_rate-24px.svg" class="scale-x075 img-fluid" alt="star 4">
                                <img src="/spaceair/res/icons/star_rate-24px.svg" class="scale-x075 img-fluid" alt="star 5">
                            </div>
                            <h3 class="font-weight-bold list-impo-text mb-2">Titolo review</h3>
                            <p class="col-dark my-0">Troianas ut opes et lamentabile regnum eruerint Danai, quaeque ipse miserrima vidi et quorum pars magna fui. Quis talia fando Myrmidonum Dolopumve aut duri miles Ulixi temperet a lacrimis?</p>
                        </li>
                        <li class="list-group-item rounded mb-3 col-back-white py-4">
                            <div class="mb-2 px-0 float-right">
                                <img src="/spaceair/res/icons/star_rate-24px.svg" class="scale-x075 img-fluid" alt="star 1">
                                <img src="/spaceair/res/icons/star_rate-24px.svg" class="scale-x075 img-fluid" alt="star 2">
                                <img src="/spaceair/res/icons/star_rate-24px.svg" class="scale-x075 img-fluid" alt="star 3">
                                <img src="/spaceair/res/icons/star_rate-24px.svg" class="scale-x075 img-fluid" alt="star 4">
                                <img src="/spaceair/res/icons/star_rate-24px.svg" class="scale-x075 img-fluid" alt="star 5">
                            </div>
                            <h3 class="font-weight-bold list-impo-text mb-2">Titolo review</h3>
                            <p class="col-dark my-0">Troianas ut opes et lamentabile regnum eruerint Danai, quaeque ipse miserrima vidi et quorum pars magna fui. Quis talia fando Myrmidonum Dolopumve aut duri miles Ulixi temperet a lacrimis?</p>
                        </li>
                        <li class="list-group-item rounded mb-3 col-back-white py-4">
                            <div class="mb-2 px-0 float-right">
                                <img src="/spaceair/res/icons/star_rate-24px.svg" class="scale-x075 img-fluid" alt="star 1">
                                <img src="/spaceair/res/icons/star_rate-24px.svg" class="scale-x075 img-fluid" alt="star 2">
                                <img src="/spaceair/res/icons/star_rate-24px.svg" class="scale-x075 img-fluid" alt="star 3">
                                <img src="/spaceair/res/icons/star_rate-24px.svg" class="scale-x075 img-fluid" alt="star 4">
                                <img src="/spaceair/res/icons/star_rate-24px.svg" class="scale-x075 img-fluid" alt="star 5">
                            </div>
                            <h3 class="font-weight-bold list-impo-text mb-2">Titolo review</h3>
                            <p class="col-dark my-0">Troianas ut opes et lamentabile regnum eruerint Danai, quaeque ipse miserrima vidi et quorum pars magna fui. Quis talia fando Myrmidonum Dolopumve aut duri miles Ulixi temperet a lacrimis?</p>
                        </li>
                    </ul>
                </div>
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