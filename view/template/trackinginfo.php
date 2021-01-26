<section>
    <header>
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3 pl-md-2">
                    <h1 class="text-left col-title font-weight-lighter">Tracking gadget</h1>
            </div>
        </div>
    </header>
    <div class="row mt-5">
        <div class="col-12 col-md-6 offset-md-3">
            <ul class="list-group ">
                <?php foreach($data["trackInfo"] as $trackInfo): ?>
                    <li class="border-0 list-group-item bg-custom my-2">
                        <!-- Info of track -->
                        <div class="col-6 float-left">
                                <div class="row">
                                    <div class="col-12">
                                        <p class="col-text my-0 font-weight-light list-impo-text"><?php echo $trackInfo->getDate()->format("H:i"); ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="col-text my-0 font-weight-lighter"><?php echo $trackInfo->getDate()->format("d/m/Y"); ?></p>
                                    </div>
                                </div>
                        </div>

                        <div class="col-6 float-right border-left border-light pl-3">
                            <div class="row">
                                <div class="col-12">
                                    <p class="col-text my-0 font-weight-bold list-impo-text"><?php echo $trackInfo->getCity(); ?></p>
                                </div>
                                <div class="col-12">
                                    <p class="col-text my-0 font-weight-lighter list-secondary-text"><?php echo $trackInfo->getDescription(); ?></p>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</section>