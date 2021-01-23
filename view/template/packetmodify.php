<div class="row">
    <header class="col-md-6 offset-md-3 offset-md-1">
        <div class="container pl-0">
            <div class="col-12 pl-0">
                <h1 class="text-left col-title font-weight-lighter">Modifica pacchetto</h1>
            </div>
        </div>
    </header>
</div>
<div class="row">
    <div class="col-md-6 offset-md-3 mb-3">
        <div class="col-error"><?php if (isset($data["error"])) :
                                    echo $data["error"];
                                    else :
                                 ?>
        </div>
        <form action="/spaceair/packetmodify.php" method="POST">
            <input type="hidden" name="packetId" id="packetId" value="<?=$data["packet"]->getCode();?>">
            <div class="row mb-3">
                <div class="container">
                    <label for="inputDestination">Destinazione</label>
                    <select name="inputDestination" id="inputDestination" class="form-control">
                    <?php foreach ($data["planets"] as $planet) : ?>
                        <option <?php if($planet->getCodPlanet() == $data["packet"]->getDestinationPlanet()->getCodPlanet()) echo 'selected'; ?> value="<?=$planet->getCodPlanet();?>"><?=$planet->getName();?></option>
                    <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label for="inputDepartureDateHour">Data e ora partenza</label>
                    <input type="datetime-local" class="form-control" name="inputDepartureDateHour" id="inputDepartureDateHour" value="<?= $data["packet"]->getDepartureDateHour()->format('Y-m-d\TH:i') ;?>" required />
                </div>
                <div class="col-6">
                    <label for="inputArriveDateHour">Data e ora arrivo</label>
                    <input type="datetime-local" class="form-control" name="inputArriveDateHour" id="inputArriveDateHour" value="<?= $data["packet"]->getArriveDateHour()->format('Y-m-d\TH:i') ;?>" required />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label for="inputCapacity">Capienza</label>
                    <input type="number" min="0" max="10000" step="1" class="form-control" name="inputCapacity" id="inputCapacity" value="<?= $data["packet"]->getMaxSeats();?>" required />
                </div>
                <div class="col-6">
                    <label for="inputPrice">Prezzo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">€</span>
                        </div>
                        <input type="number" min="0" step="1" class="form-control" name="inputPrice" id="inputPrice" value="<?= $data["packet"]->getPrice();?>" required />
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="container">
                    <label for="inputDescription">Descrizione</label>
                    <textarea class="form-control" name="inputDescription" id="inputDescription" rows="5" required><?= $data["packet"]->getDescription();?> </textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    <label for="inputVisible">Visibile</label>
                    <input type="checkbox" name="inputVisible" id="inputVisible" <?= $data["packet"]->isVisible() ? 'checked':'';?> />
                </div>
                <div class="col-4 offset-4 col-md-2 offset-md-6">
                    <input type="submit" class="form-control" value="Modifica" />
                </div>
            </div>
        </form>
    </div>
    <?php endif; ?>
</div>