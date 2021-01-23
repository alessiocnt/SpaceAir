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
                <?php foreach($data["orders"] as $order): ?>
                <li class="list-group-item rounded mb-3 col-back-white py-4">
                    <a href="./packetinorder.php?id=<?php echo $order->getCodOrder();?>">
                        <section>
                            <header>
                                <h2 class="col-dark font-weight-bold mb-0">Data ordine: <?php echo $order->getPurchaseDate()->format("d/m/Y"); ?></h2>
                                <p class="col-dark p-0 m-0"><span class="font-weight-bold">Stato:</span><?php echo $order->getState()->getDescription();?></p>
                                <p class="col-dark p-0 mt-0"><span class="font-weight-bold">Prezzo:</span> €<?php echo $order->getTotal();?></p>
                            </header>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <!-- For accessibility -->
                                        <th id="planet<?php echo $order->getCodOrder(); ?>" class="d-none p-0">Pianeta</th>
                                        <th id="date<?php echo $order->getCodOrder(); ?>" class="d-none p-0">Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($order->getPackets() as $packet): ?>
                                    <tr>
                                        <td headers="planet<?php echo $order->getCodOrder(); ?>" class="p-0 col-dark font-weight-light text-uppercase"><?php echo $packet->getDestinationPlanet()->getName();?></td>
                                        <td headers="date<?php echo $order->getCodOrder(); ?>" class="p-0 col-dark font-weight-light"><?php echo $packet->getDepartureDateHour()->format("d/m/Y"); ?></td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </section>
                    </a>
                </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</section>