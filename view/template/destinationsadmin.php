<section>
    <header class="col-10 offset-1 mb-3 col-md-6 offset-md-3">
        <div class="row">
            <div class="col-12 pl-0">
                <h1 class="text-left col-title font-weight-lighter">Elenco destinazioni</h1>
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
                        <img src="./res/icons/search-white-18dp.svg" alt="Cerca" class="scale-x2">
                    </span>
                </button>
            </div>
        </form>
    </div>
    <div id="msg-res" class="col-error col-10 offset-1 col-md-6 offset-md-3 mb-2 p-0"></div>

    <div class="col-10 offset-1 col-md-6 offset-md-3 p-0">
        <ul class="list-group">
            <?php if(isset($data["error"])):?>
                <p class="col-error col-12 p-0"><?php echo $data["error"]?></p>
            <?php endif ?>
            <?php if(isset($data["planets"])):?>
                <?php foreach($data["planets"] as $planet): ?>
                    <li class="col-12 list-group-item rounded mb-3 col-back-white space-vertical">
                        <span class="col-dark list-impo-text col-8"><?php echo $planet->getName(); ?></span>
                        <div class="col-4">
                            <a href="./planetmodify.php?Destination=<?php echo $planet->getName(); ?>" class="btn_edit btn float-right p-1" title="Modifica pianeta">
                                <img id="<?php echo $planet->getName(); ?>" src="./res/icons/edit-black-18dp.svg" alt="Modifica">
                            </a>
                        </div>
                    </li>
                <?php endforeach; ?>
            <?php endif ?>
        </ul>
    </div>
    <section>
        <div class="row fixed">
            <div class="col-10 offset-1 col-md-6 offset-md-3 mr-1">
                <!-- Light circle button with ripple effect -->
                <a href="planetinsert.php" class="btn rounded-circle col-btn-impo btn-md pmd-btn-raised float-right top-add-btn" title="Aggiungi nuovo pianeta">
                    <img src="./res/icons/add-black-36dp.svg" alt="Crea nuovo pianeta" class="pt-1 pb-1"/>
                </a>
            </div>
        </div>
    </section>
</section>