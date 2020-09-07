<?php
class Continent
{


    /**
     * Numéro du continent
     *
     * @var int
     */
    private $num;

    /**
     * Libelle du continent
     *
     * @var string
     */
    private $libelle;


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
     * retourne l'ensebmle des continents
     *
     * @return Continent[] tableau d'objet continent
     */
    public static function findAll() : array
    {
        $req=MonPdo::getInstance()->prepare("SELECT * from continent");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Continent');
        $req->execute();
        $lesResultats=$req->fetchAll();
        return $lesResultats;
    }

}
