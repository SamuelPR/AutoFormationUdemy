<?php include "header.ink.php";
include "connexionPdo.php";
$req = $myPdo->prepare("SELECT * FROM nationalite");
$req->setFetchMode(PDO::FETCH_OBJ);
$req->execute();
$nationalites = $req->fetchAll();
?>
<div class="container mt-5">
    <div class="row pt-3">
        <div class="col-9"><h2>listes des nationalités</h2></div>
        <div class="col-3"><a href="formNationalite.php?action=Ajouter" class="btn btn-success"><i class="fas fa-plus-circle"></i> Créer une nationalité</a></div>
        
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
            foreach ($nationalites as $nationalite) {
                echo "<tr class=\"d-flex\">";
                echo "<td class=\"col-md-2\">$nationalite->num</td>";
                echo "<td class=\"col-md-8\">$nationalite->libelle</td>";
                echo "<td class=\"col-md-2\">
                <a href=\"formNationalite.php?action=Modifier&num=$nationalite->num\" class=\"btn btn-danger\"><i class=\"fas fa-pen\"></i></a>
                <a href=\"suppNationalite.php?num=$nationalite->num\" class=\"btn btn-primary\"><i class=\"fas fa-times-circle\"></i></a>
                </td>";
                echo "</tr>";
            }
            ?>

        </tbody>
    </table>
</div>


<?php include "footer.ink.php" ?>