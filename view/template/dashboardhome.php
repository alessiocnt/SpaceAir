<section>
    <header>
        <div class="row">
            <div class="col-12 col-md-4 offset-md-2 pl-md-2">
                    <h1 class="text-left col-title font-weight-lighter">Dashboard</h1>
            </div>
        </div>
    </header>
    <div class="row">
        <div class="col-12 col-md-4 offset-md-2">
            <section>
                <!-- Graphs or stats-->
                <h2 class="col-title font-weight-lighter mt-3">Statistiche</h2>

                <article>
                    <h3 class="col-title font-weight-bold mt-3">Vendita per pianeta</h3>
                    <!-- Canvas graph -->
                    <div id="shop">
                        <div id="shopchart" class="graph"></div>
                        <!-- Table with graph data for accessibility -->
                        <div id="shoptable" class="sr-only"></div>
                    </div>
                </article>
                <article class="mt-5">
                    <h3 class="col-title font-weight-bold mt-3">Viaggi pi&ugrave; popolari</h3>
                    <!-- Canvas graph -->
                    <div id="popularticket">
                        <div id="popularticketchart" class="graph"></div>
                        <!-- Table with graph data for accessibility -->
                        <div id="populartickettable" class="sr-only"></div>
                    </div>
                </article>
                <article class="mt-5">
                    <h3 class="col-title font-weight-bold mt-3">Posti occupati nei pacchetti disponibili</h3>
                    <table class="col-10 offset-1 table table-light table-striped">
                        <thead class="col-btn-impo">
                            <tr>    
                                <th id="packet">Pacchetto</th>
                                <th id="seat">Posti</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data["packets"] as $packet): ?>
                            <tr>
                                <td headers="packet"><?echo $packet->getDestinationPlanet()->getName() . " " . $packet->getDepartureDateHour()->format("d/m/Y");?></td>
                                <td headers="seat"><?echo $packet->getAvailableSeats() . "/" . $packet->getMaxSeats();?></td>
                            </tr>
                            <? endforeach ?>
                        </tbody>
                    </table>
                </article>
            </section>
        </div>
        <div class="col-12 col-md-4">
            <section class="mt-5">
                <!-- Options-->
                <h2 class="col-title font-weight-lighter mt-3">Opzioni</h2>
                <div class="row mt-4">
                        <div class="offset-1 col-10">
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2">
                                    <a class="col-back-white nav-link rounded col-dark" href="./packetlist.php">
                                        Pacchetti offerti
                                        <img class="mt-1 float-right" src="/spaceair/res/icons/navigate_next-black-18dp.svg" alt="apri i miei ordini"/>
                                    </a>
                                </li>
                                <li class="nav-item my-1">
                                    <a class="col-back-white nav-link rounded col-dark" href="./destinationsadmin.php">
                                        Elenco Pianeti
                                        <img class="mt-1 float-right" src="/spaceair/res/icons/navigate_next-black-18dp.svg" alt="apri i miei indirizzi di consegna"/>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-12">
                                <a class="mt-5 btn col-btn-impo col-text offset-1 col-5" href="?logout=1" role="button">Logout</a>
                            </div>
                    </div>
            </section>
        </div>
    </div>
</section>