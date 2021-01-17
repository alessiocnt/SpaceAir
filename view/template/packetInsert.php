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
            <img src="/spaceair/res/Icons/logo.svg" class="d-inline-block align-top logo-header" alt="logo" loading="lazy">
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















            <div class="container-fluid">
                <h1>Inserimento nuovo viaggio</h1>

                <div class="row">
                    <div class="col-md-6 offset-md-3 mb-3">
                        <form action="">
                            <div class="row mb-3">
                                <div class="container">
                                    <label for="inputDestination">Destinazione</label>
                                    <select name="inputDestination" id="inputDestination" class="form-control" required>
                                        <option value = "" selected hidden>Seleziona...</option>
                                        <option value="Marte">Marte</option>
                                        <option value="Venere">Venere</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="inputDate">Data</label>
                                    <input type="date" class="form-control" name="inputDate" id="inputDate" required/>
                                </div>
                                <div class="col-6">
                                    <label for="inputHour">Ora partenza</label>
                                    <input type="time" class="form-control" name="inputHour" id="inputHour" required/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="inputCapacity">Capienza</label>
                                    <input type="number" min="0" max="10000" step="1" class="form-control" name="inputCapacity" id="inputCapacity" required/>
                                </div>
                                <div class="col-6">
                                    <label for="inputPrice">Prezzo</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">€</span>
                                        </div>
                                        <input type="number" min="0" step="1" class="form-control" name="inputPrice" id="inputPrice" aria-label="Amount (to the nearest dollar)" required/>
                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="container">
                                    <label for="inputDescription">Descrizione</label>
                                    <textarea class="form-control" name="inputDescription" id="inputDescription" rows="5" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-2">
                                    <label for="inputVisible">Visibile</label>
                                    <input type="checkbox" name="inputDescription" id="inputVisible">
                                </div>
                                <div class="col-4 offset-6 col-md-2 offset-md-8">
                                    <input type="submit" class="form-control" value="Inserisci" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

















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