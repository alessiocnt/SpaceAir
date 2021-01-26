<section>
    <header class="col-10 offset-1 mb-3 col-md-6 offset-md-3">
        <div class="row">
            <div class="col-12 pl-0">
                    <h1 class="text-left col-title font-weight-lighter">Destinazioni</h1>
            </div>
        </div>
    </header>

    <div class="col-10 offset-1 col-md-6 offset-md-3 mb-5">
        <form action="#" method="POST">
            <div class="row">
                <label for="searchBar" class="d-none">Ricerca</label>
                <input type="search" class="form-control col-10" name="searchBar" id="searchBar" autocomplete="on"/>
                <button class="btn col-2" type="submit">
                    <span class="input-group-addon">
                        <img src="/spaceair/res/icons/search-white-18dp.svg" alt="Cerca" class="scale-x2">
                    </span>
                </button>
            </div>
        </form>
    </div>
    <div id="fav-res" class="col-error col-10 offset-1 col-md-6 offset-md-3 mb-2 p-0"></div>

    <div class="col-10 offset-1 col-md-6 offset-md-3 p-0">
        <ul class="list-group">
            <?php if(isset($data["error"])):?>
                <p class="col-error col-12 p-0"><?php echo $data["error"]?></p>
            <?php endif ?>
            <?php if(isset($data["planets"])):?>
                <?php foreach($data["planets"] as $planet): ?>
                    <li class="col-12 list-group-item rounded mb-3 col-back-white space-vertical">
                        <div class="col-9 p-0">
                        <a href="/spaceair/planetdetails.php?Destination=<?php echo $planet->getName(); ?>" class="p-0">
                            <img src="/spaceair/res/upload/admin/<?php echo $planet->getImgPlanet() ?>" class="planet-img mw-25 float-left mr-4" alt="Vai a: <?php echo $planet->getName(); ?>" />
                        </a>
                        <a href="/spaceair/planetdetails.php?Destination=<?php echo $planet->getName(); ?>" class="col-dark list-impo-text p-0 my-0"><?php echo $planet->getName(); ?></a>
                        </div>
                        <div class="col-3 p-0">
                            <a href="#" id="<?php echo $planet->getName(); ?>" class="btn btn_fav float-right" title="Aggiungi ai preferiti">
                                <img src="/spaceair/res/icons/favorite-24px.svg" alt="Preferiti">
                            </a>
                        </div>

                        
                    </li>
                <?php endforeach; ?>
            <?php endif ?>
        </ul>
    </div>
</section>
