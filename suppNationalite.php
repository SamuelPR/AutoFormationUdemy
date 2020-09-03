<?php include "header.ink.php";
include "connexionPdo.php";
$num = $GET["num"];

$req = $myPdo->prepare("DELETE FROM nationalite where num = :num");
$req->bindParam(":num", $num);
$nb = $req->execute();


echo "<div class=<\"container mt-5\">";
echo "<div class=\"row \">
    <div class=\"col mt-5\">";
if ($nb == 1) {
    echo "<div class=\"alert alert-success mt-3\" role=\"alert\">
 La nationalité à bien été supprimé </div>";
} else {
    echo "<div class=\"alert alert-primary mt-3\" role=\"alert\">
    La nationalité n'a pas été supprimé </div>";
}
?>
</div>
</div>
<a href="listeNationalite.php" class="btn btn-danger">Revenir à la liste des nationalité</a>
</div>

<?php include "footer.ink.php" ?>