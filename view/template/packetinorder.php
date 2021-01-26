<section>
    <header>
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3 pl-md-2">
                    <h1 class="text-left col-title font-weight-lighter">Dettaglio Ordine</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-6 col-md-3 offset-md-3">
                    <a class="col-btn-impo nav-link rounded col-text mt-2" href="./trackinginfo.php?id=<?php echo $data["codOrder"];?>">
                        Tracking
                        <img class="mt-1 float-right" src="/spaceair/res/icons/navigate_next-black-18dp.svg" alt="Apri informazioni di tracking"/>
                    </a>
            </div>
        </div>
    </header>
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            <ul class="list-group mt-5">
                <?php foreach($data["packets"]->getPackets() as $packet): ?>
                    <li class="list-group-item rounded mb-3 col-back-white py-4">
                        <a href="./userpacketdetails.php?idpacket=<?php echo $packet->getPacket()->getCode();?>&idorder=<?php echo $data["codOrder"]; ?>">
                            <img src="/spaceair/res/upload/admin/<?php echo $packet->getPacket()->getDestinationPlanet()->getImgPlanet();?>" class="planet-img mw-25 float-left mr-4 p-2" alt=""/>
                            <div class="float-right">
                            <p class="col-dark text-lowercase font-weight-light my-0"><?php echo "€" . $packet->getPacket()->getPrice() . " ";?></p>
                                <p class="col-dark list-impo-text text-lowercase font-weight-light my-0"><?php echo "x" . $packet->getQuantity() . " ";?></p>
                            </div>
                            <p class="col-dark font-weight-bold list-impo-text text-uppercase my-0"><?php echo $packet->getPacket()->getDestinationPlanet()->getName(); ?></p>
                            <p class="col-dark font-weight-normal list-impo-text my-0"><?php echo $packet->getPacket()->getDepartureDateHour()->format("d/m/Y H:i:s"); ?></p>
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</section>