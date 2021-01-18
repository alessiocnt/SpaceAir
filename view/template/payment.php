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

    <div class="container-fluid">
        <main>














            <!-- HEADER -->

            <header>
                <h1 class="col-title font-weight-lighter">Pagamento</h1>
            </header>
            <section>
                <article>
                    <div class="row">
                        <div class="top-line col-md-6 offset-md-3 mb-6">
                        <h2 class="text-center col-title font-weight-lighter mt-12">Indirizzo di consegna</h2>
                            <form action="">
                                <div class="row mb-3 mt-2">
                                    <div class="col-9">
                                        <label for="inputVia">Via</label>
                                        <input type="text" class="form-control" name="inputVia" id="inputVia" required />
                                    </div>
                                    <div class="col-3">
                                        <label for="inputCivico">Civico</label>
                                        <input type="text" class="form-control" name="inputCivico" id="inputCivico" required />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="inputCity">Città</label>
                                        <input type="text" class="form-control" name="inputCity" id="inputCity" required />
                                    </div>
                                    <div class="col-3">
                                        <label for="inputProvincia">Provincia</label>
                                        <input type="text" class="form-control" name="inputProvincia" id="inputProvincia" required />
                                    </div>
                                    <div class="col-3">
                                        <label for="inputCap">Cap</label>
                                        <input type="number" min="10000" max="99999" step="1" class="form-control" name="inputCap" id="inputCap" required />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4 offset-8 col-md-2 offset-md-10">
                                        <input type="submit" class="form-control" value="Conferma" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </article>
                <article>
                    <div class="row">
                        <div class="top-line col-md-6 offset-md-3 mb-6">
                        <h2 class="text-center col-title font-weight-lighter mt-12">Metodo di pagamento</h2>
                            <div class="row">
                                <div class="col-3 offset-2 col-md-1 offset-md-4">
                                    <div class="rounded my-2 col-back-white p-1 col-dark">
                                        <img src="../../res/icons/credit_card-black-18dp.svg" alt="Paga tramite carta di credito" class="rounded mx-auto d-block pt-2 pb-2" />
                                    </div>
                                </div>
                                <div class="col-3 offset-2 col-md-1 offset-md-2">
                                    <div class="rounded my-2 col-back-white p-1 col-dark">
                                        <img src="../../res/icons/paypal.svg" alt="Paga tramite PayPal" class="rounded mx-auto d-block pt-2 pb-2" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </article>
                <article>
                    <div class="row">
                        <div class="top-line col-md-6 offset-md-3 mb-6">
                            <form action="">
                                <div class="row mb-3 mt-2">
                                    <div class="col-12">
                                        <label for="inputNumeroCarta">Numero carta</label>
                                        <input type="number" minlength="13" step="1" min="0" class="form-control" name="inputNumeroCarta" id="inputNumeroCarta" required />
                                    </div>
                                    
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="inputIntestatario">Intestatario carta</label>
                                        <input type="text" class="form-control" name="inputIntestatario" id="inputIntestatario" required />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <label for="inputCcv">CCV</label>
                                        <input type="number" minlength="3" step="1" min="0" class="form-control" name="inputCcv" id="inputCcv" required />
                                    </div>
                                    <div class="col-9">
                                        <label for="inputScadenza">Data di scadenza</label> <!-- TODO sistemare label per mobile -->
                                        <input type="month" class="form-control" name="inputScadenza" id="inputScadenza" required />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-10 offset-2 col-md-5 offset-md-7">
                                        <input type="submit" class="form-control" value="Conferma Metodo di Pagamento" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </article>
                <article>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">

                            <div class="row top-line">
                                <div class="container">
                                    <p class="font-weight-normal col-text my-0 float-right mr-md-1 mt-2 mb-2">Totale €16700</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 offset-6 col-md-3 offset-md-9">
                                    <form action="">
                                        <input type="submit" class="form-control float-right mb-4" value="Procedi all'acquisto" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </section>


            <!-- FOOTER -->











        </main>
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