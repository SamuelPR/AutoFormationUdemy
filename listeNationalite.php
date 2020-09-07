<?php include_once "header.ink.php";
include_once "connexionPdo.php";
$textReq="select n.num, n.libelle as 'libNation', c.libelle as 'libContinent' from nationalite n, continent c where n.numContinent=c.num";

$libelle="";
$continentVariable="Tous";
if(!empty($_GET)){
    $libelle=$_GET['libelle'];
    $continentVariable=$_GET['continent'];
    if($libelle != ""){ $textReq.=" and n.libelle like '%" .$libelle."%'";}
    if($continentVariable != "Tous"){ $textReq.=" and c.num =" .$continentVariable;}
}

$textReq.=" order by n.libelle";
$req = $myPdo->prepare($textReq);
$req->setFetchMode(PDO::FETCH_OBJ);
var_dump($textReq);
$req->execute();
$nationalites = $req->fetchAll();

$reqContinent = $myPdo->prepare("SELECT * FROM continent");
    $reqContinent->setFetchMode(PDO::FETCH_OBJ);
    $reqContinent->execute();
    $myContinent=$reqContinent->fetchAll();

if(!empty($_SESSION['messages'])){
    $myMessages = $_SESSION['messages'];
    foreach($myMessages as $key=>$message){
        echo '<div class="alert alert-'.$key.' alert-dismissible fade show mt-2" role="alert">'.$message.'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    }
    $_SESSION['messages']=[];
}
?>



<div class="container mt-5">
    <div class="row pt-3">
        <div class="col-9">
            <h2>listes des nationalités</h2>
        </div>
        <div class="col-3"><a href="formNationalite.php?action=Ajouter" class="btn btn-success"><i class="fas fa-plus-circle"></i> Créer une nationalité</a></div>

    </div>
    <form action="" method="get" class="border border-primary rounded p-3 mt-3 mb-3"> 
        <div class="row">
            <div class="col">
                <input type="text" class="form-control " id="libelle" placeholder="Saisir le libellé" name="libelle" value=" <?php echo $libelle; ?>">
            </div>
            <div class="col">
            <select name="continent" class="form-control">
                <?php
                echo "<option value='Tous'>Tous les continents </option>";
                    foreach($myContinent as $continent){
                        $selection=$continent->num == $continentVariable ? 'selected' : '';
                        echo "<option value='$continent->num' $selection>$continent->libelle</option>";
                    }
                
                ?>
            </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-success btn-block"> Rechercher</button>
            </div>
        </div>
    </form>


    <table class="table table-hover">
        <thead class="thead-dark">
            <tr class="d-flex">
                <th scope="col" class="col-md-2">Numéro</th>
                <th scope="col" class="col-md-5">Libellé</th>
                <th scope="col" class="col-md-3">Continent</th>
                <th scope="col" class="col-md-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($nationalites as $nationalite) {
                echo "<tr class=\"d-flex\">";
                echo "<td class=\"col-md-2\">$nationalite->num</td>";
                echo "<td class=\"col-md-5\">$nationalite->libNation</td>";
                echo "<td class=\"col-md-3\">$nationalite->libContinent</td>";
                echo "<td class=\"col-md-2\">
                <a href=\"formNationalite.php?action=Modifier&num=$nationalite->num\" class=\"btn btn-danger\"><i class=\"fas fa-pen\"></i></a>
                <a href=\"#modalSuppression\" data-toggle=\"modal\" data-message=\"Voulez-vous supprimer cette nationalité?\"data-suppr=\"suppNationalite.php?num=$nationalite->num\" class=\"btn btn-primary\"><i class=\"fas fa-times-circle\"></i></a>
                </td>";
                echo "</tr>";
            } ?>
        </tbody>
    </table>
</div>
<?php include_once "footer.ink.php" ?>