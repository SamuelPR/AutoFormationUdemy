<?php include_once "header.ink.php";
include_once "connexionPdo.php";
$action = $_GET["action"];
$num = $_POST["num"];
$libelle = $_POST["libelle"];
$continent = $_POST["continent"];

if ($action == "Modifier") {
    $req = $myPdo->prepare("UPDATE nationalite set libelle= :libelle numContinent= :continent where num = :num");
    $req->bindParam(":libelle", $libelle);
    $req->bindParam(":num", $num);
    $req->bindParam(":continent", $continent);

} else {
    $req = $myPdo->prepare("INSERT INTO nationalite(libelle, numContinent) VALUES(:libelle, :continent)");
    $req->bindParam(":libelle", $libelle);
    $req->bindParam(":continent", $continent);
    
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

<?php include_once "footer.ink.php" ?>