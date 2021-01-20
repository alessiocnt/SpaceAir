<section>
    <header>
        <div class="row">
            <div class="col-12 col-md-6 offset-md-4 pl-md-2">
                    <h1 class="text-left col-title font-weight-lighter">Registrazione</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center p-4">
                <img src="/spaceair/res/icons/decorative/undraw_Outer_space_drqu.svg" alt="" class="decorative-img mw-50"/>
            </div>
        </div>
    </header>
    <div class="row mt-2">
        <div class="offset-1 col-10 offset-md-4 col-md-4">
            <?php if(isset($data["error"])):?>
                <p class="col-error"><?php echo $data["error"]?></p>
            <?php endif ?>
            <p>
            <form action="" method="POST" enctype="multipart/form-data">
                <fieldset class="form-group"><legend class="col-title">Dati Utente</legend>
                <div class="form-group">
                    <label for="name" class="col-text">Nome</label>
                    <input type="text" class="col-back-white form-control" name="name" id="name" autocomplete="on" required/>
                </div>
                <div class="form-group">
                    <label for="surname" class="col-text">Cognome</label>
                    <input type="text" class="col-back-white form-control" name="surname" id="surname" autocomplete="on" required/>
                </div>
                <div class="form-group">
                    <label for="borndate" class="col-text">Data di Nascita</label>
                    <input type="date" class="col-back-white form-control" name="borndate" id="borndate" autocomplete="on" required/>
                </div>
                <div class="form-group">
                    <label for="email" class="col-text">Email</label>
                    <input type="email" class="col-back-white form-control" name="email" id="email" autocomplete="on" required/>
                </div>
                <div class="form-group">
                    <label for="password" class="col-text">Password</label>
                    <input type="password" class="col-back-white form-control" name="password" id="password" required/>
                    <p class="col-error d-none">La password deve essere lunga almeno 8 caratteri</p>
                </div>
                <div class="form-group">
                    <label for="confirmpassword" class="col-text">Conferma Password</label>
                    <input type="password" class="col-back-white form-control" name="confirmpassword" id="confirmpassword" required/>
                    <p class="col-error d-none">Le due password non corrispondono</p>
                </div>
                </fieldset>

                <fieldset class="form-group">
                    <legend class="col-text">Indirizzo di Default</legend>
                    <div class="form-row">                            
                        <div class="form-group col-7">
                            <label for="address" class="col-text">Via</label>
                            <input type="text" class="col-back-white form-control" name="address" id="address" autocomplete="on" required/>
                        </div>
                        <div class="form-group offset-1 col-4">
                            <label for="civico" class="col-text">Civico</label>
                            <input type="text" class="col-back-white form-control" name="civico" id="civico" autocomplete="on" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city" class="col-text">Citt&agrave;</label>
                        <input type="text" class="col-back-white form-control" name="city" id="city" autocomplete="on" required/>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-7">
                            <label for="provincia" class="col-text">Provincia</label>
                            <input type="text" class="col-back-white form-control" name="provincia" id="provincia" autocomplete="on" required/>
                        </div>
                        <div class="form-group offset-1 col-4">
                            <label for="cap" class="col-text">CAP</label>
                            <input type="number" min=0 step="1" class="col-back-white form-control" name="cap" id="cap" autocomplete="on" required/>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-group">
                    <legend class="col-text">Immagine di profilo</legend>
                    <div class="row">
                        <div class="col-12 mt-1 mb-4 align-center">
                            <div class="mx-auto avatar-container">
                                <img src="/spaceair/res/icons/decorative/user.jpeg" id="previewimg" class="avatar-img rounded-circle" alt="Immagine selezionata"/>
                            </div>
                        </div>
                    </div>
                    <input type="file" class="rounded p-1 col-back-white" name="img" id="img"/>
                    <label for="img" class="">Clicca per inserire</label>
                </fieldset>

                <div class="custom-control custom-checkbox mt-5">
                    <input type="checkbox" class="custom-control-input" name="newsletter" id="newsletter">
                    <label class="col-text font-weight-light custom-control-label" for="newsletter">Accetto di ricevere la newsletter</label>
                </div>
                <input type="submit" class="mt-2 py-2 col-12 btn col-btn-impo col-title font-weight-light" value="Registrati"/> 
            </form>
            <p class="mt-1 col-text font-weight-light">Hai gi&agrave; un account? <a href="#" class="col-link">Login</a></p>
        </div>
    </div>
</section>
