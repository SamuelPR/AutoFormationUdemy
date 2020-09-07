<?php include_once "header.ink.php";
$action = $_GET["action"];
include_once "connexionPdo.php";
if ($action == "Modifier") {
    
    $num = $_GET["num"];
    $req = $myPdo->prepare("SELECT * FROM nationalite where num = :num");
    $req->setFetchMode(PDO::FETCH_OBJ);
    $req->bindParam(":num", $num);
    $req->execute();
    $nationalite = $req->fetch();
}
$reqContinent = $myPdo->prepare("SELECT * FROM continent");
    $reqContinent->setFetchMode(PDO::FETCH_OBJ);
    $reqContinent->execute();
    $myContinent=$reqContinent->fetchAll();


?>
<div class="container mt-5">
    <h2 class="pt-3 text-center"><?php echo $action ?> une nationalité</h2>
    <form action="valideFormNationalite.php?action=<?php echo $action?>" method="post" class="col-md-6 offset-md-3 border border-danger p-3 rounded">
        <div class="form-group">
            <label for="libelle">Libellé</label>
            <input type="text" class="form-control " id="libelle" placeholder="Saisir le libellé" name="libelle" value="<?php if($action == "Modifier"){echo $nationalite->libelle;} ?>">
        </div>
        <div class="form-group">
            <label for="continent">Continent</label>
            <select name="continent" class="form-control">
                <?php
                    foreach($myContinent as $continent){
                        $selection=$continent->num == $nationalite->numContinent ? 'selected' : '';
                        echo "<option value='$continent->num' $selection>$continent->libelle</option>";
                    }
                
                ?>
            </select>
        </div>
        <input type="hidden" id="num" name="num" value="<?php if($action == "Modifier"){echo $nationalite->num;} ?>">
        <div class="row">
            <div class="col"><a href="listeNationalite.php" class="btn btn-danger btn-block"> Revenir à la liste</a> </div>
            <div class="col"><button type="submit" class="btn btn-success btn-block"><?php echo $action ?></button></div>
        </div>

    </form>
</div>


<?php include_once "footer.ink.php" ?>