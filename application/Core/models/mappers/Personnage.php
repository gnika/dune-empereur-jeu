<?php

class Core_Model_Mapper_Personnage
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
            $this->setDbTable('Core_Model_DbTable_Personnage');
        }
        return $this->_dbTable;
    }
    
    public function getPersonnages($idSalle)
    {
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
        
		if($idSalle)
			$query      = $this -> getDbTable()     -> select()
                                                -> setIntegrityCheck(false)
                                                -> from( array( 'pers' => 'personnage' )
                                                       )
                                                -> join(array('sper' => 'salle_perso'),
                                                        'pers.pers_id = sper.sal_id_perso'
                                                       )
                                                -> where( 'sper.sal_id_salle= "'.$idSalle.'" and sper.sal_id_user="'.$idUser.'"' );
		else
			$query      = $this -> getDbTable()     -> select()
                                                -> setIntegrityCheck(false)
                                                -> from( array( 'pers' => 'personnage' )
                                                       )
                                                -> join(array('sper' => 'salle_perso'),
                                                        'pers.pers_id = sper.sal_id_perso'
                                                       )
                                                -> where( 'sper.sal_id_user="'.$idUser.'"' );

		$resultSet  = $this->getDbTable()->fetchAll( $query ); 

        if (!$resultSet) {
            return;
        }
        $entree=array();
        $entreefinal=array();
        foreach ($resultSet as $row) {
            $entree['pers_id']=$row->pers_id;   
            $entree['pers_nom']=$row->pers_nom;   
            $entree['pers_faction']=$row->pers_faction;   
            $entreefinal[strtolower (str_replace (' ', '_', $row->pers_nom))]=$entree;
        }
        return $entreefinal;
       
    }
	
	public function getSalle($idSalle)
	{
		$query      = $this -> getDbTable()     -> select('sa_nom')
													-> setIntegrityCheck(false)
													-> from( array( 'salle' )
														   )
													-> where( 'sa_id= "'.$idSalle.'"' );
			$resultSet  = $this->getDbTable()->fetchRow( $query ); 
			return $resultSet->sa_nom;
	}
	
	public function getMusiqueSalle($idSalle=null)
	{
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$idUser=$member->cuu_id;
		if($idSalle==null){
			$query      = $this -> getDbTable()     -> select('sa_musique')
													-> setIntegrityCheck(false)
													-> from( array( 'salle' )
														   )
													-> join(array('cuu' => 'customer_user'),
                                                        'cuu.cuu_salle  = sa_id'
                                                       )
													-> where( 'cuu.cuu_id= "'.$idUser.'"' );
			$resultSet  = $this->getDbTable()->fetchRow( $query ); 
			return $resultSet->sa_musique;
		}else{
			$query      = $this -> getDbTable()     -> select('sa_musique')
													-> setIntegrityCheck(false)
													-> from( array( 'salle' )
														   )
													-> where( 'sa_id= "'.$idSalle.'"' );
			$resultSet  = $this->getDbTable()->fetchRow( $query ); 
			return $resultSet->sa_musique;
		}
	}
	
	public function getPersonnage($idPerso)
    {
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
        
		$query      = $this -> getDbTable()     -> select()
                                                -> setIntegrityCheck(false)
                                                -> from( array( 'pers' => 'personnage' )
                                                       )
                                                -> join(array('sper' => 'salle_perso'),
                                                        'pers.pers_id = sper.sal_id_perso'
                                                       )
                                                -> where( 'sper.sal_id_perso= "'.$idPerso.'" and sper.sal_id_user="'.$idUser.'"' );

		$resultSet  = $this->getDbTable()->fetchAll( $query ); 

        if (!$resultSet) {
            return;
        }
        $entree=array();
        $entreefinal=array();
        foreach ($resultSet as $row) {
            $entree['pers_id']=$row->pers_id;   
            $entree['pers_nom']=$row->pers_nom;   
            $entree['pers_salle']=$row->sal_id_salle;   
            $entree['pers_faction']=$row->pers_faction;
            $entreefinal[strtolower (str_replace (' ', '_', $row->pers_nom))]=$entree;
        }
        return $entreefinal;
       
    }
	
	function getPortes($idSalle)
	{
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
        
		$query      = $this -> getDbTable()     -> select()
                                                -> setIntegrityCheck(false)
                                                -> from( array( 'por' => 'porte' )
                                                       )
                                                -> join(array('poru' => 'porte_user'),
                                                        'por.por_id = poru.poru_id_porte'
                                                       )
                                                -> where( 'por.por_id_salle= "'.$idSalle.'" and poru.poru_id_user="'.$idUser.'"' );
// echo $query;
		$resultSet  = $this->getDbTable()->fetchAll( $query ); 

        if (!$resultSet) {
            return;
        }
        $entree=array();
        $entreefinal=array();
        foreach ($resultSet as $row) {
            $entree['por_id']=$row->por_id;
            $entree['por_id_type']=$row->por_id_type;
            $entree['poru_etat']=$row->poru_etat;
            $entreefinal[]=$entree;
        }
        return $entreefinal;
	}
	
	function mouveSalle($idPerso, $idSalle)
	{
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		$db->update('salle_perso', array('sal_id_salle' => $idSalle),
                array('sal_id_user  = ?' => $idUser, 'sal_id_perso  = ?' =>$idPerso));
	}
	
	function majPorte($idPorte, $etat)
	{
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		$db->update('porte_user', array('poru_etat' => $etat),//debug
                array('poru_id_user  = ?' => $idUser, 'poru_id_porte  = ?' =>$idPorte));//debug
	}
	
	function getAllObjet()
	{
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		$query      = $this -> getDbTable()     -> select()
                                                -> setIntegrityCheck(false)
                                                -> from( array( 'ob' => 'objet' )
                                                       )
                                                -> join(array('obu' => 'objet_user'),
                                                        'ob.obj_id = obu.obu_id_objet'
                                                       )
                                                -> where( 'obu.obu_id_user="'.$idUser.'"' );

		$resultSet  = $this->getDbTable()->fetchAll( $query ); 
		$entree=array();
        $entreefinal=array();
        foreach ($resultSet as $row) {
            $entree['obj_id']=$row->obj_id;
            $entree['obj_image']=$row->obj_image;
            $entree['obj_nom']=$row->obj_nom;
            $entree['obj_dbl']=$row->obj_dbl;
            $entreefinal[]=$entree;
        }
        return $entreefinal;
	}
	
	function supprObjet($userId, $idObject)
	{
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
		if($userId==0)
			$userId=$idUser;
		
		$db->delete('objet_user',
			array(
				'obu_id_user = ?' => $userId,
				'obu_id_objet = ?' => $idObject
			)
		);

	}
	
	function addObjet($idObject)
	{
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$data = array('obu_id_user' =>  $idUser, 'obu_id_objet' => $idObject);
		$db->insert('objet_user', $data);

	}
	
	function getObjet($idObjet)
	{
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		$stmt = $db->query('select obu_id_objet from objet_user where obu_id_user='.$idUser.' and obu_id_objet='.$idObjet);

		$row = $stmt->fetchObject();
		if($row) return true;
		else return false;
		
	}
	
	function getNameObjet($idObjet)
	{
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		$stmt = $db->query('select obj_nom from objet where obj_id='.$idObjet);

		$row = $stmt->fetchObject();
		return $row->obj_nom;
		
	}
	
	function getFaction($id_faction)
	{
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
		
		$query      = $this -> getDbTable()     -> select('fac_nom')
													-> setIntegrityCheck(false)
													-> from( array( 'faction' )
														   )
													
													-> where( 'fac_id= "'.$id_faction.'"' );
			$resultSet  = $this->getDbTable()->fetchRow( $query ); 
			return $resultSet->fac_nom;
	}

}