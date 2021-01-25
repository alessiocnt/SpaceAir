<?php 
$packet = $data["packet"]; 
$user = $data["user"];
$codOrder = $data["codOrder"];
?>
<section>
    <header>
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                    <h1 class="text-left col-title font-weight-lighter">Dettaglio</h1>
            </div>
        </div>
    </header>
    <section>
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <h2 class="mt-3 col-text font-weight-light">Informazioni generali</h2>
                <div class="rounded my-2 col-back-white p-4 col-dark ">
                    <img src="/spaceair/res/upload/admin/<?php echo $packet->getPacket()->getDestinationPlanet()->getImgPlanet(); ?>" class="planet-img mw-25 float-right mr-4 p-2" alt=""/>
                    <p class="my-0 text-uppercase font-weight-bold list-impo-text"><?php echo $packet->getPacket()->getDestinationPlanet()->getName();?></p>
                    <p><?php echo $packet->getPacket()->getDepartureDateHour()->format("d/m/Y H:i")?></p>
                    <p class="text-uppercase my-0"><?php echo $user->getName() . " " . $user->getSurname();?></p>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="offset-1 col-10 col-md-6 offset-md-3">
                <p class="font-weight-bold col-text my-0">Data partenza:<span class="float-right font-weight-normal"><?php echo $packet->getPacket()->getDepartureDateHour()->format("d/m/Y")?></span></p>
                <p class="font-weight-bold col-text">Ora partenza:<span class="float-right font-weight-normal"><?php echo $packet->getPacket()->getDepartureDateHour()->format("H:i")?></span></p>
                <p class="font-weight-bold col-text my-0">Data arrivo:<span class="float-right font-weight-normal"><?php echo $packet->getPacket()->getArriveDateHour()->format("d/m/Y")?></span></p>
            </div>
        </div>
    </section>    
    <section class="mt-5">
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <h2 class="col-text font-weight-light">QR Code</h2>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-12 col-md-6 offset-md-3 text-center">
                <!-- Generate Qr Code with Google API -->
                <img src="https://chart.googleapis.com/chart?cht=qr&chl=<?php echo $codOrder . "-" . $packet->getPacket()->getCode();?>&chs=250x250&chld=L|0" class="bg-light w-50" alt="Qr Code"/>
            </div>
        </div>
    </section>
    <section class="mt-5">
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <h2 class="col-text font-weight-light">Utilit&agrave;</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a class="col-btn-impo nav-link rounded col-text" href="#">
                            Tracking
                            <img class="mt-1 float-right" src="/spaceair/res/icons/navigate_next-black-18dp.svg" alt="apri i miei ordini"/>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <div class="row mt-4">
        <div class="col-12">
            <div class="fixed-bottom px-4 py-3 col-btn-regular col-blue">
                <p class="float-right font-weight-bolder impo-text my-0">€<?php echo $packet->getPacket()->getPrice(); ?></p>
                <p class="font-weight-bolder list-impo-text my-0">Quantit&agrave;: <?php echo $packet->getQuantity();?></p>
                <p class="font-weight-lighter my-0">+ Biglietto personalizzato</p>
            </div>
        </div>
    </div>
</section>