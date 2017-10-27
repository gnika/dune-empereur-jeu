<?php

class Customer_Model_Mapper_User
{
    protected $_dbTable;
   
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Customer_Model_DbTable_User');
        }
        return $this->_dbTable;
    }
    
    public function save(Customer_Model_User $user)
    {
        $data = array(  'cuu_id'            => $user->getId(),
                        'cuu_login'         => $user->getLogin(),
                        'cuu_name'          => $user->getLogin(),
                        'cuu_email'         => $user->getEmail(),
                        'cuu_password'      => $user->getPassword(),
                        'cuu_securitytoken' => $user->getSecuritytoken(),
                        'cuu_jour' => $user->getJour(),
                        'cuu_heure' => $user->getHeure(),
                        'cuu_epice'         => $user->getEpice(),
                        'cuu_impot'         => $user->getImpot(),
                        'cuu_soin'         => $user->getSoin(),
                        'cuu_serviteur'         => $user->getServiteur(),
                        'cuu_influence'         => $user->getInfluence(),
                        'cuu_gardien'        =>$user->getGardien(),
                        'cuu_vaisseau'        =>$user->getVaisseau(),
                        'cuu_troupe'        =>$user->getTroupe(),
                        'cuu_corruption'        =>$user->getCorruption(),
                        'cuu_entretien'        =>0,
                        'cuu_salle'        =>$user->getSalle(),
                        'cuu_nb_victime'        =>$user->getNbVictime(),
                        'cuu_valeur_serviteur'        =>$user->getValeurServiteur(),
                        'cuu_valeur_troupe'        =>0,
                        'cuu_valeur_vaisseau'        =>$user->getValeurVaisseau(),
                        'cuu_entrainement'        =>0,
                        'cuu_delai_attentat'        =>$user->getDelaiAttentat(),
                        'cuu_exploration'        =>$user->getExploration(),
                        'cuu_renommee'        =>$user->getRenommee(),
                        'cuu_objets'        =>$user->getObjets(),
                        'cuu_rapport_planete'        =>$user->getRapport(),
                        'cuu_connexion'        =>$user->getConnexion()
                        
                    );
        if (null === ($id = $user->getId())) {
            unset($data['cuu_id']);
            return $this->getDbTable()->insert($data);
			
		} else {
            unset($data['cuu_password']);
            $this->getDbTable()->update($data, array('cuu_id = ?' => $id));
        }
    }
	
	public function addDay(){
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
		$db->update('customer_user', array('cuu_impot'=>new Zend_Db_Expr("cuu_impot + 1 ")),
		array('cuu_id  = ?' => $idUser));
	}
	
	public function inscription($idUser){
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$query='delete from porte_user where poru_id_user='.$idUser;
		$db->query($query);
		$query='delete from objet_user where obu_id_user='.$idUser;
		$db->query($query);
		$query='delete from salle_perso where sal_id_user='.$idUser;
		$db->query($query);
		$query='delete from user_quete where us_id_user='.$idUser;
		$db->query($query);
		$query='delete from serviteur where ser_id_user='.$idUser;
		$db->query($query);
		$query='delete from suggestion_epice where sug_id_user='.$idUser;
		$db->query($query);
		$query='delete from influence where inf_id_user='.$idUser;
		$db->query($query);
		$query='delete from gardien where gar_id_user='.$idUser;
		$db->query($query);
		$query='delete from humeur_faction where hum_id_user='.$idUser;
		$db->query($query);
		$query='delete from arret_quote where arr_id_user='.$idUser;
		$db->query($query);
		$query='delete from carte_user where cau_id_user='.$idUser;
		$db->query($query);
		
		$query='insert into porte_user (poru_id_porte, poru_id_user, poru_etat) values(1, '.$idUser.', 0),(2, '.$idUser.', 0),(3, '.$idUser.', 0),(4, '.$idUser.', 0),(5, '.$idUser.', 0),
		(6, '.$idUser.', 1),(7, '.$idUser.', 1),(8, '.$idUser.', 1)';
		// echo $query;die();
		$db->query($query);
		$query='insert into salle_perso (sal_id_salle, sal_id_user, sal_id_perso) values(1, '.$idUser.', 1),(1, '.$idUser.', 2),(9, '.$idUser.', 3),(1, '.$idUser.', 4),(1, '.$idUser.', 5),
		(1, '.$idUser.', 6),(1, '.$idUser.', 7),(1, '.$idUser.', 8),(5, '.$idUser.', 9),(3, '.$idUser.', 10),(7, '.$idUser.', 11),(2, '.$idUser.', 12),
		(13, '.$idUser.', 13),(13, '.$idUser.', 14),(15, '.$idUser.', 15),(10, '.$idUser.', 16),(13, '.$idUser.', 17),(9, '.$idUser.', 18),(14, '.$idUser.', 19),
		(33, '.$idUser.', 20),(11, '.$idUser.', 21),(34, '.$idUser.', 22),(333, '.$idUser.', 23),(23, '.$idUser.', 24),(777, '.$idUser.', 25),(34, '.$idUser.', 26)';
		// echo $query;die();
		$db->query($query);
		$query='insert into user_quete (us_id_user, us_id_quete, us_id_perso, us_id_ext) values('.$idUser.', 0, 1, 0),('.$idUser.', 0, 2, 0),('.$idUser.', 0, 3, 0),('.$idUser.', 0, 4, 0),
		('.$idUser.', 0, 5, 0),('.$idUser.', 0, 6, 0),('.$idUser.', 0, 7, 0),('.$idUser.', 0, 8, 0),('.$idUser.', 0, 9, 0),('.$idUser.', 0, 10, 0),('.$idUser.', 0, 11, 0),
		('.$idUser.', 0, 12, 0),('.$idUser.', 0, 13, 0),('.$idUser.', 0, 14, 0),('.$idUser.', 0, 15, 0),('.$idUser.', 0, 16, 0),('.$idUser.', 0, 17, 0),('.$idUser.', 0, 18, 0),
		('.$idUser.', 0, 19, 0),('.$idUser.', 0, 20, 0),('.$idUser.', 0, 21, 0),('.$idUser.', 0, 22, 0),('.$idUser.', 0, 23, 0),('.$idUser.', 0, 24, 0),('.$idUser.', 0, 25, 0),
		('.$idUser.', 0, 26, 0)';
		// echo $query;die();
			$db->query($query);
			$query='insert into serviteur (ser_id_user, ser_id_faction, ser_nb_serviteur) values('.$idUser.', 3, 0),('.$idUser.', 4, 0),('.$idUser.', 5, 0),('.$idUser.', 6, 0)';
			// echo $query;die();
			$db->query($query);
		$db->query($query);
		$query='insert into suggestion_epice (sug_id_user, sug_id_faction, sug_nb_suggestion) values('.$idUser.', 3, 40),('.$idUser.', 4, 40),('.$idUser.', 5, 40),('.$idUser.', 6, 40)';
		// echo $query;die();
		$db->query($query);
		$query='insert into influence (inf_id_user, inf_id_faction, inf_nb_influence) values('.$idUser.', 3, 0),('.$idUser.', 4, 0),('.$idUser.', 5, 0),('.$idUser.', 6, 0)';
		// echo $query;die();
		$db->query($query);
		$query='insert into gardien (gar_id_user, gar_id_faction, gar_nb_gardien) values('.$idUser.', 3, 0),('.$idUser.', 4, 0),('.$idUser.', 5, 0),('.$idUser.', 6, 0)';
		// echo $query;die();
		$db->query($query);
		$query='insert into  humeur_faction (hum_id_user, hum_id_faction, hum_humeur) values('.$idUser.', 3, 0),('.$idUser.', 4, 0),('.$idUser.', 5, 0),('.$idUser.', 6, 0),
		('.$idUser.', 1, 0),('.$idUser.', 2, 0)';
		// echo $query;die();
		$db->query($query);
	}
        
    public function find($id, Customer_Model_User $user )
    {
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        // if ($member == null) {
            // return;
        // }
		$idUser=$member->cuu_id;
		if($id==0)$id=$idUser;
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        // print_r($result);die();
        $row = $result->current();
        $user         ->setId($row->cuu_id)
                      ->setLogin($row->cuu_login)
                      ->setName($row->cuu_name)
                      ->setEmail($row->cuu_email)
                      ->setSecuritytoken($row->cuu_securitytoken)
                      ->setJour($row->cuu_jour)
                      ->setHeure($row->cuu_heure)
                      ->setEpice($row->cuu_epice)
                    ->setImpot($row->cuu_impot)
                    ->setSoin($row->cuu_soin)
                    ->setServiteur($row->cuu_serviteur)
                    ->setInfluence($row->cuu_influence)
                    ->setGardien($row->cuu_gardien)
					->setVaisseau($row->cuu_vaisseau)
                    ->setTroupe($row->cuu_troupe)
                    ->setCorruption($row->cuu_corruption)
                    ->setEntretien($row->cuu_entretien)
                    ->setSalle($row->cuu_salle)
                    ->setNbVictime($row->cuu_nb_victime)
                    ->setValeurServiteur($row->cuu_valeur_serviteur)
                    ->setValeurTroupe($row->cuu_valeur_troupe)
                    ->setValeurVaisseau($row->cuu_valeur_vaisseau)
                    ->setEntrainement($row->cuu_entrainement)
                    ->setDelaiAttentat($row->cuu_delai_attentat)
                    ->setExploration($row->cuu_exploration)
                    ->setRenommee($row->cuu_renommee)
                    ->setObjets($row->cuu_objets)
                    ->setRapport($row->cuu_rapport_planete)
                    ->setConnexion(date('d-m-Y H:i'));
                     
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        
        foreach ($resultSet as $row) {
            $entry = new Customer_Model_User();
            $entry  ->setId($row->cuu_id)
                      ->setLogin($row->cuu_login)
                      ->setName($row->cuu_name)
                      ->setEmail($row->cuu_email)
                      ->setSecuritytoken($row->cuu_securitytoken)
                      ->setJour($row->cuu_jour)
                      ->setHeure($row->cuu_heure)
                      ->setEpice($row->cuu_epice)
                    ->setImpot($row->cuu_impot)
                    ->setSoin($row->cuu_soin)
                    ->setServiteur($row->cuu_serviteur)
                    ->setInfluence($row->cuu_influence)
                    ->setGardien($row->cuu_gardien)
					->setVaisseau()
                    ->setTroupe()
                    ->setCorruption()
                    ->setEntretien($row->cuu_entretien)
                    ->setSalle($row->cuu_salle)
					->setNbVictime($row->cuu_nb_victime)
                    ->setValeurServiteur($row->cuu_valeur_serviteur)
                    ->setValeurTroupe($row->cuu_valeur_troupe)
                    ->setValeurVaisseau($row->cuu_valeur_vaisseau)
                    ->setEntrainement($row->cuu_entrainement)
                    ->setDelaiAttentat($row->cuu_delai_attentat)
					->setExploration($row->cuu_exploration)
                    ->setRenommee($row->cuu_renommee)
                    ->setObjets($row->cuu_objets)
                    ->setRapport($row->cuu_rapport_planete)
                    ->setConnexion(date('d-m-Y H:i'));
            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function findByEmail( $cuu_email, Customer_Model_User $user )
    {
    
        
        $query      = $this -> getDbTable()     -> select()
                                                -> where( 'cuu_email= "'.$cuu_email.'"' ); 
        $row        = $this->getDbTable()->fetchRow( $query ); 

        if ( null !== $row ){
            $user       ->setId($row->cuu_id)
                      ->setLogin($row->cuu_login)
                      ->setName($row->cuu_name)
                      ->setEmail($row->cuu_email)
                      ->setPasswordNotMd5($row->cuu_password)
                      ->setSecuritytoken($row->cuu_securitytoken)
                      ->setJour($row->cuu_jour)
                      ->setHeure($row->cuu_heure)
                      ->setEpice($row->cuu_epice)
                    ->setImpot($row->cuu_impot)
                    ->setSoin($row->cuu_soin)
                    ->setServiteur($row->cuu_serviteur)
                    ->setInfluence($row->cuu_influence)
                    ->setGardien($row->cuu_gardien)
					->setVaisseau()
                    ->setTroupe()
                    ->setCorruption()
                    ->setEntretien($row->cuu_entretien)
                    ->setSalle($row->cuu_salle)
					->setNbVictime($row->cuu_nb_victime)
                    ->setValeurServiteur($row->cuu_valeur_serviteur)
                    ->setValeurTroupe($row->cuu_valeur_troupe)
                    ->setValeurVaisseau($row->cuu_valeur_vaisseau)
                    ->setEntrainement($row->cuu_entrainement)
                    ->setDelaiAttentat($row->cuu_delai_attentat)
					->setExploration($row->cuu_exploration)
                    ->setRenommee($row->cuu_renommee)
					->setObjets($row->cuu_objets)
					->setRapport($row->cuu_rapport_planete)
					->setConnexion(date('d-m-Y H:i'))
					;
        }
        else {
            $user->setId(-1);
        }
    }
	
	public function findByLogin( $cuu_login, Customer_Model_User $user )
    {
    
        
        $query      = $this -> getDbTable()     -> select()
                                                -> where( 'cuu_login= "'.$cuu_login.'"' ); 
        $row        = $this->getDbTable()->fetchRow( $query ); 

        if ( null !== $row ){
            $user       ->setId($row->cuu_id)
                      ->setLogin($row->cuu_login)
                      ->setName($row->cuu_name)
                      ->setEmail($row->cuu_email)
                      ->setPasswordNotMd5($row->cuu_password)
                      ->setSecuritytoken($row->cuu_securitytoken)
                      ->setJour($row->cuu_jour)
                      ->setHeure($row->cuu_heure)
                      ->setEpice($row->cuu_epice)
                    ->setImpot($row->cuu_impot)
                    ->setSoin($row->cuu_soin)
                    ->setServiteur($row->cuu_serviteur)
                    ->setInfluence($row->cuu_influence)
                    ->setGardien($row->cuu_gardien)
					->setVaisseau()
                    ->setTroupe()
                    ->setCorruption()
                    ->setEntretien($row->cuu_entretien)
                    ->setSalle($row->cuu_salle)
					->setNbVictime($row->cuu_nb_victime)
                    ->setValeurServiteur($row->cuu_valeur_serviteur)
                    ->setValeurTroupe($row->cuu_valeur_troupe)
                    ->setValeurVaisseau($row->cuu_valeur_vaisseau)
                    ->setEntrainement($row->cuu_entrainement)
                    ->setDelaiAttentat($row->cuu_delai_attentat)
					->setExploration($row->cuu_exploration)
                    ->setRenommee($row->cuu_renommee)
					->setObjets($row->cuu_objets)
					->setRapport($row->cuu_rapport_planete)
					->setConnexion(date('d-m-Y H:i'))
					;
        }
        else {
            $user->setId(-1);
        }
    }
	
	public function majSalle($idSalle)
	{
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
		$db->update('customer_user', array('cuu_salle'=>$idSalle),
		array('cuu_id  = ?' => $idUser));
	}
	
	public function majEntretien($idE=null)
	{
		if($idE==null)$idE=0;
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
		if($idE==0)
			$db->update('customer_user', array('cuu_entretien'=>$idE),
			array('cuu_id  = ?' => $idUser));
		else
			$db->update('customer_user', array('cuu_entretien'=>new Zend_Db_Expr("CONCAT(cuu_entretien, ',', $idE)")),
			array('cuu_id  = ?' => $idUser));
		
		
		
	}
	
	public function majVaisseau($nbVaisseau)
	{
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
		$db->update('customer_user', array('cuu_vaisseau'=>new Zend_Db_Expr("cuu_vaisseau + $nbVaisseau ")),
		array('cuu_id  = ?' => $idUser));
	}
	
	public function majTroupe($nbTroupe)
	{
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
		$db->update('customer_user', array('cuu_troupe'=>new Zend_Db_Expr("cuu_troupe + $nbTroupe ")),
		array('cuu_id  = ?' => $idUser));
	}
	
	public function majuserinfluence($idFaction)
	{
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$db->update('customer_user', array('cuu_influence'=>new Zend_Db_Expr("cuu_influence - 1 ")),
		array('cuu_id  = ?' => $idUser));
		
		$db->update('influence', array('inf_nb_influence'=>new Zend_Db_Expr("inf_nb_influence + 1 ")),
		array('inf_id_user  = ?' => $idUser, 'inf_id_faction  = ?' => $idFaction));
		
	}
	
	public function majuserServiteur($idFaction)
	{
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
		$us=new Customer_Model_User();
		$this->find($idUser, $us);
		$valueServiteur=$us->getValeurServiteur();
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$db->update('customer_user', array('cuu_serviteur'=>new Zend_Db_Expr("cuu_serviteur - 1 ")),
		array('cuu_id  = ?' => $idUser));
		
		$db->update('serviteur', array('ser_nb_serviteur'=>new Zend_Db_Expr("ser_nb_serviteur + 1 ")),
		array('ser_id_user  = ?' => $idUser, 'ser_id_faction  = ?' => $idFaction));
		
		$db->update('humeur_faction', array('hum_humeur'=>new Zend_Db_Expr("hum_humeur + $valueServiteur ")),
		array('hum_id_user  = ?' => $idUser, 'hum_id_faction  = ?' => $idFaction));
		
	}
	
	public function majServiteur($value, $idFaction)
	{
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
		$us=new Customer_Model_User();
		$this->find($idUser, $us);
		$valueServiteur=$us->getValeurServiteur();
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);

		$servActuelle=$this->getServiteurFaction($idFaction);
		$humActuelle=$this->getHumeurFaction($idFaction);
		if($servActuelle+$value < 0)
			$value=-$servActuelle;
			
		$humeurAjout=$value*$valueServiteur;
		if($humActuelle+$humeurAjout < 0)
			$humeurAjout=-$humActuelle;
		
		$db->update('serviteur', array('ser_nb_serviteur'=>new Zend_Db_Expr("ser_nb_serviteur + $value ")),
		array('ser_id_user  = ?' => $idUser, 'ser_id_faction  = ?' => $idFaction));
		
		$db->update('humeur_faction', array('hum_humeur'=>new Zend_Db_Expr("hum_humeur + $humeurAjout ")),
		array('hum_id_user  = ?' => $idUser, 'hum_id_faction  = ?' => $idFaction));
		
	}
	
	public function majEscorte($value, $idFaction, $attentat)
	{
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();

        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
		
		$escActuelle=$this->getEscorteFaction($idFaction);
		if($escActuelle+$value < 0){
			$value=$escActuelle+$value;
			if($attentat){
				$servs=$escActuelle+$value;
				$this->majServiteur($servs, $idFaction);
			}
		}
		
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		if($escActuelle+$value<0)$value=-$escActuelle;
		$db->update('gardien', array('gar_nb_gardien'=>new Zend_Db_Expr("gar_nb_gardien + $value ")),
		// $db->update('gardien', array('gar_nb_gardien'=>(new Zend_Db_Expr("gar_nb_gardien + $value ")<0)?0:new Zend_Db_Expr("gar_nb_gardien + $value ")),
		array('gar_id_user  = ?' => $idUser, 'gar_id_faction  = ?' => $idFaction));
	}
	
	public function majInfluence($value, $idFaction)
	{
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
		$us=new Customer_Model_User();
		$this->find($idUser, $us);
		$valueServiteur=$us->getValeurServiteur();
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$infActuelle=$this->getInfluenceFaction($idFaction);
		if($infActuelle+$value < 0)
			$value=-$infActuelle;
		
		$db->update('influence', array('inf_nb_influence'=>new Zend_Db_Expr("inf_nb_influence + $value ")),
                array('inf_id_user  = ?' => $idUser, 'inf_id_faction  = ?' => $idFaction));
	}
	//majUserXxx est utilisé pour le drag & drop
	public function majuserEscorte($idFaction)
	{
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$db->update('customer_user', array('cuu_gardien'=>new Zend_Db_Expr("cuu_gardien - 1 ")),
		array('cuu_id  = ?' => $idUser));
		
		$db->update('gardien', array('gar_nb_gardien'=>new Zend_Db_Expr("gar_nb_gardien + 1 ")),
		array('gar_id_user  = ?' => $idUser, 'gar_id_faction  = ?' => $idFaction));
		
	}
	
	function getAllInfluence()
	{
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null)
			$idUser=$membre->userInfo->getId();
		
		$query      = $this -> getDbTable()     -> select()
												-> setIntegrityCheck(false)
												-> from( array( 'influence' )
													   )
												
												-> where( 'inf_id_user="'.$idUser.'"' );

		$resultSet  = $this->getDbTable()->fetchAll( $query ); 
		$entries   = array();
	
		foreach ($resultSet as $row) {
			$entries[$row->inf_id_faction] = $row->inf_nb_influence;
		}
		return $entries;
	}
	
	function getInfluenceFaction($id_faction)
	{
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null)
			$idUser=$membre->userInfo->getId();
		
		if($id_faction){
			$query      = $this -> getDbTable()     -> select('inf_nb_influence')
													-> setIntegrityCheck(false)
													-> from( array( 'influence' )
														   )
													
													-> where( 'inf_id_faction= "'.$id_faction.'" and inf_id_user="'.$idUser.'"' );

			$resultSet  = $this->getDbTable()->fetchRow( $query ); 
			return $resultSet->inf_nb_influence;
		}else
			return $membre->userInfo->getInfluence();
	}
	
	function getServiteurFaction($id_faction)
	{
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null)
			$idUser=$membre->userInfo->getId();
		
		if($id_faction){	
			$query      = $this -> getDbTable()     -> select('ser_nb_serviteur')
													-> setIntegrityCheck(false)
													-> from( array( 'serviteur' )
														   )
													
													-> where( 'ser_id_faction= "'.$id_faction.'" and ser_id_user="'.$idUser.'"' );

			$resultSet  = $this->getDbTable()->fetchRow( $query ); 
			return $resultSet->ser_nb_serviteur;
		}else
			return $membre->userInfo->getServiteur();
	}
	
	function getEscorteFaction($id_faction)
	{
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null)
			$idUser=$membre->userInfo->getId();
		
		if($id_faction){
			$query      = $this -> getDbTable()     -> select('gar_nb_gardien')
													-> setIntegrityCheck(false)
													-> from( array( 'gardien' )
														   )
													
													-> where( 'gar_id_faction= "'.$id_faction.'" and gar_id_user="'.$idUser.'"' );
			$resultSet  = $this->getDbTable()->fetchRow( $query ); 
			return $resultSet->gar_nb_gardien;
		}else
			return $membre->userInfo->getGardien();
		
	}
	
	function getSuggestionFaction($id_faction)
	{
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null)
			$idUser=$membre->userInfo->getId();
		
		if($id_faction){
			$query      = $this -> getDbTable()     -> select('sug_nb_suggestion')
													-> setIntegrityCheck(false)
													-> from( array( 'suggestion_epice' )
														   )
													
													-> where( 'sug_id_faction= "'.$id_faction.'" and sug_id_user="'.$idUser.'"' );
			$resultSet  = $this->getDbTable()->fetchRow( $query ); 
			return $resultSet->sug_nb_suggestion;
		}else{
			$query      = $this -> getDbTable()     -> select()
													-> setIntegrityCheck(false)
													-> from( array( 'suggestion_epice' )
														   )
													
													-> where( 'sug_id_user="'.$idUser.'"' );
			$resultSet  = $this->getDbTable()->fetchAll( $query ); 
			$entries   = array();
        
			foreach ($resultSet as $row) {
				$entries[$row->sug_id_faction] = $row->sug_nb_suggestion;
			}
			return $entries;
		}
		
	}
	
	function getHumeurFaction($id_faction)
	{
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null)
			$idUser=$membre->userInfo->getId();
		
		if($id_faction){
			$query      =$this -> getDbTable()     -> select()
                                                -> setIntegrityCheck(false)
                                                -> from( array( 'hum' => 'humeur_faction' )
                                                       )
                                                -> join(array('fac' => 'faction'),
                                                        'fac.fac_id = hum.hum_id_faction'
                                                       )
												-> where( 'hum.hum_id_faction = "'.$id_faction.'" and hum.hum_id_user ="'.$idUser.'"' );
			$resultSet  = $this->getDbTable()->fetchRow( $query ); 
			return $resultSet->hum_humeur;
		}else{
			$query      =$this -> getDbTable()     -> select()
                                                -> setIntegrityCheck(false)
                                                -> from( array( 'hum' => 'humeur_faction' )
                                                       )
                                                -> join(array('fac' => 'faction'),
                                                        'fac.fac_id = hum.hum_id_faction'
                                                       )
												-> where( 'hum.hum_id_user ="'.$idUser.'"' );
			$resultSet  = $this->getDbTable()->fetchAll( $query ); 
			$entries   = array();
        
			foreach ($resultSet as $row) {
				if($row->fac_id!=1  && $row->fac_id != 2)
				$entries[$row->fac_nom] = $row->hum_humeur;
			}
			return $entries;
		}
			
		
	}
	
	function majSuggestionFaction($id_faction, $value)
	{
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null)
			$idUser=$membre->userInfo->getId();
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$db->update('suggestion_epice', array('sug_nb_suggestion'=>$value),
		array('sug_id_user  = ?' => $idUser, 'sug_id_faction  = ?' => $id_faction));
		
	}
	
	function majEpice($value)
	{
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null)
			$idUser=$membre->userInfo->getId();
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$us=new Customer_Model_User();
		$user=new Customer_Model_Mapper_User();
		$user->find($membre->userInfo->getId(), $us);
		if($us->getEpice()+$value < 0)
			return false;
		
		$db->update('customer_user', array('cuu_epice'=>new Zend_Db_Expr("cuu_epice + $value ")),
		array('cuu_id  = ?' => $idUser));
		
	}
	
	function majObjet($idOb)
	{
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null)
			$idUser=$membre->userInfo->getId();
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$us=new Customer_Model_User();
		$user=new Customer_Model_Mapper_User();
		$user->find($membre->userInfo->getId(), $us);
		
		if($us->getObjets()!='')
			$tempArray = json_decode($us->getObjets(), true);
		else
			$tempArray = array();
		
		array_push($tempArray, $idOb);
		$tempArray = json_encode($tempArray);
		$db->update('customer_user', array('cuu_objets'=>$tempArray),array('cuu_id  = ?' => $idUser));
		
	}
	
	function majRenommee($value)
	{
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null)
			$idUser=$membre->userInfo->getId();
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$us=new Customer_Model_User();
		$user=new Customer_Model_Mapper_User();
		$user->find($membre->userInfo->getId(), $us);
		if($us->getRenommee()+$value < 0)
			return false;
		
		$db->update('customer_user', array('cuu_renommee'=>new Zend_Db_Expr("cuu_renommee + $value ")),
		array('cuu_id  = ?' => $idUser));
		
	}
	
	function majCorruption($value)
	{
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null)
			$idUser=$membre->userInfo->getId();
		
		$us=new Customer_Model_User();
		$user=new Customer_Model_Mapper_User();
		$user->find($membre->userInfo->getId(), $us);
		if($us->getCorruption()+$value < 0)
			$value=-$us->getCorruption();
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
			
		$db->update('customer_user', array('cuu_corruption'=>new Zend_Db_Expr("cuu_corruption + $value ")),
		array('cuu_id  = ?' => $idUser));
		
	}
	
	function majImpot($value)
	{
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null)
			$idUser=$membre->userInfo->getId();
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);

		if($value!=0)
			$db->update('customer_user', array('cuu_impot'=>new Zend_Db_Expr("cuu_impot + $value ")),
			array('cuu_id  = ?' => $idUser));
		else
			$db->update('customer_user', array('cuu_impot'=>0),
			array('cuu_id  = ?' => $idUser));
		
	}
	
	function majHeure($cleHeure, $heure)
	{
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
        if ($member == null) {
            return;
        }
		
        $us=new Customer_Model_User();
        $carte=new Core_Model_Mapper_Carte();
		$this->find($member->cuu_id, $us);
		$epiceJour=0;
		$msg='';
		$def=0;
		if($us->getImpot()<5){
			$mesTroupeEnCours=$carte->getAllEnvoiTroupe();
			foreach ($mesTroupeEnCours as $row) {
				$days=$row->cau_jour;
				if($cleHeure==0){
					$db->update('carte_user', array('cau_jour'=>new Zend_Db_Expr("cau_jour + 1 ")),
					array('cau_id  = ?' => $row->cau_id));
					$days=$row->cau_jour+1;
				}
				
				if(($days >=1 && $row->ca_zoom==0) || ($days>=2 && $row->ca_zoom > 0)){
					
					$envoi=$row->cau_envoi;
					
					$db->update('carte_user', array('cau_troupe'=>new Zend_Db_Expr("cau_troupe + $envoi "), 'cau_envoi'=>0, 'cau_jour'=>0, 'cau_heure'=>0),
					array('cau_id  = ?' => $row->cau_id));
					Application_Common::addSystemSucces('Nos '.$envoi.' troupes sont arrivés sur la planète '.$row->ca_nom);
					?><script>messagesDisplay();planeteDisplay(<?php echo $row->ca_id;?>, '<?php echo $row->ca_nom;?>');</script><?php
				}
			}

			$mesVaisseauxEnCours=$carte->getAllVaisseauEnCours();
			foreach ($mesVaisseauxEnCours as $row) {
				$days=$row->cau_jour;
				if($cleHeure==0){
					$db->update('carte_user', array('cau_jour'=>new Zend_Db_Expr("cau_jour + 1 ")),
					array('cau_id  = ?' => $row->cau_id));
					$days=$row->cau_jour+1;
				}
				
				if(($row->cau_heure - $heure<=10)&& (($days >0 && $row->ca_zoom==0) || ($days>=2 && $row->ca_zoom > 0))){
					if($row->cau_etat==3){//si attaque
						$degat=1;
						$flotteEnnemi=$row->ca_flotte;
						if($us->getValeurVaisseau()==100)
							$nbVaisseau=$us->getVaisseau();
						elseif($us->getValeurVaisseau() > 100){//si on veut rajouter des trucs plus tard
							// $nbVaisseau=$us->getVaisseau()*2;
							$nbVaisseau=$us->getVaisseau();
							// $degat=0.5;
						}elseif($us->getValeurVaisseau() < 100){//si on veut rajouter des trucs plus tard
							// $nbVaisseau=$us->getVaisseau()*2;
							$nbVaisseau=$us->getVaisseau();
							// $degat=0.5;
						}
						if($flotteEnnemi>$nbVaisseau){
							$etat=0;$defaite=1;
						}else{
							$etat=1;
						}
						$perte=$us->getVaisseau()-floor(($flotteEnnemi*$degat));
						if($perte < 0)
							$perte=0;
						$us->setVaisseau($perte);
						
					}elseif($row->cau_etat==4)//exploration
						$etat=0;
					elseif($row->cau_etat==2){//diplomate
						$diplo=1;
						$db->update('carte_user', array('cau_etat'=>$etat, 'cau_jour'=>0, 'cau_heure'=>0, 'cau_diplomate'=>1),
						array('cau_id  = ?' => $row->cau_id));
						$msg.='Le diplomate Atreïdes revient de la Planète '.$row->ca_nom.'. Il attend son débriefing<br/>';
						?><script>vaisseauDisplay();afficheSpice();planeteDisplay(<?php echo $row->ca_id;?>, '<?php echo $row->ca_nom;?>');</script><?php
					}
					// else{//anciennement else je ne sais pas pourquoi...vieux code :)
						$db->update('carte_user', array('cau_etat'=>$etat, 'cau_jour'=>0, 'cau_heure'=>0),
						array('cau_id  = ?' => $row->cau_id));
						if($etat==1 && !$diplo){
							$us->setEpice($us->getEpice()+$row->ca_epice);
							$epiceJour=$row->ca_epice_jour;
							$msg.='Planète '.$row->ca_nom.' conquise !  + '.$row->ca_epice.' épice ! vaisseaux restant : '.$us->getVaisseau().'<br/>';
							?><script>vaisseauDisplay();afficheSpice();planeteDisplay(<?php echo $row->ca_id;?>, '<?php echo $row->ca_nom;?>');</script><?php
						}elseif($etat==0 && !$defaite && !$diplo){
							$msg.='Retour d\'un vaisseau d\'exploration de la planète '.$row->ca_nom.'<br/>';
							?><script>planeteDisplay(<?php echo $row->ca_id;?>, '<?php echo $row->ca_nom;?>');</script><?php
						}elseif($defaite && !$diplo){
							$def=1;
							$msg.='Votre flotte a échouée ! Vous n\'avez pas réussi à conquérir '.$row->ca_nom.'<br/>';
							?><script>vaisseauDisplay();planeteDisplay(<?php echo $row->ca_id;?>, '<?php echo $row->ca_nom;?>');</script><?php
						}
					// }
				}
				
			}
			if($msg!=''){
				if($def==1)
					Application_Common::addSystemError($msg);
				else
					Application_Common::addSystemSucces($msg);
				?><script>messagesDisplay();</script><?php
			}
			if($cleHeure==0){
				$us->setJour($us->getJour()+1);
				$us->setImpot($us->getImpot()+1);
				$us->setSoin($us->getSoin()+1);
				$myStar=$carte->getMyStars();
				$epice=0;
				foreach($myStar as $star){
					if($star['cau_etat']==1)
						$epice+=$star['ca_epice_jour'];
				}
				$us->setEpice($us->getEpice()+$epice+$epiceJour);
			}
			
			$data=array(
				'cuu_heure'=>$heure,
				'cuu_jour'=>$us->getJour(),
				'cuu_impot'=>$us->getImpot(),
				'cuu_soin'=>$us->getSoin(),
				'cuu_vaisseau'=>$us->getVaisseau(),
				'cuu_epice'=>$us->getEpice(),
				'cuu_rapport_planete'=>$us->getRapport(),
				'cuu_connexion'=>date('d-m-Y H:i')
			);
			// echo'<pre>';print_r($data);echo '</pre>';die();
			$this->getDbTable()->update($data, 
				array('cuu_id  = ?' => $member->cuu_id));
		}
		return $us->getJour();
		
			
	}
    
}