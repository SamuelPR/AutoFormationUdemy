<?php
class Nationalite
{


    /**
     * Numéro du nationalité
     *
     * @var int
     */
    private $num;

    /**
     * Libelle du nationalité
     *
     * @var string
     */
    private $libelle;
/**
 * num continent (clé étranger) relié à num de Continent
 *
 * @var int
 */
    private $numContinent;


    /**
     * Get the value of num
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getLibelle(): string
    {
        return $this->libelle;
    }

    /**
     * écrit dans le libelle
     *
     * @param string $libelle
     * @return self
     */
    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * renvoie l'objet continent associé
     *
     * @return Continent
     */
    public function getNumContinent() : Continent
    {
        return Continent::findById($this->numContinent);
    }

    /**
     * ecrit le num continent
     *
     * @param Continent $Continent
     * @return self
     */
    public function setNumContinent(Continent $Continent) : self
    {
        $this->numContinent = $Continent->getNum();

        return $this;
    }

    
    /**
     * retourne l'ensebmle des nationalités
     *
     * @return Nationalite[] tableau d'objet nationalité
     */
    public static function findAll() : array
    {
        $req=MonPdo::getInstance()->prepare("select n.num, n.libelle as 'libNation', c.libelle as 'libContinent' from nationalite n, continent c where n.numContinent=c.num");
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $lesResultats=$req->fetchAll();
        return $lesResultats;
    }

    /**
     * Trouve un nationalite par son num
     *
     * @param integer $id numéro de nationalite
     * @return nationalite objet nationalite trouvé
     */
    public static function findById(int $id) :Nationalite
    {
        $req=MonPdo::getInstance()->prepare("SELECT * from nationalite where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'nationalite');
        $req->bindParam(':id', $id);
        $req->execute();
        $leResultat=$req->fetch();
        return $leResultat;
    
    }

    /**
     * Permet d'ajouter un nationalite
     *
     * @param Nationalite $nationalite nationalite à ajouter
     * @return integer resultat(1 si reussi, 0 si pas reussi)
     */
    public static function add(Nationalite $nationalite) :int{
        $req=MonPdo::getInstance()->prepare("insert into nationalite(libelle, numContinent) value(:libelle, :numContinent)");
        $req->bindParam(':libelle', $nationalite->getLibelle());
        $req->bindParam(':numContinent', $nationalite->getNumContinent());
        $nb=$req->execute();
        return $nb;
    

    }

    /**
     * permet de modifier le document
     *
     * @param Nationalite $nationalite nationalite à modifer
     * @return integer resultat(1 si reussi, 0 si pas reussi)
     */
    public static function update(Nationalite $nationalite) :int{
        $req=MonPdo::getInstance()->prepare("update nationalite set libelle= :libelle, numContinent= :numContinent where num= :id");
        $req->bindParam(':id', $nationalite->getNum());
        $req->bindParam(':libelle', $nationalite->getLibelle());
        $req->bindParam(':numContinent', $nationalite->getNumContinent());
        $nb=$req->execute();
        return $nb;
    }

    /**
     * permet de supprimer un nationalite
     *
     * @param Nationalite $nationalite la nationalite à supprimer
     * @return integer resultat(1 si reussi, 0 si pas reussi)
     */
    public static function delete(Nationalite $nationalite) :int{
        $req=MonPdo::getInstance()->prepare("delete from nationalite where num= :id");
        $req->bindParam(':id', $nationalite->getNum());
        $nb=$req->execute();
        return $nb;
    }

    
}