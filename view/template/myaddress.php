<section>
    <header>
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3 pl-md-2">
                    <h1 class="text-left col-title font-weight-lighter">I miei indirizzi di consegna</h1>
            </div>
        </div>
    </header>
    <a class="btn col-btn-regular offset-md-3 pl-md-2" href="addaddress.php" role="button">Aggiungi</a>
    <div class="row mt-5">
        <div class="col-12 col-md-6 offset-md-3">
        <p class="col-error"></p>
            <?php foreach($data["addresses"] as $address): ?>
                <article class="col-back-white rounded p-3 mb-3" id="<?php echo $address->getCodAddress();?>">
                    <div class="row">
                        <div class="col-12">
                            <a href="addaddress.php?cod=<?php echo $address->getCodAddress();?>" title="Modifica interesse">
                                <img class="float-right edit" src="./res/icons/edit-black-18dp.svg" alt="Modifica Interessi"/>
                            </a>
                            <header>
                                <h2 class="text-black font-weight-bold">#Indirizzo</h2>
                            </header>
                        </div>
                        <div class="col-12">
                            <section>
                                <h3 class="text-dark font-weight-normal my-0"><u>Info:</u></h3>
                                <p class="m-0 text-dark font-weight-light"><?php echo $address->toString()?></p>
                                <p class="m-0 text-dark font-weight-light"><?php echo $address->toSecondaryInfo()?></p>
                            </section>
                        </div>
                        <div class="col-12 text-right">
                            <img class="float-right delete" src="./res/icons/delete-black-18dp.svg" alt="Cancella Interesse"/>
                        </div>
                    </div>
                </article>
            <?php endforeach ?>
        </div>
    </div>

</section>