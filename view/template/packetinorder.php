<section>
    <header>
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3 pl-md-2">
                    <h1 class="text-left col-title font-weight-lighter">I miei ordini</h1>
            </div>
        </div>
    </header>
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            <ul class="list-group mt-5">
                <?php foreach($data["packets"]->getPackets() as $packet): ?>
                    <li class="list-group-item rounded mb-3 col-back-white py-4">
                        <a href="">
                            <img src="/spaceair/res/img/<?php echo $packet->getDestinationPlanet()->getImgPlanet();?>" class="planet-img mw-25 float-left mr-4 p-2" alt=""/>
                            <p class="col-dark font-weight-bold list-impo-text text-uppercase my-0"><?php echo $packet->getDestinationPlanet()->getName(); ?></p>
                            <p class="col-dark font-weight-normal list-impo-text my-0"><?php echo $packet->getDepartureDateHour()->format("d/m/Y H:i:s"); ?></p>
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</section>