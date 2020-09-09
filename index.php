    <?php ob_start();
    session_start()?>
    <?php include("vues/header.ink.php");
    include_once("models/Continent.php");
    include_once("models/monPdo.php");
    include_once("vues/messageFlash.php");

    $uc = empty($_GET['uc']) ? "accueil" : $_GET['uc'];

    switch($uc){
        case 'accueil' :
            include_once('vues/accueil.php');
        break;
        case 'continents' :
            include_once("controller/continentController.php");
        break;
    }
    include "vues/footer.ink.php";?>
