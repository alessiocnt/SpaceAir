<section>
    <section class="mb-5 p-0">
        <img class="home-img img-fluid mb-3" src="/spaceair/res/icons/home-shuttle.jpg" alt="Shuttle utilizzato per i viaggi.">
        <p class="col-text text-center mb-3">Viaggia con noi, lasciati ispirare dal nostro universo.</p>
        <a href="/spaceair/destinations.php" class="btn col-btn-regular col-10 offset-1 col-md-6 offset-md-3 mb-3">Destinazioni</a>
        <a href="#overview">
            <div class="text-center">
                <img alt="Altro" src="/spaceair/res/icons/keyboard_arrow_down-white-18dp.svg" class="scale-x2">
            </div>
        </a>
    </section>

    <a name="overview"></a>
    <?php foreach($data["planets"] as $planet): ?>
        <!-- <div class="row">
            <div class="mb-4 col-10 offset-1 col-md-8 offset-md-2 top-line"></div>
            <div class="mb-3 col-12">    
                <section class="mb-3">
                    <article class="mt-3 col-10 offset-1 col-md-8 offset-md-2">
                        <header>
                            <h2 class="mb-4 text-center col-title"><?php echo $planet->getName(); ?></h2>
                        </header>
                        <div class="row">
                            <ul class="col-text col-2 space-vertical">
                                <li class="w-100">Temperatura <?php echo $planet->getTemperature(); ?>°C</li>
                                <li class="w-100">Massa <?php echo $planet->getMass(); ?>x10<sup>22</sup>Kg</li>
                                <li class="w-100">Composizione <?php echo $planet->getComposition(); ?></li>
                            </ul>
                            <div class="col-8 text-center">
                                <img alt="<?php echo $planet->getName(); ?>" src="/spaceair/res/upload/admin/<?php echo $planet->getImgPlanet() ?>" class="img-fluid w-md-50  rounded-circle">
                            </div>
                            <ul class="col-text col-2 space-vertical">
                                <li class="w-100">Distanza dal Sole <?php echo $planet->getSunDistance(); ?>x10<sup>6</sup>Km</li>
                                <li class="w-100">Superficie <?php echo $planet->getSurface(); ?>x10<sup>6</sup>Km<sup>2</sup></li>
                                <li class="w-100">Giornata <?php echo $planet->getDayLength(); ?> ore</li>
                            </ul>
                        </div>
                    </article>
                </section>
            </div>
        </div> -->
        <div class="row">
            <div class="my-3 col-10 offset-1 col-md-6 offset-md-3 top-line"></div>
            <article class="mb-5 col-md-6 offset-md-3 p-0">
                <header>
                    <h2 class="mb-4 text-center col-title"><?php echo $planet->getName(); ?></h2>
                </header>
                <div class="row d-none d-md-flex">
                    <ul class="col-text col-2 space-vertical">
                        <li class="w-100">Temperatura <?php echo $planet->getTemperature(); ?>°C</li>
                        <li class="w-100">Massa <?php echo $planet->getMass(); ?>x10<sup>22</sup>Kg</li>
                        <li class="w-100">Composizione <?php echo $planet->getComposition(); ?></li>
                    </ul>
                    <img class="col-8 img-fluid" alt="<?php echo $planet->getName(); ?>" src="/spaceair/res/upload/admin/<?php echo $planet->getImgPlanet() ?>" />
                    <ul class="col-text col-2 space-vertical">
                        <li class="w-100">Distanza dal Sole <?php echo $planet->getSunDistance(); ?>x10<sup>6</sup>Km</li>
                        <li class="w-100">Superficie <?php echo $planet->getSurface(); ?>x10<sup>6</sup>Km<sup>2</sup></li>
                        <li class="w-100">Giornata <?php echo $planet->getDayLength(); ?> ore</li>
                    </ul>
                </div>
                <!-- usata solo per il mobile -->
                <img id="btn-<?php echo $planet->getName(); ?>" class="btn-planet-img d-md-none col-8 offset-2 img-fluid" alt="<?php echo $planet->getName(); ?>" src="/spaceair/res/upload/admin/<?php echo $planet->getImgPlanet() ?>" />
                <section class="mt-3 col-10 offset-1 d-md-none">
                    <h2 class="table-info-pl mt-3 col-title font-weight-light">Informazioni pianeta</h2>
                    <table id="table-<?php echo $planet->getName(); ?>" class="table-info-pl col-12 table table-light table-striped">
                        <thead class="col-btn-impo">
                            <tr>
                                <th id="desc">Descrizione</th>
                                <th id="value">Valore</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td headers="desc">Temperatura</td>
                                <td headers="value"><?php echo $planet->getTemperature(); ?>°C</td>
                            </tr>
                            <tr>
                                <td headers="desc">Distanza dal sole</td>
                                <td headers="value"><?php echo $planet->getSunDistance(); ?>x10<sup>6</sup>Km</td>
                            </tr>
                            <tr>
                                <td headers="desc">Massa</td>
                                <td headers="value"><?php echo $planet->getMass(); ?>x10<sup>22</sup>Kg</td>
                            </tr>
                            <tr>
                                <td headers="desc">Superficie</td>
                                <td headers="value"><?php echo $planet->getSurface(); ?>x10<sup>6</sup>Km<sup>2</sup></td>
                            </tr>
                            <tr>
                                <td headers="desc">Composizione</td>
                                <td headers="value"><?php echo $planet->getComposition(); ?></td>
                            </tr>
                            <tr>
                                <td headers="desc">Giornata</td>
                                <td headers="value"><?php echo $planet->getDayLength(); ?> ore</td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </article>
        </div>
    <?php endforeach; ?>

</section>

