<?php

class Core_Model_Mapper_Carte
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
            $this->setDbTable('Core_Model_DbTable_Carte');
        }
        return $this->_dbTable;
    }
	
	public function getAllStar($zoom=0)
	{
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$query      = $this -> getDbTable()     -> select()
                                                -> setIntegrityCheck(false)
                                                -> from( array( 'ca' => 'carte' )
                                                       )
                                                -> joinLeft(array('cau' => 'carte_user'),
                                                        'cau.cau_ca_id = ca.ca_id and cau.cau_id_user= '.$member->cuu_id
                                                       );
                                                
												// ->where('ca_zoom= '.$zoom);
		
		$resultSet = $this->getDbTable()->fetchAll($query);
		return $resultSet;
	}
	
	public function getStar($id)
	{
		$result = $this->getDbTable()->find($id);
		return $row = $result->current();
	}
	
	public function getMyStar($id)
	{
		
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		
		$query      = $this -> getDbTable()     -> select()
                                                -> setIntegrityCheck(false)
                                                -> from( array( 'ca' => 'carte' )
                                                       )
                                                -> joinLeft(array('cau' => 'carte_user'),
                                                        'cau.cau_ca_id = ca.ca_id'
                                                       )
                                                
												->where('cau.cau_id_user= '.$member->cuu_id.' and ca.ca_id='.$id);
		
		$resultSet = $this->getDbTable()->fetchRow($query);
		if(!$resultSet)
			return $this->getStar($id);
		return $resultSet;
	}
	
	public function getMyStars()
	{
		
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		
		$query      = $this -> getDbTable()     -> select()
                                                -> setIntegrityCheck(false)
                                                -> from( array( 'ca' => 'carte' )
                                                       )
                                                -> join(array('cau' => 'carte_user'),
                                                        'cau.cau_ca_id = ca.ca_id'
                                                       )
                                                
												->where('cau.cau_id_user= '.$member->cuu_id);
		
		$resultSet = $this->getDbTable()->fetchAll($query);
		return $resultSet;
	}
	
	public function deletePlanete($idP)
	{
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$db->delete('carte_user',
			array(
				'cau_id_user = ?' => $member->cuu_id,
				'cau_ca_id = ?' => $idP
			)
		);
	}
	
	public function getMyStarsStatutOne()
	{
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		
		$query      = $this -> getDbTable()     -> select()
                                                -> setIntegrityCheck(false)
                                                -> from( array( 'ca' => 'carte' )
                                                       )
                                                -> join(array('cau' => 'carte_user'),
                                                        'cau.cau_ca_id = ca.ca_id'
                                                       )
                                                
												->where('cau.cau_id_user= '.$member->cuu_id.' and cau.cau_etat=1');
		
		$resultSet = $this->getDbTable()->fetchAll($query);
		return count($resultSet);
	}
	
	public function getActionVaisseau($action)
	{
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null)
			$idUser=$membre->userInfo->getId();
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$query	=	'select COUNT(*) as countId from carte_user WHERE cau_etat="'.$action.'" and cau_id_user="'.$idUser.'"';
		$stmt = $db->query($query);
		$all = $stmt->fetchAll();
		return $all[0]->countId;
	}
	
	public function diplobriefing()
	{
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		
		$query      = $this -> getDbTable()     -> select()
                                                -> setIntegrityCheck(false)
                                                -> from( array( 'ca' => 'carte' )
                                                       )
                                                -> joinLeft(array('cau' => 'carte_user'),
                                                        'cau.cau_ca_id = ca.ca_id'
                                                       )
                                                
												->where('cau.cau_id_user= '.$member->cuu_id.' and cau.cau_diplomate=1');
		
		$resultSet = $this->getDbTable()->fetchRow($query);
		return $resultSet;
	}
	
	public function getAllVaisseauEnCours()
	{
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null)
			$idUser=$membre->userInfo->getId();
		
		$query      = $this -> getDbTable()     -> select()
												-> setIntegrityCheck(false)
												-> from( array( 'cau' => 'carte_user' )
													   )
												-> join(array('ca' => 'carte'),
                                                        'cau.cau_ca_id = ca.ca_id'
                                                       )
												-> where( 'cau.cau_etat IN(2,3,4) and cau.cau_id_user="'.$idUser.'"' );
   
		return $this->getDbTable()->fetchAll( $query );
	}
	
	public function getAllEnvoiTroupe()
	{
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null)
			$idUser=$membre->userInfo->getId();
		
		$query      = $this -> getDbTable()     -> select()
												-> setIntegrityCheck(false)
												-> from( array( 'cau' => 'carte_user' )
													   )
												-> join(array('ca' => 'carte'),
                                                        'cau.cau_ca_id = ca.ca_id'
                                                       )
												-> where( 'cau.cau_envoi <> 0 and cau.cau_id_user="'.$idUser.'"' );
   
		return $this->getDbTable()->fetchAll( $query );
	}
	
	public function verifPlaneteVierge($idPlanete, $expl=null)
	{
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null)
			$idUser=$membre->userInfo->getId();
			
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		if($expl!=null)
			$query	=	'select COUNT(*) as countId from carte_user WHERE cau_id_user="'.$idUser.'" AND cau_ca_id="'.$idPlanete.'"';
		else
			$query	=	'select COUNT(*) as countId from carte_user WHERE (cau_etat IN(2, 3, 4) OR cau_envoi<>0) and cau_id_user="'.$idUser.'" AND cau_ca_id="'.$idPlanete.'"';
		$stmt = $db->query($query);
		$all = $stmt->fetchAll();
		return $all[0]->countId;
	}
	
	public function envoiVaisseau($idPlanete, $action)
	{//action 3=attaque - 4=explore
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null)
			$idUser=$membre->userInfo->getId();
		
		$us=new Customer_Model_User();
		$user=new Customer_Model_Mapper_User();
		$user->find($idUser, $us);
		
		$enCours=$this->getActionVaisseau($action);
		if($enCours >0 && $action==3)
			return 3;
		
		if($enCours >0 && $action==4){
			
			if($us->getExploration() <= $enCours )//3 <=1
				return 4;
		}
		
		$enCours=$this->verifPlaneteVierge($idPlanete);
		
		if($enCours >0)
			return 5;
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$db->delete('carte_user',
			array(
				'cau_id_user = ?' => $idUser,
				'cau_ca_id = ?' => $idPlanete
			)
		);
		
		$data = array('cau_id_user' =>  $idUser, 'cau_ca_id' => $idPlanete, 'cau_etat' => $action, 'cau_heure'=>$us->getHeure());
		$db->insert('carte_user', $data);
	}
	
	public function explore($nb)
	{
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null)
			$idUser=$membre->userInfo->getId();
			
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		for($i=0;$i<$nb;$i++){
			$idPlanete=rand(1, 11);
			$vide=$this->verifPlaneteVierge($idPlanete, 1);
			if($vide==0){
				$data = array('cau_id_user' =>  $idUser, 'cau_ca_id' => $idPlanete, 'cau_etat' => 0, 'cau_heure'=>0);
				$db->insert('carte_user', $data);
			}
		}
	}
	
	public function allDiplo($idSecteur)
	{
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null)
			$idUser=$membre->userInfo->getId();
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		$query='SELECT ca_id
			FROM carte c
			WHERE NOT EXISTS (SELECT 1 FROM carte_user 
			WHERE cau_ca_id = c.ca_id ) and c.ca_diplomate>15 and c.ca_zoom='.$idSecteur;	
			// echo $query;die();
		$stmt = $db->query($query);
		$all = $stmt->fetchAll();
		foreach($all as $res){
			$data = array('cau_id_user' =>  $idUser, 'cau_ca_id' => $res->ca_id, 'cau_etat' => 0, 'cau_heure'=>0);
				$db->insert('carte_user', $data);
		}
	}
	
	public function envoiTroupe($idPlanete, $nb)
	{
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null)
			$idUser=$membre->userInfo->getId();
		
		$us=new Customer_Model_User();
		$user=new Customer_Model_Mapper_User();
		$user->find($idUser, $us);
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		if($us->getTroupe()-$nb < 0)
			return false;
		
		$update=$db->update('customer_user', array('cuu_troupe'=>$us->getTroupe()-$nb),
			array('cuu_id = ?' =>$idUser));
		
		return $update=$db->update('carte_user', array('cau_envoi'=>$nb, 'cau_heure'=>$us->getHeure()),
			array('cau_ca_id  = ?' => $idPlanete, 'cau_etat  = ?' => 1, 'cau_id_user = ?' =>$idUser));
		
	}
	
	public function diplomateWait()
	{
		$membre=new Zend_Session_Namespace('user');
		$idUser=$membre->userInfo->getId();
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		$query	=	'select COUNT(*) as countId from carte_user WHERE (cau_etat =2 OR cau_diplomate=1) and cau_id_user="'.$idUser.'"';
		$stmt = $db->query($query);
		$all = $stmt->fetchAll();
		return $all[0]->countId;
	}
	
	public function setdiplomateNull($idPlanete, $cau_etat)
	{
		$membre=new Zend_Session_Namespace('user');
		$idUser=$membre->userInfo->getId();
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		$db->update('carte_user', array('cau_diplomate'=>0, 'cau_etat'=>$cau_etat), array('cau_ca_id  = ?' => $idPlanete, 'cau_id_user = ?' =>$idUser));
	}
	
	public function setTroupes($idPlanete, $troupe)
	{
		$membre=new Zend_Session_Namespace('user');
		$idUser=$membre->userInfo->getId();
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		$db->update('carte_user', array('cau_troupe'=>$troupe), array('cau_ca_id  = ?' => $idPlanete, 'cau_id_user = ?' =>$idUser));
	}
	
	public function envoiDiplomate($idPlanete)
	{
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null)
			$idUser=$membre->userInfo->getId();
		
		$us=new Customer_Model_User();
		$user=new Customer_Model_Mapper_User();
		$user->find($idUser, $us);
		
		if($us->getEpice()>=500){
			$us->setEpice($us->getEpice()-500);
			$user->save($us);
			$db = Zend_Registry::get('db');
			$db->setFetchMode(Zend_Db::FETCH_OBJ);
			
			$dejaVisited=$this->getMyStar($idPlanete);
			if(!isset($dejaVisited->cau_id)){
				$data = array('cau_id_user' =>  $idUser, 'cau_ca_id' => $idPlanete, 'cau_etat' => 2, 'cau_heure'=>$us->getHeure());
				return $db->insert('carte_user', $data);
			}
			else
				return $update=$db->update('carte_user', array('cau_heure'=>$us->getHeure(), 'cau_etat' => 2), array('cau_ca_id  = ?' => $idPlanete, 'cau_id_user = ?' =>$idUser));
		}
			
	}

}