<div class="row">
    <header class="col-md-6 offset-md-3 offset-md-1 pl-md-2">
        <div class="container pl-0">
            <div class="col-12 pl-0">
                <h1 class="text-left col-title font-weight-lighter">Notifiche</h1>
            </div>
        </div>
    </header>
</div>
<div class="row">
    <div class="col-12 mb-3 mt-3">
    
        <section>
        <?php foreach ($data["notifications"] as $notification) : ?>
            <article>
                <div class="row ml-1 mr-1">
                    <div class="col-12 col-md-6 offset-md-3 p-0">
                        <div class="rounded my-2 col-back-white p-4 col-dark ">
                            <div class="row">
                                <div class="col-12 ">
                                    <h2><?=$notification->getTitle();?></h2>
                                    <p class="font-weight-normal my-0"><?=$notification->getDescription();?></p>
                                    <p class="font-weight-normal my-0 float-right bottom mr-md-1 mt-4"><?=$notification->getDateHour()->format("d.m.Y H:m")?></p>
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