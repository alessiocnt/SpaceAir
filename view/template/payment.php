<div class="row">
    <header class="col-md-6 offset-md-3 offset-1">
        <div class="row">
            <div class="col-12 pl-0">
                <h1 class="text-left col-title font-weight-lighter">Pagamento</h1>
            </div>
        </div>
    </header>
</div>
<section>
    <article>
        <div class="row">
            <div class="top-line col-md-6 offset-md-3 mb-6">
                <h2 class="text-center col-title font-weight-lighter mt-12">Indirizzo di consegna</h2>
                <form action="#" id="formAddr">
                    <div class="row mb-3 mt-2">
                        <div class="col-9">
                            <label for="inputVia">Via</label>
                            <input type="text" class="form-control" name="inputVia" id="inputVia" value="<?=$data["Address"]->getVia();?>" required />
                        </div>
                        <div class="col-3">
                            <label for="inputCivico">Civico</label>
                            <input type="text" class="form-control" name="inputCivico" id="inputCivico" value="<?=$data["Address"]->getCivico();?>" required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="inputCitta">Città</label>
                            <input type="text" class="form-control" name="inputCitta" id="inputCitta" value="<?=$data["Address"]->getCitta();?>" required />
                        </div>
                        <div class="col-3">
                            <label for="inputProvincia">Provincia</label>
                            <input type="text" class="form-control" name="inputProvincia" id="inputProvincia" value="<?=$data["Address"]->getProvincia();?>" required />
                        </div>
                        <div class="col-3">
                            <label for="inputCap">Cap</label>
                            <input type="number" min="10000" max="99999" step="1" class="form-control" name="inputCap" id="inputCap" value="<?=$data["Address"]->getCap();?>"required />
                        </div>
                    </div>
                    <div class="row mb-3">
                    <div class="col-8 col-md-10 col-error" id="changeAddressResult"></div>
                        <div class="col-4 offset-8 col-md-2 offset-md-10">
                            <input type="submit" class="form-control" value="Conferma" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </article>
    <article>
        <div class="row">
            <div class="top-line col-md-6 offset-md-3 mb-6">
                <h2 class="text-center col-title font-weight-lighter mt-12">Metodo di pagamento</h2>
                <div class="row">
                    <div class="col-3 offset-2 col-md-1 offset-md-4">
                        <div class="rounded my-2 col-back-white p-1 col-dark">
                            <a href="" id="cred" title="Paga con carta di credito">
                                <img src="/spaceair/res/icons/credit_card-black-18dp.svg" alt="Paga tramite carta di credito" class="rounded mx-auto d-block pt-2 pb-2" />
                            </a>
                        </div>
                    </div>
                    <div class="col-3 offset-2 col-md-1 offset-md-2">
                        <div class="rounded my-2 col-back-white p-1 col-dark">
                            <a href="" id="paypal" title="Paga con PayPal">
                                <img src="/spaceair/res/icons/paypal.svg" alt="Paga tramite PayPal" class="rounded mx-auto d-block pt-2 pb-2" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <article id="card">
        <div class="row">
            <div class="top-line col-md-6 offset-md-3 mb-6">
                <form action="">
                    <div class="row mb-3 mt-2">
                        <div class="col-12">
                            <label for="inputNumeroCarta">Numero carta</label>
                            <input type="number" minlength="13" step="1" min="0" class="form-control" name="inputNumeroCarta" id="inputNumeroCarta" required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="inputIntestatario">Intestatario carta</label>
                            <input type="text" class="form-control" name="inputIntestatario" id="inputIntestatario" required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-3">
                            <label for="inputCcv">CCV</label>
                            <input type="number" minlength="3" step="1" min="0" class="form-control" name="inputCcv" id="inputCcv" required />
                        </div>
                        <div class="col-9">
                            <label for="inputScadenza">Data di scadenza</label> <!-- TODO sistemare label per mobile -->
                            <input type="month" class="form-control" name="inputScadenza" id="inputScadenza" required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-10 offset-2 col-md-5 offset-md-7">
                            <input type="submit" class="form-control" value="Conferma Metodo di Pagamento" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </article>
    <article>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="row top-line">
                    <div class="container">
                        <p id="tot" class="font-weight-normal col-text my-0 float-right mr-md-1 mt-2 mb-2">Totale €<?=$data["Totale"];?></p>
                    </div>
                </div>
                <div class="row">
                <div class="col-6 col-md-9 col-error" id="paymentResult"></div>
                    <div class="col-6 col-md-3">
                        <form action="#" id="formPayment">
                            <input type="submit" id="acq" class="form-control float-right mb-4" value="Procedi all'acquisto" disabled/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </article>
</section>