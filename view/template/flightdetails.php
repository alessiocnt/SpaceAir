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
                        <header class="col-10 offset-1">
                            <div class="row">
                                <div class="col-12 pl-0">
                                        <h1 class="text-left col-title font-weight-lighter">Dettagli volo</h1>
                                </div>
                            </div>
                        </header>

                        <section class="mb-3 col-10 offset-1">
                            <div class="row mb-3">
                                <div class="rounded my-2 col-back-white p-4 col-dark col-12">
                                    <img src="/spaceair/res/img/moon.png" class="planet-img mw-25 float-right mr-4 p-2" alt=""/>
                                    <p class="my-0 text-uppercase font-weight-bold list-impo-text">Venere</p>
                                    <p>20.11.2021 - 14:46</p>
                                    <p class="text-uppercase my-0">Alessio Conti</p>
                                    <p class="text-uppercase my-0">Posto - 12</p>
                                </div>
                            </div>
                            <div class="row">
                                <p class="col-text">
                                    Troianas ut opes et lamentabile regnum eruerint Danai, quaeque ipse miserrima vidi et quorum pars magna fui. Quis talia fando Myrmidonum Dolopumve aut duri miles Ulixi temperet a lacrimis?
                                </p>
                            </div>
                        </section>
                        <section class="mb-3 col-10 offset-1">
                            <div class="row">
                                <div class="col-12 px-0">
                                        <h2 class="text-left col-title font-weight-lighter">Informazioni</h2>
                                </div>
                                <div class="col-12 px-0">
                                    <p class="font-weight-bold col-text my-0">Data partenza:<span class="float-right font-weight-normal">15.02.2021</span></p>
                                    <p class="font-weight-bold col-text my-0">Data arrivo:<span class="float-right font-weight-normal">27.02.2021</span></p>    
                                    <p class="font-weight-bold col-text my-0">Data arrivo:<span class="float-right font-weight-normal">27.02.2021</span></p>
                                    <p class="font-weight-bold col-text my-0">Capienza volo:<span class="float-right font-weight-normal">8</span></p>
                                    <p class="font-weight-bold col-text my-0">Posti disponibili:<span class="float-right font-weight-normal">3</span></p>
                                    <p class="font-weight-bold col-text my-0">Costo:<span class="float-right font-weight-normal">$ 7500</span></p>
                                </div>
                            </div>
                        </section>  
                        <section class="mb-3 p-0 col-10 offset-1">
                            <form action="" class="rounded my-2 col-back-white p-4 col-dark col-12">
                                <div class="row">
                                    <button class="btn float-right" type="button">
                                        <img src="/spaceair/res/icons/shopping_cart-24px.svg" class="float-right" alt="Aggiungi al carrello">
                                    </button>
                                    <p class="col-4 col-dark font-weight-bold list-impo-text">Quantità</p>
                                    <div class="col-4">
                                        <label for="inputQuantity" class="invisible custom-file-label">Quantità prodotto</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="inputQuantity" id="inputQuantity" value="1" min="0" max="100" step="1"/>
                                        </div>
                                    </div>
                                </div>
                            </form>
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