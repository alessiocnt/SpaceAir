<section>    
    <header class="">
        <div class="row">
            <div class="col-12 mb-3 col-md-6 offset-md-3 pl-2">
                    <h1 class="text-left col-title font-weight-lighter">Modifica destinazione</h1>
            </div>
        </div>
    </header>
    <?php $planet = $data["planets"] ?> 
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3 mb-3">
            <form action="./controller/api/PlanetModifyApi.php" method="POST" enctype="multipart/form-data">
                <input id="old-planet" name="old-planet" type="hidden" value="<?php echo $planet->getCodPlanet(); ?>"/>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="inputName">Nome</label>
                        <input type="text" class="form-control" name="inputName" id="inputName" autocomplete="on" required value="<?php echo $planet->getName()?>"/>
                    </div>
                    <div class="col-6">
                        <label for="img">Immagine</label>
                        <input type="file" class="form-control rounded col-black-white p-0" name="img" id="img" />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="inputTemperature">Temperatura</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">°C</span>
                            </div>
                            <input type="number" class="form-control" name="inputTemperature" id="inputTemperature" autocomplete="on" required value="<?php echo $planet->getTemperature() ?>"/>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="inputSunDistance">Distanza Sole (x10<sup>6</sup>)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Km</span>
                            </div>
                            <input type="number" class="form-control" name="inputSunDistance" id="inputSunDistance" autocomplete="on" required value="<?php echo $planet->getSunDistance() ?>"/>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="inputMass">Massa (x10<sup>22</sup>)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Kg</span>
                            </div>
                            <input type="number" class="form-control" name="inputMass" id="inputMass" autocomplete="on" required value="<?php echo $planet->getMass() ?>"/>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="inputSurface">Superficie (x10<sup>6</sup>)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Km<sup>2</sup></span>
                            </div>
                            <input type="number" class="form-control" name="inputSurface" id="inputSurface" autocomplete="on" required value="<?php echo $planet->getSurface() ?>"/>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="container col-6">
                        <label for="inputComposition">Composizione</label>
                        <select name="inputComposition" id="inputComposition" class="form-control">
                            <option value="Solido" <?php echo $planet->getComposition() == "Solido" ? "selected" : "" ?>>Solido</option>
                            <option value="Liquido" <?php echo $planet->getComposition() == "Liquido" ? "selected" : "" ?>>Liquido</option>
                            <option value="Gassoso" <?php echo $planet->getComposition() == "Gassoso" ? "selected" : "" ?>>Gassoso</option>
                            <option value="Lava" <?php echo $planet->getComposition() == "Lava" ? "selected" : "" ?>>Lava</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="inputDay">Massa</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Ore</span>
                            </div>
                            <input type="number" class="form-control" name="inputDay" id="inputDay" autocomplete="on" required value="<?php echo $planet->getDayLength() ?>"/>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="container">
                        <label for="inputDescription">Descrizione pianeta</label>
                        <textarea class="form-control" name="inputDescription" id="inputDescription" rows="5"><?php echo $planet->getDescription() ?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="inputVisible">Visibile</label>
                        <input type="checkbox" name="inputVisible" id="inputVisible" <?=$planet->isVisible()? "checked":'';?>>
                    </div>
                    <div class="col-6">
                        <input type="submit" class="form-control" value="Modifica"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>