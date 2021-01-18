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
                        <header class="col-10 offset-1 mb-3">
                            <div class="row">
                                <div class="col-12 pl-0">
                                        <h1 class="text-left col-title font-weight-lighter">Su di noi</h1>
                                </div>
                            </div>
                        </header>

                        <section class="mb-5 col-10 offset-1">
                            <div class="row">
                                <p class="col-text">Viaggia con noi, lasciati ispirare dal nostro universo. Quis talia fando Myrmidonum Dolopumve aut duri miles Ulixi temperet a lacrimis?</p>
                            </div>
                        </section>
                        <section class="mb-5 col-10 offset-1">
                            <div class="row">
                                <div class="row col-12 p-0">
                                    <div class="col-8">
                                        <p class="font-weight-lighter col-text my-0">Aperto tutti i giorni 24/7</p>
                                    </div>
                                    <div class="col-4">
                                        <a href="#" class="float-right px-1">
                                            <div class="text-center">
                                                <img alt="Vai al profilo Instagram" src="/spaceair/res/icons/ig-w.svg" class="img-fluid">
                                            </div>
                                        </a>
                                        <a href="#" class="float-right px-1">
                                            <div class="text-center">
                                                <img alt="Vai al profilo Facebook" src="/spaceair/res/icons/fb-w.svg" class="img-fluid">
                                            </div>
                                        </a>
                                        <a href="#" class="float-right px-1">
                                            <div class="text-center">
                                                <img alt="Vai al profilo YouTube" src="/spaceair/res/icons/yt-w.svg" class="img-fluid">
                                            </div>
                                        </a>
                                    </div>
                                    <p class="font-weight-lighter col-text my-0 col-12">Telefono: 333-1212123</p>
                                    <p class="font-weight-lighter col-text my-0 col-12">Indirizzo: Via dell’Università 14, Cesena (FC)</p>
                                </div>
                            </div>
                        </section>  
                        <!--Google map-->
                        <section class="mb-5 p-0 col-10 offset-1">
                            <div id="map-google" class="z-depth-1-half map-container">
                                <iframe src="https://maps.google.com/maps?q=Campus+di+Cesena+-+Università+di+Bologna+-+Alma+Mater+Studiorum&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
                                style="border:0" allowfullscreen></iframe>
                            </div>  
                        </section>    
                        <!--Contatti-->
                        <section class="row mb-5">
                            <div class="col-10 offset-1">
                                <h2 class="mt-3 mb-3 col-text font-weight-light">Contattaci</h2>
                                <form action="">
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label for="inputMail">E-Mail</label>
                                            <input type="text" class="form-control" name="inputMail" id="inputMail" required/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="container col-12">
                                            <label for="inputMsg">Messaggio</label>
                                            <textarea class="form-control" name="inputMsg" id="inputMsg" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <button class="btn float-right col-dark col-back-white" type="submit">
                                        Invia
                                    </button>
                                </form>
                            </div>
                        </section>    
                        <!--Recensioni-->
                        <section class="row mb-5">
                            <div class="col-10 offset-1">
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
                        </section>
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