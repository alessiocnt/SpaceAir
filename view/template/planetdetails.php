<?php $planet = $data["planets"] ?>
<section>
    <header class="col-10 offset-1 mb-3 col-md-6 offset-md-3">
        <div class="row">
            <div class="col-12 p-0">
                <h1 class="text-left col-title font-weight-lighter"><?php echo $planet->getName(); ?></h1>
            </div>
        </div>
    </header>
    <!-- Pianeta -->
    <article class="mb-5 col-10 offset-1 col-md-6 offset-md-3 p-0">
        <div class="row mb-3 d-none d-md-flex">
            <ul class="col-text col-2 space-vertical">
                <li class="w-100">Temperatura <?php echo $planet->getTemperature(); ?>°C</li>
                <li class="w-100">Massa <?php echo $planet->getMass(); ?>x10<sup>22</sup>Kg</li>
                <li class="w-100">Composizione <?php echo $planet->getComposition(); ?></li>
            </ul>
            <img alt="<?php echo $planet->getName(); ?>" src="/spaceair/res/upload/admin/<?php echo $planet->getImgPlanet() ?>" class="col-8 img-fluid">
            <ul class="col-text col-2 space-vertical">
                <li class="w-100">Distanza dal Sole <?php echo $planet->getSunDistance(); ?>x10<sup>6</sup>Km</li>
                <li class="w-100">Superficie <?php echo $planet->getSurface(); ?>x10<sup>6</sup>Km<sup>2</sup></li>
                <li class="w-100">Giornata <?php echo $planet->getDayLength(); ?> ore</li>
            </ul>
        </div>
        <!-- usata solo per il mobile -->
        <img alt="<?php echo $planet->getName(); ?>" src="/spaceair/res/upload/admin/<?php echo $planet->getImgPlanet() ?>" class="d-md-none col-8 offset-2 img-fluid">
        <p class="col-text mb-0 mt-5 pb-3"><?php echo $planet->getDescription(); ?></p>
        <section class="mt-3 d-md-none">
            <h2 class="mt-3 col-title font-weight-light">Informazioni pianeta</h2>
            <table class="col-12 table table-light table-striped">
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
    <!-- Voli disponibili -->
    <section>
        <div class="row col-10 offset-1 mb-3 col-md-6 offset-md-3 p-0">
            <div class="col-12 p-0">
                <h2 class="mt-3 mb-3 col-text font-weight-light">Voli disponibili</h2>
                <ul class="list-group">
                    <?php foreach ($data["packets"] as $packet) : ?>
                        <li class="">
                            <form action="/spaceair/controller/api/FlightDetailsApi.php" method="POST" class="rounded my-2 col-back-white p-4 col-dark col-12">
                                <input id="packet" name="packet" type="hidden" value="<?php echo $packet->getCode(); ?>" />
                                <input id="inputQuantity" name="inputQuantity" type="hidden" value="1" />
                                <?php if ($packet->getAvailableSeats()) : ?>
                                    <button class="btn mt-2 mr-2 float-right" type="submit">
                                        <img src="/spaceair/res/icons/shopping_cart-24px.svg" class="scale-x2" alt="Aggiungi al carrello">
                                    </button>
                                <?php endif; ?>
                                <a href="/spaceair/flightdetails.php?Destination=<?php echo $planet->getName() ?>&Packet=<?php echo $packet->getCode(); ?>">
                                    <img src="/spaceair/res/upload/admin/<?php echo $planet->getImgPlanet() ?>" class="planet-img mw-25 float-left mr-4" alt="Vai al volo del <?php echo $packet->getDepartureDateHour()->format("d-m-Y H:m"); ?>" />
                                </a>
                                <a href="/spaceair/flightdetails.php?Destination=<?php echo $planet->getName() ?>&Packet=<?php echo $packet->getCode(); ?>" class="col-dark font-weight-bold list-impo-text my-0"><?php echo $packet->getDepartureDateHour()->format("d-m-Y - H:m"); ?></a>
                                <p class="col-dark font-weight-normal list-impo-text my-0">€ <?php echo $packet->getPrice(); ?></p>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>
    <!-- Nuova recensione -->
    <section>
        <div class="row col-10 offset-1 mb-3 col-md-6 offset-md-3 p-0">
            <div class="col-12 p-0">
                <h2 class="mt-3 mb-3 col-text font-weight-light">Inserisci la tua recensione</h2>
                <form action="#" id="newReview">
                    <div class="row mb-3">
                        <div class="col-8">
                            <label for="inputTitle">Titolo</label>
                            <input type="text" class="form-control" name="inputTitle" id="inputTitle" required />
                        </div>
                        <div class="col-4">
                            <label for="inputStars" class="">Valutazione</label>
                            <input type="number" class="form-control" name="inputStars" id="inputStars" value="" min="1" max="5" step="1" required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="container col-12">
                            <label for="inputReview">Recensione</label>
                            <textarea class="form-control" name="inputReview" id="inputReview" rows="5" required></textarea>
                        </div>
                    </div>
                    <input id="inputPlanet" name="inputPlanet" type="hidden" value="<?php echo $planet->getName(); ?>" />
                    <button class="btn float-right col-dark col-back-white" type="submit">Pubblica</button>
                    <div class="col-8 col-md-10 col-error" id="reviewResult"></div>
                </form>
            </div>
        </div>
    </section>
    <!-- Recensione -->
    <section>
        <div class="row col-10 offset-1 mb-3 col-md-6 offset-md-3 p-0">
            <div class="col-12 p-0">
                <div class="my-3 px-0 float-right">
                    <?php for ($i = 0; $i < 5; $i++) : ?>
                        <img src="/spaceair/res/icons/star_rate-white-18dp.svg" class="img-fluid" alt="">
                    <?php endfor; ?>
                </div>
                <h2 class="my-3 col-text font-weight-light">Recensioni</h2>
                <ul class="list-group">
                    <?php foreach ($data["reviews"] as $review) : ?>
                        <li class="list-group-item rounded mb-3 col-back-white py-4">
                            <p class="sr-only">Valutazione: <?php echo $review->getRating(); ?>/5</p>
                            <div class="mb-2 px-0 float-right">
                                <?php for ($i = 0; $i < $review->getRating(); $i++) : ?>
                                    <img src="/spaceair/res/icons/star_rate-24px.svg" class="scale-x075 img-fluid" alt="">
                                <?php endfor; ?>
                            </div>
                            <h3 class="font-weight-bold list-impo-text mb-2"><?php echo $review->getTitle(); ?></h3>
                            <p class="col-dark my-0"><?php echo $review->getDescription(); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>
</section>