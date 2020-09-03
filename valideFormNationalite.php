<?php include "header.ink.php";
include "connexionPdo.php";
$action = $_GET["action"];
$num = $_POST["num"];
$libelle = $_POST["libelle"];

if ($action == "Modifier") {
    $req = $myPdo->prepare("UPDATE nationalite set libelle= :libelle where num = :num");
    $req->bindParam(":libelle", $libelle);
    $req->bindParam(":num", $num);

} else {
    $req = $myPdo->prepare("INSERT INTO nationalite(libelle) VALUES(:libelle)");
    $req->bindParam(":libelle", $libelle);
    
}
$nb = $req->execute();

$message=$action == "Modifier" ? "modifiée" : "ajoutée";

echo "<div class=<\"container mt-5\">";
echo "<div class=\"row \">
    <div class=\"col mt-5\">";
if ($nb == 1) {
    echo "<div class=\"alert alert-success mt-3\" role=\"alert\">
 La nationalité à bien été $message </div>";
} else {
    echo "<div class=\"alert alert-primary mt-3\" role=\"alert\">
    La nationalité n'a pas été $message </div>";
}
?>
</div>
</div>
<a href="listeNationalite.php" class="btn btn-danger">Revenir à la liste des nationalité</a>
</div>

<?php include "footer.ink.php" ?>