<section>
    <header>
        <div class="row">
            <div class="col-10 offset-1 col-md-6 offset-md-3 px-0 offset-md-2">
                    <h1 class="text-left col-title font-weight-lighter">Elenco Passeggeri</h1>
            </div>
        </div>
    </header>
    <table class="mt-5 col-10 offset-1 col-md-6 offset-md-3 table table-light table-striped">
        <thead class="col-btn-impo">
            <tr>    
                <th id="nominativo">Nome Cognome</th>
                <th id="quantita">Quantit&agrave;</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data["passengers"] as $passenger) : ?>
                <tr>
                    <td headers="nominativo"><?php echo $passenger["user"]->getName() . " " . $passenger["user"]->getSurname(); ?></td>
                    <td headers="quantita"><?php echo $passenger["quantity"]; ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</section>