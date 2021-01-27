<div class="row">
    <header class="col-md-6 offset-md-3 offset-md-1 pl-md-2">
        <div class="container pl-0">
            <div class="col-12 pl-0">
                <h1 class="text-left col-title font-weight-lighter">Elenco viaggi</h1>
            </div>
        </div>
    </header>
</div>
<div class="row">
    <div class="col-12 mb-3 mt-3">
        <section>
        <?php foreach ($data["packets"] as $packet) : ?>
            <article>
                <div class="row ml-1 mr-1">
                    <div class="col-12 col-md-6 offset-md-3 p-0">
                        <div class="rounded my-2 col-back-white p-4 col-dark ">
                            <div class="row">
                                <div class="col-4 col-md-2">
                                    <img src="./res/upload/admin/<?=$packet->getDestinationPlanet()->getImgPlanet()?>" class="card-img" alt="">
                                </div>
                                <div class="col-8 col-md-10">
                                    <a href="./packetmodify.php?Packet=<?=$packet->getCode();?>" title="Modifica viaggio">
                                        <img src="./res/icons/edit-black-18dp.svg" class="mw-25 float-right mr-md-1" alt="Modifica viaggio">
                                    </a>
                                    <a href="./passengerlist.php?codPacket=<?php echo $packet->getCode();?>" class="my-0 text-uppercase col-dark font-weight-bold list-impo-text">Viaggio verso <?=$packet->getDestinationPlanet()->getName();?></a>
                                    <p><?=$packet->getDepartureDateHour()->format("d.m.Y H:m");?></p>
                                    <p><?=$packet->getArriveDateHour()->format("d.m.Y H:m");?></p>
                                    <p class="font-weight-normal my-0"><?=$packet->getAvailableSeats();?> posti disponibili</p>
                                    <p class="font-weight-normal my-0 float-right bottom mr-1">Prezzo €<?=$packet->getPrice();?></p>
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
<section>
    <div class="row fixed-bottom top-add-btn">
        <div class="col-md-6 offset-md-3 mr-1">
            <!-- Light circle button with ripple effect -->
            <a href="./packetinsert.php" class="btn rounded-circle col-btn-impo btn-md pmd-btn-raised float-right" title="Aggiungi nuovo viaggio">
                <img src="./res/icons/add-black-36dp.svg" alt="Aggiungi nuovo viaggio" class="pt-1 pb-1" />
            </a>
        </div>
    </div>
</section>