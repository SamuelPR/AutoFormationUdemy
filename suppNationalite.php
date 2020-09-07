<?php session_start();
include_once "connexionPdo.php";
$num = $_GET["num"];

$req = $myPdo->prepare("DELETE FROM nationalite WHERE num = :num");
$req->bindParam(":num", $num);
$nb = $req->execute();

if ($nb == 1) {
    $_SESSION['messages']=["success"=>" La nationalité à bien été supprimé"];
} else {
    $_SESSION['messages']=["warning"=>" La nationalité m'a pas été supprimé"];
}
header('location: listeNationalite.php');
exit();

?>