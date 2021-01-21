<section>
    <header>
        <div class="row">
            <div class="col-12 col-md-6 offset-md-4 pl-md-2">
                    <h1 class="text-left col-title font-weight-lighter"><?php echo $data["action"] == 0 ? "Aggiungi" : "Modifica";?> indirizzo di consegna</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center p-4">
                <img src="/spaceair/res/icons/decorative/undraw_package_arrived_63rf.svg" alt="" class="decorative-img mw-50"/>
            </div>
        </div>
    </header>
    <div class="row mt-2">
        <div class="offset-1 col-10 offset-md-4 col-md-4">
            <form action="#" method="POST">
                <div class="form-row">                            
                    <div class="form-group col-7 mb-2">
                        <label for="address" class="col-text">Via</label>
                        <input type="text" class="col-back-white form-control" name="address" id="address" autocomplete="on" value="<?php echo $data["address"]->getVia();?>" required/>
                    </div>
                    <div class="form-group offset-1 col-4 mb-2">
                        <label for="civico" class="col-text">Civico</label>
                        <input type="text" class="col-back-white form-control" name="civico" id="civico" autocomplete="on" value="<?php echo $data["address"]->getCivico();?>" required/>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="city" class="col-text">Citt&agrave;</label>
                    <input type="text" class="col-back-white form-control" name="city" id="city" autocomplete="on" value="<?php echo $data["address"]->getCitta();?>" required/>
                </div>
                <div class="form-row">
                    <div class="form-group col-7">
                        <label for="provincia" class="col-text">Provincia</label>
                        <input type="text" class="col-back-white form-control" name="provincia" id="provincia" autocomplete="on" value="<?php echo $data["address"]->getProvincia();?>" required/>
                    </div>
                    <div class="form-group offset-1 col-4">
                        <label for="cap" class="col-text">CAP</label>
                        <input type="number" min=0 step="1" class="col-back-white form-control" name="cap" id="cap" autocomplete="on" value="<?php echo $data["address"]->getCap();?>" required/>
                    </div>
                </div>

                <input type="submit" class="mt-3 py-2 offset-6 col-6 btn col-btn-regular col-dark font-weight-bold" value="<?php echo $data["action"] == 0 ? "Aggiungi" : "Modifica";?>"/> 
                <?php if($data["action"] == 1) :?>
                    <input type="hidden" name="codAddress" value="<?php echo $data["address"]->getCodAddress();?>"/>
                <?php endif ?>
            </form>
        </div>
    </div>
</section>