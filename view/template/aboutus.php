<section>
    <header class="row col-10 offset-1 mb-3 col-md-6 offset-md-3 p-0">
        <div class="row">
            <div class="col-12">
                    <h1 class="text-left col-title font-weight-lighter">Su di noi</h1>
            </div>
        </div>
    </header>

    <section class="row col-10 offset-1 mb-3 col-md-6 offset-md-3">
        <div class="row">
            <p class="col-text">Viaggia con noi, lasciati ispirare dal nostro universo.<br/>Spaceair nasce nel 2010 da un ambizioso progetto di un'azienda leader nel settore dei trasporti che si propone di rendere lo spazio e il mondo extra-terrestre accessibile ad una platea sempre maggiore di consumatori.</p>
        </div>
    </section>
    <section class="row col-10 offset-1 mb-3 col-md-6 offset-md-3 p-0">
        <div class="row col-12">
            <p class="font-weight-lighter col-text my-0">Aperto tutti i giorni 24/7</p>    
        </div>
        <div class="row col-12">
            <p class="font-weight-lighter col-text my-0">Telefono: 333-1212123</p>
        </div>
        <div class="row col-12">
            <p class="font-weight-lighter col-text my-0">Indirizzo: Via dell’Università 14, Cesena (FC)</p>
        </div>
    </section>  
    <!--Google map-->
    <section class="col-10 offset-1 mb-3 col-md-6 offset-md-3">
        <div id="map-google" class="z-depth-1-half map-container">
            <iframe src="https://maps.google.com/maps?q=Campus+di+Cesena+-+Università+di+Bologna+-+Alma+Mater+Studiorum&t=&z=13&ie=UTF8&iwloc=&output=embed" allowfullscreen></iframe>
        </div>  
    </section>
    <!--Contatti-->
    <section class="row col-10 offset-1 mb-3 col-md-6 offset-md-3 p-0" id="contatti">
        <div class="col-12 p-0">
            <div class="row col-12">
                <h2 class="col-6 mt-3 mb-3 col-text font-weight-light p-0">Contattaci</h2>
                <div class="col-6 p-0 mt-3 float-right">
                    <a href="#" class="float-right px-1">
                        <div class="text-center">
                            <img alt="Vai al profilo Instagram" src="/spaceair/res/icons/ig-w.svg" class="img-fluid">
                        </div>
                    </a>
                    <a href="#" class="float-right px-1">
                        <div class="text-center">
                            <img alt="Vai al profilo Facebook" src="/spaceair/res/icons/fb-w.svg" class="img-fluid">
                        </div>
                    </a>
                    <a href="#" class="float-right px-1">
                        <div class="text-center">
                            <img alt="Vai al profilo YouTube" src="/spaceair/res/icons/yt-w.svg" class="img-fluid">
                        </div>
                    </a>
                </div>
            </div>
            <ul>
                <li>
                    <a href="mailto:andrea.giulianelli4@studio.unibo.it" class="col-text">Andrea Giulianelli - andrea.giulianelli4@studio.unibo.it</a>
                </li>
                <li>
                    <a href="mailto:simone.ceredi@studio.unibo.it" class="col-text">Simone Ceredi - simone.ceredi@studio.unibo.it</a>
                </li>
                <li>
                    <a href="mailto:alessio.conti3@studio.unibo.it" class="col-text">Alessio Conti - alessio.conti3@studio.unibo.it</a>
                </li>
            </ul>
        </div>
    </section>    
    <!--Recensioni-->
    <div class="row col-10 offset-1 mb-3 col-md-6 offset-md-3 p-0">
        <div class="col-12 p-0">
            <div class="my-3 px-0 float-right">
            <?php for($i=0 ; $i<5 ; $i++): ?>
                <img src="/spaceair/res/icons/star_rate-white-18dp.svg" class="img-fluid" alt="">
            <?php endfor; ?>
            </div>
            <h2 class="my-3 col-text font-weight-light">Recensioni</h2>
            <ul class="list-group">
                <?php foreach($data["reviews"] as $review): ?>
                <li class="list-group-item rounded mb-3 col-back-white py-4">
                    <p class="sr-only">Valutazione: <?php echo $review->getRating(); ?>/5</p>
                    <div class="mb-2 px-0 float-right">
                    <?php for($i=0 ; $i<$review->getRating() ; $i++): ?>
                        <img src="/spaceair/res/icons/star_rate-24px.svg" class="scale-x075 img-fluid" alt="">
                    <?php endfor; ?>
                    </div>
                    <h3 class="font-weight-bold list-impo-text mb-2"><?php echo $review->getTitle(); ?></h3>
                    <p class="col-dark my-0"><?php echo $review->getDescription(); ?></p>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>