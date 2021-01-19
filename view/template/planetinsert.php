<section>      
    <header class="offset-1 mb-3 col-md-6 offset-md-3">
        <div class="row">
            <div class="col-12 pl-0">
                    <h1 class="text-left col-title font-weight-lighter">Nuova destinazione</h1>
            </div>
        </div>
    </header>
    <div class="row">
        <div class="col-md-6 offset-md-3 mb-3">
            <form action="" method="POST">
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="inputName">Nome</label>
                        <input type="text" class="form-control" name="inputName" id="inputName" autocomplete="on" required/>
                    </div>
                    <div class="col-6">
                        <label for="inputImage">Immagine</label>
                        <div class="custom-file" id="inputImage">
                            <label for="img" class="custom-file-label">Clicca per inserire</label>
                            <input type="file" class="form-control" name="img" id="img"/>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="inputTemperature">Temperatura</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">°C</span>
                            </div>
                            <input type="number" class="form-control" name="inputTemperature" id="inputTemperature" autocomplete="on" required/>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="inputSunDistance">Distanza dal Sole</label>
                        <input type="number" class="form-control" name="inputSunDistance" id="inputSunDistance" autocomplete="on" required/>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="inputMass">Massa</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Kg</span>
                            </div>
                            <input type="number" class="form-control" name="inputMass" id="inputMass" autocomplete="on" required/>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="inputSurface">Superficie</label>
                        <input type="number" class="form-control" name="inputSurface" id="inputSurface" autocomplete="on" required/>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="container col-6">
                        <label for="inputComposition">Composizione</label>
                        <select name="inputComposition" id="inputComposition" class="form-control" required>
                            <option value = "" selected hidden>Seleziona...</option>
                            <option value="Marte">Solido</option>
                            <option value="Venere">Liquido</option>
                            <option value="Venere">Gassoso</option>
                            <option value="Venere">Lava</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="inputDay">Durata del giorno</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Ore</span>
                            </div>
                            <input type="number" class="form-control" name="inputDay" id="inputDay" autocomplete="on" required/>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="container">
                        <label for="inputDescription">Descrizione pianeta</label>
                        <textarea class="form-control" name="inputDescription" id="inputDescription" rows="5"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="inputVisible">Visibile</label>
                        <input type="checkbox" name="inputDescription" id="inputVisible">
                    </div>
                    <div class="col-6">
                        <input type="submit" class="form-control" value="Inserisci"/>
                    </div>
                </div>
                <?php if(isset($data["error"])):?>
                    <p class="col-error col-12"><?php echo $data["error"]?></p>
                <?php endif ?>
            </form>
        </div>
    </div>
</section>