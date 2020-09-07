    <?php session_start()?>
    <?php include "vues/header.ink.php";

    $uc = empty($_GET['uc']) ? "accueil" : $_GET['uc'];

    switch($uc){
        case 'accueil' :
            include_once('vues/accueil.php');
        break;
        case 'continents' :
            
        break;
    }
    include "vues/footer.ink.php";?>
