<section>      
    <header class="offset-1 mb-3 col-md-6 offset-md-3">
        <div class="row">
            <div class="col-12 pl-0">
                    <h1 class="text-left col-title font-weight-lighter">Modifica destinazione</h1>
            </div>
        </div>
    </header>
    <?php $planet = $data["planets"] ?>
    <div class="row">
        <div class="col-md-6 offset-md-3 mb-3">
            <form action="/spaceair/controller/api/PlanetModifyApi.php" method="POST" enctype="multipart/form-data">
                <input id="old-planet" name="old-planet" type="hidden" value="<?php echo $planet->getCodPlanet(); ?>"/>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="inputName">Nome</label>
                        <input type="text" class="form-control" name="inputName" id="inputName" autocomplete="on" required value="<?php echo $planet->getName()?>"/>
                    </div>
                    <div class="col-6 overflow-hidden">
                            <label for="img" class="">Immagine</label>
                            <input type="file" class="rounded p-1 col-back-white" name="img" id="img" required/>
                        <!-- <div class="custom-file overflow-auto">
                        </div> -->
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
                        <label for="inputSunDistance">Distanza dal Sole</label>
                        <input type="number" class="form-control" name="inputSunDistance" id="inputSunDistance" autocomplete="on" required value="<?php echo $planet->getSunDistance() ?>"/>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="inputMass">Massa</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Kg</span>
                            </div>
                            <input type="number" class="form-control" name="inputMass" id="inputMass" autocomplete="on" required value="<?php echo $planet->getMass() ?>"/>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="inputSurface">Superficie</label>
                        <input type="number" class="form-control" name="inputSurface" id="inputSurface" autocomplete="on" required value="<?php echo $planet->getSurface() ?>"/>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="container col-6">
                        <label for="inputComposition">Composizione</label>
                        <select name="inputComposition" id="inputComposition" class="form-control" required>
                            <option value = "<?php echo $planet->getComposition() ?>" selected hidden><?php echo $planet->getComposition() ?></option>
                            <option value="Solido">Solido</option>
                            <option value="Liquido">Liquido</option>
                            <option value="Gassoso">Gassoso</option>
                            <option value="Lava">Lava</option>
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
                        <textarea class="form-control" name="inputDescription" id="inputDescription" rows="5" value="<?php echo $planet->getDescription() ?>"></textarea>
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