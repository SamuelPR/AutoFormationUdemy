<div class="container mt-5">
    <div class="row pt-3">
        <div class="col-9">
            <h2>listes des Continents</h2>
        </div>
        <div class="col-3"><a href="formNationalite.php?action=Ajouter" class="btn btn-success"><i class="fas fa-plus-circle"></i> Créer un Continent</a></div>

    </div>
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr class="d-flex">
                <th scope="col" class="col-md-2">Numéro</th>
                <th scope="col" class="col-md-8">Libellé</th>
                <th scope="col" class="col-md-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($continents as $continent) {
                echo "<tr class=\"d-flex\">";
                echo "<td class=\"col-md-2\">$continent->getNum()</td>";
                echo "<td class=\"col-md-5\">$continent->libLibelle()</td>";
                echo "<td class=\"col-md-2\">
                <a href=\"formNationalite.php?action=Modifier&num=$nationalite->getNum()\" class=\"btn btn-danger\"><i class=\"fas fa-pen\"></i></a>
                <a href=\"#modalSuppression\" data-toggle=\"modal\" data-message=\"Voulez-vous supprimer cette nationalité?\"data-suppr=\"suppNationalite.php?num=$nationalite->getNum()\" class=\"btn btn-primary\"><i class=\"fas fa-times-circle\"></i></a>
                </td>";
                echo "</tr>";
            } ?>
        </tbody>
    </table>
</div>