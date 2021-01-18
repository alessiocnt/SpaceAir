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
        <form action="">
            <div class="row mb-3">
                <div class="container">
                    <label for="inputDestination">Destinazione</label>
                    <select name="inputDestination" id="inputDestination" class="form-control">
                        <option selected value="Marte">Marte</option>
                        <option value="Venere">Venere</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label for="inputDate">Data</label>
                    <input type="date" class="form-control" name="inputDate" id="inputDate" value="2021-01-18" required />
                </div>
                <div class="col-6">
                    <label for="inputHour">Ora partenza</label>
                    <input type="time" class="form-control" name="inputHour" id="inputHour" value="12:09" required />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label for="inputCapacity">Capienza</label>
                    <input type="number" min="0" max="10000" step="1" class="form-control" name="inputCapacity" id="inputCapacity" value="13" required />
                </div>
                <div class="col-6">
                    <label for="inputPrice">Prezzo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">€</span>
                        </div>
                        <input type="number" min="0" step="1" class="form-control" name="inputPrice" id="inputPrice" value="3500" required />
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="container">
                    <label for="inputDescription">Descrizione</label>
                    <textarea class="form-control" name="inputDescription" id="inputDescription" rows="5" required>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec feugiat dui neque, id sodales dolor pellentesque ac. Nullam eleifend bibendum velit in fermentum. Integer sollicitudin venenatis turpis id fermentum. Donec interdum a enim congue gravida. Cras vulputate, risus non blandit finibus, nunc arcu tincidunt lectus, non cursus purus erat sit amet mi. Pellentesque vitae lacus in ex accumsan pretium. Nullam congue pretium mauris, ac aliquet nisi posuere a. Sed varius cursus magna, vel sagittis dui aliquet non. Donec vulputate, metus efficitur pulvinar molestie, turpis velit imperdiet quam, nec posuere lacus lectus quis turpis. </textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    <label for="inputVisible">Visibile</label>
                    <input type="checkbox" name="inputDescription" id="inputVisible">
                </div>
                <div class="col-4 offset-4 col-md-2 offset-md-6">
                    <input type="submit" class="form-control" value="Modifica" />
                </div>
            </div>
        </form>
    </div>
</div>