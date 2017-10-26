<?php
namespace Core\Model\Db;

/**
 * Class PDO
 *
 * Connection à la BDD, sert d'intermédiaire entre PDO et l'application
 */
class PDO{

    /**
     * @var \PDO
     */
	private $_pdo;

    /**
     * PDO constructor.
     * @param String $dbHost Nom d'hôte
     * @param String $dbName Nom de la base
     * @param String $dbUser Nom d'utilisateur
     * @param String $dbPass Mot de passe de l'utilisateur
     */
	public function __construct($dbHost, $dbName, $dbUser, $dbPass){
		$pdo = new \PDO("mysql:host={$dbHost};dbname={$dbName};charset=utf8", $dbUser, $dbPass);
		$this->_pdo = $pdo;
	}

    /**
     * Applique le bon fetchMode et le bon fetch
     *
     * Utilisé par $this->query et $this->prepare
     *
     * @param  \PDOStatement $request
     * @param  String       $entity  Si renseigné, PDO hydratera l'objet correspondant
     *                               (!!! Le format est le nom complet de la classe, avec namespace !!!)
     * @param  Boolean      $one     Permet de choisir si l'on souhaite un ou plusieurs résultats
     * @return mixed|Array  $result  Une ou plusieurs entrées de la BDD, sous la forme d'un objet ou d'un tableau
     */
	private function fetchForMe(\PDOStatement $request, $entity, $one){

        if($entity !== null) $request->setFetchMode(\PDO::FETCH_CLASS, $entity);

        if($one) $result = $request->fetch();
        else     $result = $request->fetchAll();

        return $result;
    }

    /**
     * Retourne l'id du dernier élément inséré dans la base
     *
     * @return int
     */
    public function lastInsertId(){
        return $this->_pdo->lastInsertId();
    }

    /**
     * Execute une requête préparée SQL et retourne le résultat
     *
     * @param  SQLStatement     $statement Requête SQL à effectuer
     * @param  Array            $params    Paramètres nécessaires à la requête
     * @param  String           $entity    Si renseigné, PDO hydratera l'objet correspondant
     *                                     (!!! Le format est le nom complet de la classe, avec namespace !!!)
     * @param  bool             $one       Permet de choisir si l'on souhaite un ou plusieurs résultats
     * @return Array|mixed|void $result    Une ou plusieurs entrées de la BDD, sous la forme d'un objet ou d'un tableau, void si requête d'insert
     */
    public function prepare($statement, $params, $entity = null, $one = false){
        $req = $this->_pdo->prepare($statement);
        $req->execute($params);

        if(strpos($statement, 'INSERT')) return;

        $result = $this->fetchForMe($req, $entity, $one);

        return $result;
    }

    /**
     * Execute une requête SQL et retourne le résultat
     *
     * @param  SQLStatement      $statement Requête SQL à effectuer
     * @param  String            $entity    Si renseigné, PDO hydratera l'objet correspondant
     *                                      (!!! Le format est le nom complet de la classe, avec namespace !!!)
     * @param  bool              $one       Permet de choisir si l'on souhaite un ou plusieurs résultats
     * @return Array|mixed|void  $result    Une ou plusieurs entrées de la BDD, sous la forme d'un objet ou d'un tableau, void si requête d'insert
     */
	public function query($statement, $entity = null, $one = false){

		$req = $this->_pdo->query($statement);
        if(strpos($statement, 'INSERT')) return;

        $result = $this->fetchForMe($req, $entity, $one);
        return $result;
	}

}


