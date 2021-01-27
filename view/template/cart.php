<?php $order = $data["order"]; ?>
<div class="row">
    <header class="col-md-6 offset-md-3 offset-md-1 pl-md-2">
        <div class="container pl-0">
            <div class="col-12 pl-0">
                <h1 class="text-left col-title font-weight-lighter">Carrello</h1>
            </div>
        </div>
    </header>
</div>
<?php if(count($order->getPackets()) != 0) : ?>
<div class="row">
    <div class="col-12 mb-3 mt-3">
        <section id="cart">
            
            <?php foreach ($order->getPackets() as $packet) : ?>
                <article>
                    <div class="row ml-1 mr-1">
                        <div class="col-12 col-md-6 offset-md-3 p-0">
                            <div class="rounded my-2 col-back-white p-4 col-dark ">
                                <div class="row">
                                    <div class="col-4 col-md-3">
                                        <img src="./res/upload/admin/<?= $packet[0]->getDestinationPlanet()->getImgPlanet(); ?>" class="card-img" alt="">
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <a href="#" name="<?= $packet[0]->getCode();?>" class=" <?= $order->getCodOrder(); ?> cart-remove" title="Rimuovi dal carrello">
                                            <img src="./res/icons/remove_shopping_cart-black-18dp.svg" class="mw-25 float-right md-1" alt="Rimuovi dal carrello">
                                        </a>
                                        <p class="my-0 text-uppercase font-weight-bold list-impo-text mb-2">Viaggio verso <?= $packet[0]->getDestinationPlanet()->getName(); ?></p>
                                        <p>Partenza: <?= $packet[0]->getDepartureDateHour()->format("d-m-Y - H:i"); ?></p>
                                        <p>Arrivo: <?= $packet[0]->getArriveDateHour()->format("d-m-Y - H:i"); ?></p>
                                        <p id="p<?= $packet[0]->getCode(); ?>" class="font-weight-normal my-0 float-right bottom mr-md-1 mt-4 totalPrice">Costo € <?= $packet[1] * $packet[0]->getPrice(); ?></p>
                                        <label for="<?= $packet[0]->getCode(); ?>" class="invisible custom-file-label">Quantità prodotto</label>
                                        <div class="input-group col-4 pl-0">
                                            <input type="number" class="form-control font-weight-normal my-0 float-left bottom mr-1 mt-3" name="<?= $order->getCodOrder() ?>" id="<?= $packet[0]->getCode(); ?>" value="<?= $packet[1]; ?>" min="1" max="<?=$packet[0]->getAvailableSeats()?>" step="1" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endforeach;  ?>
        </section>
    </div>
</div>
<section>
    <div class="col-md-6 offset-md-3">
        <form action="payment.php" method="POST">
            <div class="top-line">
                <div class="row">
                    <div class="col-12 mt-3 p-0">
                        <p class="font-weight-normal col-2 col-text col-10 mt-1 input-no-bg float-right" id="Totale">Totale € <?= $order->getTotal()?> </p>
                        <input type="hidden" name="CodOrdine" id="CodOrdine" value="<?=$order->getCodOrder();?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-7 offset-5 col-md-5 offset-md-7 mt-3">
                        <input type="submit" class="form-control float-right mb-4" value="Procedi all'acquisto" />
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?php endif; ?>