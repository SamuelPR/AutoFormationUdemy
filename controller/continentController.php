<?php 
$action=$_GET['action'];


switch($action){
    case 'list' :
        $continents = Continent::findAll();
        include_once("vues/listeContinent.php");
    break;

    case 'add' :
        $mode="Ajouters";
        include_once("vues/formContinent.php");
    break;

    case 'update' :
        $mode="Modifier";
        $continent=Continent::findById($_GET['num']);
        include_once("vues/formContinent.php");
    break;

    case 'delete' :
        $continent=Continent::findById($_GET['num']);
        $nb=Continent::delete($continent);
        if($nb==1){
            $_SESSION['message']=['succes'=>'Le continent a bien été supprimé'];
        }
        else{
            $_SESSION['message']=['warning'=>'Le continent a bien été supprimé'];
        }
        header('location: index.php?uc=continents&action=list');
    break;

    case 'valideForm' :
        $continent=new Continent();
        if(empty($_POST['num'])){
            $continent->setLibelle($_POST['libelle']);
            $nb=COntinent::add($continent);
            $message = "ajouté";
        }
        else{
            $continent->setNum($_POST['num']);
            $continent->setLibelle($_POST['libelle']);
            $nb=COntinent::update($continent);
            $message = "modifié";
        }
        if($nb==1){
            $_SESSION['message']=['succes'=>'Le continent a bien été $message'];
        }
        else{
            $_SESSION['message']=['warning'=>'Le continent a bien été $message'];
        }
        header('location: index.php?uc=continents&action=list');
    break;
}