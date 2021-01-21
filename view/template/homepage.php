<section>
    <section class="mb-5 p-0">
        <img class="home-img img-fluid mb-3" src="/spaceair/res/icons/home-shuttle.jpg" alt="Shuttle utilizzato per i viaggi.">
        <p class="col-text text-center mb-3">Viaggia con noi, lasciati ispirare dal nostro universo.</p>
        <a href="#" class="btn col-btn-regular col-10 offset-1 mb-3">Destinazioni</a>
        <a href="#overview">
            <div class="text-center">
                <img alt="Altro" src="/spaceair/res/icons/keyboard_arrow_down-white-18dp.svg" class="scale-x2">
            </div>
        </a>
    </section>

    <a name="overview"></a>
    <?php foreach($data["planets"] as $planet): ?>
        <section class="mb-3">
            <article class="mb-5 col-10 offset-1">
                <header>
                    <h2 class="text-center col-title"><?php echo $planet->getName(); ?></h2>
                </header>
                <div class="row">
                    <ul class="col-text col-2 space-vertical">
                        <li class="w-100">Temperatura <?php echo $planet->getTemperature(); ?>°C</li>
                        <li class="w-100">Massa <?php echo $planet->getMass(); ?>Kg</li>
                        <li class="w-100">Composizione <?php echo $planet->getComposition(); ?></li>
                    </ul>
                    <img alt="<?php echo $planet->getName(); ?>" src="/spaceair/res/upload/admin/<?php echo $planet->getImgPlanet() ?>" class="col-8 img-fluid">
                    <ul class="col-text col-2 space-vertical">
                        <li class="w-100">Distanza dal Sole <?php echo $planet->getSunDistance(); ?>Km</li>
                        <li class="w-100">Superficie <?php echo $planet->getSurface(); ?>Km2</li>
                        <li class="w-100">Giornata <?php echo $planet->getDayLength(); ?> ore</li>
                    </ul>
                </div>
            </article>
        </section>
    <?php endforeach; ?>

</section>

