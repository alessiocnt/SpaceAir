<section>
    <header class="col-10 offset-1 col-md-6 offset-md-3">
        <div class="row">
            <div class="col-12 pl-0">
                    <h1 class="text-left col-title font-weight-lighter">Dettagli volo</h1>
            </div>
        </div>
    </header>
    <?php $planet = $data["planets"] ?>
    <?php $user = $data["user"] ?>
    <?php $packet = $data["packet"] ?>
    <section class="mb-3 col-10 offset-1 col-md-6 offset-md-3">
        <div class="row mb-3">
            <div class="rounded my-2 col-back-white p-4 col-dark col-12">
                <img src="/spaceair/res/upload/admin/<?php echo $planet->getImgPlanet() ?>" class="planet-img mw-25 float-right mr-4 p-2" alt=""/>
                <p class="my-0 text-uppercase font-weight-bold list-impo-text"><?php echo $planet->getName(); ?></p>
                <p><?php echo $packet->getDepartureDateHour()->format("d-m-Y - H:m"); ?></p>
                <p class="text-uppercase my-0"><?php echo $user->getName(); ?> <?php echo $user->getSurname(); ?></p>
                <p class="text-uppercase my-0">Posto - 12</p>
            </div>
        </div>
        <div class="row">
            <p class="col-text"><?php echo $planet->getDescription(); ?></p>
        </div>
    </section>
    <section class="mb-3 col-10 offset-1 col-md-6 offset-md-3">
        <div class="row">
            <div class="col-12 px-0">
                    <h2 class="text-left col-title font-weight-lighter">Informazioni</h2>
            </div>
            <div class="col-12 px-0">
                <p class="font-weight-bold col-text my-0">Data partenza:<span class="float-right font-weight-normal"><?php echo $packet->getDepartureDateHour()->format("d-m-Y"); ?></span></p>
                <p class="font-weight-bold col-text my-0">Orario partenza:<span class="float-right font-weight-normal"><?php echo $packet->getDepartureDateHour()->format("H:m"); ?></span></p>    
                <p class="font-weight-bold col-text my-0">Data arrivo:<span class="float-right font-weight-normal"><?php echo $packet->getArriveDateHour()->format("d-m-Y"); ?></span></p>
                <p class="font-weight-bold col-text my-0">Orario arrivo:<span class="float-right font-weight-normal"><?php echo $packet->getArriveDateHour()->format("H:m"); ?></span></p>
                <p class="font-weight-bold col-text my-0">Capienza volo:<span class="float-right font-weight-normal"><?php echo $packet->getMaxSeats(); ?></span></p>
                <p class="font-weight-bold col-text my-0">Posti disponibili:<span class="float-right font-weight-normal"><?php echo $packet->getAvailableSeats(); ?></span></p>
                <p class="font-weight-bold col-text my-0">Costo:<span class="float-right font-weight-normal">$ <?php echo $packet->getPrice(); ?></span></p>
            </div>
        </div>
    </section>  
    <section class="mb-3 p-0 col-10 offset-1 col-md-6 offset-md-3">
    <?php if($packet->getAvailableSeats()) : ?>
        <form action="/spaceair/controller/api/FlightDetailsApi.php" method="POST" class="rounded my-2 col-back-white p-4 col-dark col-12">
            <input id="packet" name="packet" type="hidden" value="<?php echo $packet->getCode(); ?>"/>
            <div class="row">
                <p class="col-4 col-dark font-weight-bold list-impo-text">Quantità</p>
                <div class="col-4">
                    <label for="inputQuantity" class="invisible custom-file-label">Quantità prodotto</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="inputQuantity" id="inputQuantity" value="1" min="0" max="<?=$packet->getAvailableSeats();?>" step="1"/>
                    </div>
                </div>
                <div class="col-4">
                    <button class="btn float-right" type="submit">
                        <img src="/spaceair/res/icons/shopping_cart-24px.svg" class="float-right" alt="Aggiungi al carrello">
                    </button>
                </div>
            </div>
        </form>
        <?php endif;?>
    </section>                          
</section>