<section>
    <header>
        <div class="row">
            <div class="col-10 offset-1 px-0 offset-md-2">
                    <h1 class="text-left col-title font-weight-lighter">Profile</h1>
            </div>
        </div>
    </header>
    <div class="row mt-3 mb-2">
        <div class="col-12 mt-1 mb-4 align-center">
            <div class="mx-auto avatar-container">
                <img src="./res/upload/user/<?php echo $data["user"]->getImgProfile() == "" ? "user.png" : $data["user"]->getImgProfile();?>" class="avatar-img rounded-circle" alt="Immagine Profilo"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <p class="col-text font-weight-bolder"><?php echo $data["user"]->getName() . " " . $data["user"]->getSurname(); ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-10 offset-1 offset-md-2 col-md-4 pr-md-5">
            <div class="row mt-4">
                <div class="col-12 px-0">
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a class="col-back-white nav-link rounded col-dark" href="myorders.php" title="I miei ordini">
                                I miei ordini
                                <img class="mt-1 float-right" src="./res/icons/navigate_next-black-18dp.svg" alt="apri i miei ordini"/>
                            </a>
                        </li>
                        <li class="nav-item my-1">
                            <a class="col-back-white nav-link rounded col-dark" href="myaddress.php" title="I miei indirizzi di consegna">
                                I miei indirizzi di consegna
                                <img class="mt-1 float-right" src="./res/icons/navigate_next-black-18dp.svg" alt="apri i miei indirizzi di consegna"/>
                            </a>
                        </li>
                        <!-- 
                        <li class="nav-item my-2">
                            <a class="col-back-white nav-link rounded col-dark" href="#">
                                Impostazioni
                                <img class="mt-1 float-right" src="./res/icons/navigate_next-black-18dp.svg" alt="apri impostazioni"/>
                            </a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-10 offset-1 offset-md-0 col-md-4 pl-md-5">
            <!-- I miei interessi -->
            <div class="row mt-4">
                <div class="col-12 rounded col-dark bg-light p-4">
                    <section>
                        <h2>I miei interessi<span class="float-right"><a href="./interest.php" title="Modifica Interessi"><img src="./res/icons/edit-black-18dp.svg" alt="Modifica Interessi"/></a></span></h2>
                        <ul class="mt-3">
                            <?php foreach($data["user"]->getInterests() as $interest): ?>
                            <li><?php echo $interest->getPlanet()->getName(); ?></li>
                            <?php endforeach ?>
                        </ul>
                    </section>    
                </div>
            </div>
        </div>
    </div>
    <a class="mt-5 btn col-btn-impo col-text col-4 offset-4 col-md-2 offset-md-5" href="?logout=1" role="button">Logout</a>
</section>