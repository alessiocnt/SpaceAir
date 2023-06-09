<section>
    <header>
        <div class="row">
            <div class="col-10 pl-3 pl-md-2 col-md-8 offset-md-3">
                    <h1 class="text-left col-title font-weight-lighter">Inserisci info di tracking</h1>
            </div>
        </div>
    </header>
    <div class="mt-5 row">
        <div class="col-12 col-md-6 offset-md-3">
            <p class="col-error"><?php echo isset($data["text"]) ? $data["text"] : ""; ?></p>
            <form action="#" method="POST">
                <div class="form-group">
                    <label for="selectorder">Seleziona Ordine</label>
                    <select class="form-control" id="selectorder" name="codOrder">
                        <?php foreach($data["orders"] as $order): ?>
                            <option value="<?php echo $order->getCodOrder();?>"><?php echo $order->getCodOrder() . " - " . $order->getUser()->getName() . " " . $order->getUser()->getSurname();?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="city" class="col-text">Citta</label>
                    <input type="text" class="col-back-white form-control" name="city" id="city" autocomplete="on" required/>
                </div>
                <div class="form-group">
                    <label for="description" class="col-text">Descrizione</label>
                    <input type="text" class="col-back-white form-control" name="description" id="description" autocomplete="on" required/>
                </div>
                <input type="submit" name="add" class="mt-5 py-2 col-12 btn col-btn-impo col-title font-weight-light" value="Aggiungi info"/> 
                <p class="col-text  my-3">oppure</p>
                <input type="submit" name="delivery" class="py-2 col-12 btn col-btn-impo col-title font-weight-light" value="Consegna"/> 
            </form>
        </div>
    </div>
</section>