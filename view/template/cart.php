<div class="row">
    <header class="col-md-6 offset-md-3 offset-md-1 pl-md-2">
        <div class="container pl-0">
            <div class="col-12 pl-0">
                <h1 class="text-left col-title font-weight-lighter">Carrello</h1>
            </div>
        </div>
    </header>
</div>
<div class="row">
    <div class="col-12 mb-3 mt-3">
        <section id="cart">
            <?php foreach ($data as $assoc) : ?>
                <article>
                    <div class="row ml-1 mr-1">
                        <div class="col-12 col-md-6 offset-md-3 p-0">
                            <div class="rounded my-2 col-back-white p-4 col-dark ">
                                <div class="row">
                                    <div class="col-4 col-md-3">
                                        <img src="<?= $assoc["packet"]->getImg(); ?>" class="card-img" alt="">
                                    </div>
                                    <div class="col-8 col-md-9">
                                        <a href="#" id="<?= $assoc["codOrder"]; ?>" class="<?= $assoc["packet"]->getCode(); ?>" title="Rimuovi dal carrello">
                                            <img src="/spaceair/res/icons/remove_shopping_cart-black-18dp.svg" class="mw-25 float-right md-1" alt="Rimuovi dal carrello">
                                        </a>
                                        <p class="my-0 text-uppercase font-weight-bold list-impo-text mb-2">Viaggio verso <?= $assoc["planetName"]; ?></p>
                                        <p>Partenza: <?= $assoc["packet"]->getDepartureDateHour()->format("d-m-Y - H:m"); ?></p>
                                        <p>Arrivo: <?= $assoc["packet"]->getArriveDateHour()->format("d-m-Y - H:m"); ?></p>
                                        <p id="p<?= $assoc["codOrder"]; ?>" class="font-weight-normal my-0 float-right bottom mr-md-1 mt-4 totalPrice">Costo €<?= $assoc["quantity"] * $assoc["packet"]->getPrice(); ?></p>
                                        <label for="<?= $assoc["packet"]->getCode(); ?>" class="invisible custom-file-label">Quantità prodotto</label>
                                        <div class="input-group col-4 col-md-2 pl-0">
                                            <input type="number" class="form-control font-weight-normal my-0 float-left bottom mr-1 mt-3" name="<?= $assoc["codOrder"]; ?>" id="<?= $assoc["packet"]->getCode(); ?>" value="<?= $assoc["quantity"]; ?>" min="1" max="10" step="1" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>
    </div>
</div>
<section>
    <div class="col-md-6 offset-md-3">
        <div class="row top-line">
            <div class="container">
                <p id="Totale" class="font-weight-normal col-text my-0 float-right mr-md-1 mt-2 mb-2">Totale €16700</p>
            </div>
        </div>
        <div class="row">
            <div class="col-7 offset-5 col-md-3 offset-md-9">
                <form action="">
                    <input type="submit" class="form-control float-right mb-4" value="Procedi all'acquisto" />
                </form>
            </div>
        </div>
    </div>
</section>