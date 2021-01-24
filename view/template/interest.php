<div class="row">
    <header class="col-md-6 offset-md-3 offset-md-1 pl-md-2">
        <div class="container pl-0">
            <div class="col-12 pl-0">
                <h1 class="text-left col-title font-weight-lighter">Preferiti</h1>
            </div>
        </div>
    </header>
</div>
<div class="row">
    <div class="col-12 col-md-6 offset-md-3 col-error" id="removeResult"></div>
</div>
<div class="row">
    <div class="col-12 mb-3 mt-3">
        <section>
        <?php foreach ($data["interests"] as $interest) :?>
            <article>
                <div class="row ml-1 mr-1">
                    <div class="col-12 col-md-6 offset-md-3 p-0">
                        <div class="rounded my-2 col-back-white p-4 col-dark ">
                            <div class="row">
                                <div class="col-4 col-md-3">
                                    <img src="/spaceair/res/upload/admin/<?=$interest->getPlanet()->getImgPlanet();?>" class="card-img mx-auto d-block interest-img" alt="">
                                </div>
                                <div class="col-8 col-md-9">
                                    <a href="#" class="btn-int" title="Rimuovi dai preferiti" id="<?=$interest->getPlanet()->getCodPlanet();?>">
                                        <img src="/spaceair/res/icons/remove_favourite.svg" class="mw-25 float-right mr-md-1" style="width: 18px;" alt="Rimuovi dal carrello">
                                    </a>
                                    <p class="my-0 text-uppercase font-weight-bold list-impo-text align-middle">Viaggi verso <?=$interest->getPlanet()->getName();?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        <?php endforeach;?>
        </section>
    </div>
</div>