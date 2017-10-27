<?php

class Core_Model_Mapper_Quote
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
            $this->setDbTable('Core_Model_DbTable_Quote');
        }
        return $this->_dbTable;
    }
	
	public function setArret($idExt, $idMoneo){
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$idUser=$member->cuu_id;
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		$data = array('arr_id_user' =>  $idUser, 'arr_ext_id' => $idExt, 'arr_moneo' => $idMoneo);
		$db->insert('arret_quote', $data);
	}
	
	public function getQuoteByPerso($idPerso, Core_Model_Quote $quote)
    {
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;

		$query = 'SELECT `ext`. * , `uquo`. * , `quo`. *, `hum`. *
			FROM `externe_quete` AS `ext`
			INNER JOIN `user_quete` AS `uquo` ON ext.ext_id_perso_concerne = uquo.us_id_perso
			AND ext.ext_id_perso_quete = uquo.us_id_quete
			AND ext.ext_us_id_ext = uquo.us_id_ext
			AND ext.ext_moneo =0
			INNER JOIN `quote` AS `quo` ON ext.ext_id_quote = quo.quo_id
			INNER JOIN `personnage` as `pers` ON pers.pers_id = ext.ext_id_perso
			INNER JOIN `humeur_faction` as `hum` ON hum.hum_id_faction = pers.pers_faction
			WHERE (
				uquo.us_id_user = "'.$idUser.'" 
				AND hum.hum_id_user = "'.$idUser.'"
				AND ext.ext_id_perso = "'.$idPerso.'"
				AND quo.quo_id_perso = "'.$idPerso.'"
				AND ext.ext_id NOT
				IN (
					SELECT arr2.arr_ext_id
					FROM arret_quote AS arr2
					LEFT JOIN externe_quete ext2 ON arr2.arr_ext_id = ext2.ext_id
					WHERE arr2.arr_id_user = "'.$idUser.'" 
					AND arr2.arr_moneo =0
				) 
			) order by ext.ext_us_id_ext DESC';//et humeur
			// ) order by quo.quo_humeur DESC, ext.ext_us_id_ext DESC';//et humeur
// echo $query;
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		$stmt = $db->query($query);

		$row = $stmt->fetchObject();
		
		
		if (!$row) {
            
        }else{
			$entree=array();
			$entree=array();
			$done=0;
				
			if($row->ext_arret==1){
				$db = Zend_Registry::get('db');
				$db->setFetchMode(Zend_Db::FETCH_OBJ);
				$data = array('arr_id_user' =>  $idUser, 'arr_ext_id' => $row->ext_id, 'arr_moneo' => 0);
				$db->insert('arret_quote', $data);//debug
			}
			$entree=array();
			$entree['quo_id']=$row->quo_id;
			$entree['quo_id_perso']=$row->quo_id_perso;
			$entree['quo_reponse']=$row->quo_reponse;
			$entree['quo_quote']=$row->quo_quote;
			$entree['quo_quote_en']=$row->quo_quote_en;
			$entree['quo_humeur']=$row->quo_humeur;
			$entree['quo_maj_quete']=$row->quo_maj_quete;
			$entree['quo_maj_quete_perso']=$row->quo_maj_quete_perso;
			$entree['quo_nb_multiple']=$row->quo_nb_multiple;
			$entree['quo_id_multiple']=$row->quo_id_multiple;
			$entree['quo_maj_quete_id_ext']=$row->quo_maj_quete_id_ext;
			$entree['quo_recompense_multi']=$row->quo_recompense_multi;
			$entree['quo_recompense_nb_multi']=$row->quo_recompense_nb_multi;
			$entree['quo_fnctn']=$row->quo_fnctn;
			
		}

		return $entree;


    }
	
	public function getQuoteById($id, Core_Model_Quote $quote)
    {   
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
        $query      = $this -> getDbTable()     -> select()
                                                -> setIntegrityCheck(false)
                                                -> from( array( 'quo' => 'quote' )
                                                       )
												-> join(array('pers' => 'personnage'),
                                                     'pers.pers_id = quo.quo_id_perso'
                                                       )
												-> join(array('hum' => 'humeur_faction'),
                                                     'hum.hum_id_faction =pers.pers_faction'
                                                       )
                                                -> where( ' quo.quo_id="'.$id.'" AND hum.hum_id_user = "'.$idUser.'" AND quo.quo_humeur <= hum.hum_humeur' )
												->order('hum_humeur DESC ');
// die($query);
		$row    = $this->getDbTable()->fetchRow( $query );             
		    
        if ( !$row ){
            return;
        }
        $entree=array();
			$entree['quo_id']=$row->quo_id;
			$entree['quo_id_perso']=$row->quo_id_perso;
			$entree['quo_reponse']=$row->quo_reponse;
			$entree['quo_quote']=$row->quo_quote;
			$entree['quo_quote_en']=$row->quo_quote_en;
			$entree['quo_humeur']=$row->quo_humeur;
			$entree['quo_maj_quete']=$row->quo_maj_quete;
			$entree['quo_maj_quete_perso']=$row->quo_maj_quete_perso;
			$entree['quo_nb_multiple']=$row->quo_nb_multiple;
			$entree['quo_id_multiple']=$row->quo_id_multiple;
			$entree['quo_maj_quete_id_ext']=$row->quo_maj_quete_id_ext;
			$entree['quo_recompense_multi']=$row->quo_recompense_multi;
			$entree['quo_recompense_nb_multi']=$row->quo_recompense_nb_multi;
			$entree['quo_fnctn']=$row->quo_fnctn;
        return $entree;
    }
	
	public function getReponsePerso($idPerso)
    {
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;

		
		$query = 'SELECT `ext`. * , `uquo`. * , `mon`. *, `hum`. *
			FROM `externe_quete` AS `ext`
			INNER JOIN `user_quete` AS `uquo` ON ext.ext_id_perso_concerne = uquo.us_id_perso
			AND ext.ext_id_perso_quete = uquo.us_id_quete
			AND ext.ext_us_id_ext = uquo.us_id_ext
			AND ext.ext_moneo =1
			INNER JOIN `moneo_quote` AS `mon` ON ext.ext_id_quote = mon.mon_id
			INNER JOIN `personnage` as `pers` ON pers.pers_id = ext.ext_id_perso
			INNER JOIN `humeur_faction` as `hum` ON hum.hum_id_faction = pers.pers_faction
			WHERE (
				uquo.us_id_user = "'.$idUser.'" 
				AND ext.ext_id_perso = "'.$idPerso.'"
				AND mon.mon_id_perso = "'.$idPerso.'"
				AND hum.hum_id_user = "'.$idUser.'"
				AND mon.mon_humeur <= hum.hum_humeur
				AND ext.ext_id NOT
				IN (
					SELECT arr2.arr_ext_id
					FROM arret_quote AS arr2
					LEFT JOIN externe_quete ext2 ON arr2.arr_ext_id = ext2.ext_id
					WHERE arr2.arr_id_user = "'.$idUser.'" 
					AND arr2.arr_moneo =1
				)
			)';
			// die($query);
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		$stmt = $db->query($query);
		$resultSet = $stmt->fetchAll();
		
        if (!$resultSet) {
            
        }else{
			$entree=array();
			$entreefinal=array();
			$entreefinalAlone=array();
			foreach ($resultSet as $row) {
				$entree['mon_quote']=$row->mon_quote;   
				$entree['mon_quote_en']=$row->mon_quote_en;   
				$entree['ext_id']=$row->ext_id;
				$entree['ext_arret']=$row->ext_arret;
				$entree['mon_reponse']=$row->mon_reponse;
				$entree['mon_maj_quete']=$row->mon_maj_quete;
				$entree['mon_maj_quete_perso']=$row->mon_maj_quete_perso;
				$entree['mon_maj_quete_id_ext']=$row->mon_maj_quete_id_ext;
				$entree['mon_id_multiple']=$row->mon_id_multiple;
				$entree['mon_nb_multiple']=$row->mon_nb_multiple;
				$entree['mon_recompense_multi']=$row->mon_recompense_multi;
				$entree['mon_recompense_nb_multi']=$row->mon_recompense_nb_multi;
				$entree['mon_fnctn']=$row->mon_fnctn;
				if($row->mon_quote_seul==1)
						$entreefinalAlone[]=$entree;	
					else
						$entreefinal[]=$entree;
			}
		}
		

		
		
		
		if(count($entreefinalAlone)!=0)
			return $entreefinalAlone;
		else
			return $entreefinal;
    }
	
	public function getMajQuete($id_quete, $idPerso, $extIdPersoConcerne)
	{
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$idUser=$member->cuu_id;
		$query = 'SELECT * 
			FROM `user_quete`
			
			WHERE (
				us_id_user  = "'.$idUser.'" 
				AND us_id_quete = "'.$id_quete.'"
				AND us_id_perso  = "'.$idPerso.'"
				AND us_id_ext  = "'.$extIdPersoConcerne.'"
			)';
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		$stmt = $db->query($query);
		$resultSet = $stmt->fetchObject();
		return $resultSet;
	}
	
	public function getQuesteGlobal($idPerso, $extIdPersoConcerne)
	{
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$idUser=$member->cuu_id;
		$query = 'SELECT * 
			FROM `user_quete`
			
			WHERE (
				us_id_user  = "'.$idUser.'" 
				AND us_id_perso  = "'.$idPerso.'"
				AND us_id_ext  = "'.$extIdPersoConcerne.'"
			)';
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		$stmt = $db->query($query);
		$resultSet = $stmt->fetchObject();
		return $resultSet;
	}
	
	public function majQuete($id_quete, $idPerso, $extIdPersoConcerne)
	{	
		if(!$extIdPersoConcerne)
			$extIdPersoConcerne=0;
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$data = array(  'us_id_quete'           => $id_quete,
						'us_id_user'              => $idUser,
						'us_id_ext'              => $extIdPersoConcerne,
						'us_id_perso'              => $idPerso);

		$update=$db->update('user_quete', array('us_id_quete'=>$id_quete),
                array('us_id_user  = ?' => $idUser, 'us_id_ext  = ?' => $extIdPersoConcerne, 'us_id_perso = ?' =>$idPerso));
		if(!$update){
			/*NOUVEAU JOACHIM VERIF 26/07/2016*/
			$count = $db->fetchOne( 'SELECT count(*) from user_quete where us_id_quete='.$id_quete.' and us_id_user='.$idUser.' and us_id_ext='.$extIdPersoConcerne.' and us_id_perso='.$idPerso );
			
			if($count<1)/*FIN NOUVEAU JOACHIM VERIF*/
				$db->insert('user_quete', $data);
			
		}
	}
	
	public function recompense($id_quete, $idPerso, $extIdPersoConcerne){
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();

        if ($member == null) {
            return;
        }
		
		$user=new Customer_Model_Mapper_User();
		$idUser=$member->cuu_id;
		// echo $us->getInfluence();die();
		// die();
		$query = 'SELECT `re`. * 
			FROM `recompense` AS `re`
			
			WHERE (
				re_id_ext  = "'.$extIdPersoConcerne.'" 
				AND re_id_quete = "'.$id_quete.'"
				AND re_id_perso  = "'.$idPerso.'"
			)';
		// echo $query;die();
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		$stmt = $db->query($query);
		$resultSet = $stmt->fetchObject();
		
		if($resultSet){
			$arrayResult=array();
			$re_influence=$resultSet->re_influence;	
			$re_gardien=$resultSet->re_gardien;	
			$re_serviteur=$resultSet->re_serviteur;	
			$re_epice=$resultSet->re_epice;	
			$re_corruption=$resultSet->re_corruption;	
			$re_troupe=$resultSet->re_troupe;	
			$re_vaisseau=$resultSet->re_vaisseau;	
			$re_renommee=$resultSet->re_renommee;	
			
			if($resultSet->re_influence_faction==0 )
				$arrayResult['cuu_influence'] = new Zend_Db_Expr("cuu_influence + $re_influence ");
			else{
				$user->majInfluence($re_influence, $resultSet->re_influence_faction);
			}
			if($resultSet->re_gardien_faction==0 )
				$arrayResult['cuu_gardien'] = new Zend_Db_Expr("cuu_gardien + $re_gardien ");
			else{
				$user->majEscorte($re_gardien, $resultSet->re_gardien_faction);
			}
			if($resultSet->re_serviteur_faction==0 )
				$arrayResult['cuu_serviteur'] =new Zend_Db_Expr("cuu_serviteur + $re_serviteur ");
			else{
				$user->majServiteur($re_serviteur, $resultSet->re_serviteur_faction);
			}
			$arrayResult['cuu_epice']=new Zend_Db_Expr("cuu_epice + $re_epice");
			$arrayResult['cuu_renommee']=new Zend_Db_Expr("cuu_renommee + $re_renommee");
			$arrayResult['cuu_corruption']=new Zend_Db_Expr("cuu_corruption + $re_corruption");
			$arrayResult['cuu_troupe']=new Zend_Db_Expr("cuu_troupe + $re_troupe");
			$arrayResult['cuu_vaisseau']=new Zend_Db_Expr("cuu_vaisseau + $re_vaisseau");
			
			$db->update('customer_user', $arrayResult,
                array('cuu_id  = ?' => $idUser));
				
			
			return array('function'=>$resultSet->re_fnctn, 'display'=>$resultSet->re_display);

		}
		
	}
	
	public function multiRecompense($rec_multi, $rec_nb_multi){
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$user=new Customer_Model_Mapper_User();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;

		$query      = $this -> getDbTable()     -> select()
                                                -> setIntegrityCheck(false)
                                                -> from( array( 'remc' => 'recompense_multi_condition' ),
                                                         array( 'remc.remc_id_lien'
                                                              )
                                                       )
                                                -> join(array('uquo' => 'user_quete'),
                                                        'uquo.us_id_quete = remc.remc_id_quete and uquo.us_id_perso = remc.remc_id_perso and uquo.us_id_ext = remc.remc_id_ext'
                                                       )
                                                
												->where('remc.remc_id_lien='.$rec_multi.' AND uquo.us_id_user='.$idUser);
                                           

	   $resultSet = $this->getDbTable()->fetchAll( $query );
		$toutCorrespond=count($resultSet);       
		
		
		if (!$resultSet || ($toutCorrespond != $rec_nb_multi)) {
            return false;
        }
		
		
		$query      = $this -> getDbTable()     -> select()
                                                -> setIntegrityCheck(false)
                                                -> from( array( 'rem' => 'recompense_multi' ))
                                                
												->where('rem.rem_id_lien='.$rec_multi);
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);	
		
		$stmt = $db->query($query);
		$resultSet = $stmt->fetchObject();
		if($resultSet){
			$arrayResult=array();
			$rem_influence=$resultSet->rem_influence;	
			$rem_gardien=$resultSet->rem_gardien;	
			$rem_serviteur=$resultSet->rem_serviteur;	
			$rem_epice=$resultSet->rem_epice;	
			$rem_corruption=$resultSet->rem_corruption;	
			$rem_troupe=$resultSet->rem_troupe;	
			$rem_vaisseau=$resultSet->rem_vaisseau;	
			$rem_renommee=$resultSet->rem_renommee;	
			
			if($resultSet->rem_influence_faction==0 )
				$arrayResult['cuu_influence'] = new Zend_Db_Expr("cuu_influence + $rem_influence ");
			else{
				$user->majInfluence($rem_influence, $resultSet->rem_influence_faction);
			}
			if($resultSet->rem_gardien_faction==0 )
				$arrayResult['cuu_gardien'] = new Zend_Db_Expr("cuu_gardien + $rem_gardien ");
			else{
				$user->majEscorte($rem_gardien, $resultSet->rem_gardien_faction);
			}
			if($resultSet->rem_serviteur_faction==0 )
				$arrayResult['cuu_serviteur'] =new Zend_Db_Expr("cuu_serviteur + $rem_serviteur ");
			else{
				$user->majServiteur($rem_serviteur, $resultSet->rem_serviteur_faction);
			}
			$arrayResult['cuu_epice']=new Zend_Db_Expr("cuu_epice + $rem_epice ");
			$arrayResult['cuu_renommee']=new Zend_Db_Expr("cuu_renommee + $rem_renommee ");
			$arrayResult['cuu_corruption']=new Zend_Db_Expr("cuu_corruption + $rem_corruption ");
			$arrayResult['cuu_troupe']=new Zend_Db_Expr("cuu_troupe + $rem_troupe ");
			$arrayResult['cuu_vaisseau']=new Zend_Db_Expr("cuu_vaisseau + $rem_vaisseau ");

			$db->update('customer_user', $arrayResult,
                array('cuu_id  = ?' => $idUser));
			
			return array('function'=>$resultSet->rem_fnctn, 'display'=>$resultSet->rem_display);
		}
	}
	
	public function putArretQuoteMoneo($ext_id)
	{
		
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		$data = array('arr_id_user' =>  $idUser, 'arr_ext_id' => $ext_id, 'arr_moneo' => 1);
		$db->insert('arret_quote', $data);
	}
	
	public function majMultiple($idMulti, $nbMulti)
    {
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;

		$query      = $this -> getDbTable()     -> select()
                                                -> setIntegrityCheck(false)
                                                -> from( array( 'mul' => 'multi_condition' ),
                                                         array( 'mul.mu_id_lien'
                                                              )
                                                       )
                                                -> join(array('uquo' => 'user_quete'),
                                                        'uquo.us_id_quete = mul.mu_id_quete and uquo.us_id_perso = mul.mu_id_perso and uquo.us_id_ext = mul.mu_id_ext'
                                                       )
                                                
												->where('mul.mu_id_lien='.$idMulti.' AND uquo.us_id_user='.$idUser);
                                               
		
	   $resultSet = $this->getDbTable()->fetchAll( $query );
		$toutCorrespond=count($resultSet);       
		
		
		if (!$resultSet || ($toutCorrespond != $nbMulti)) {
            return false;
        }
		
		
		$query      = $this -> getDbTable()     -> select()
                                                -> setIntegrityCheck(false)
                                                -> from( array( 'mum' => 'multi_maj' ))
                                                
												->where('mum.mum_id_lien='.$idMulti);
		$resultSet = $this->getDbTable()->fetchAll( $query );
		
		$db = Zend_Registry::get('db');
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		foreach ($resultSet as $row) {
			
			// $db->delete('user_quete',
				// array(
					// 'us_id_user = ?' => $idUser,
					// 'us_id_ext = ?' => $row->mum_id_ext,
					// 'us_id_perso = ?' => $row->mum_id_perso
				// )
			// );
			
			$data = array(  'us_id_quete'           => $row->mum_id_quete,
							'us_id_user'              => $idUser,
							'us_id_ext'              => $row->mum_id_ext,
							'us_id_perso'              => $row->mum_id_perso);
			
			$update=$db->update('user_quete', array('us_id_quete'=>$row->mum_id_quete),
					array('us_id_user  = ?' => $idUser, 'us_id_ext  = ?' => $row->mum_id_ext, 'us_id_perso = ?' =>$row->mum_id_perso));
			
			if(!$update)
				$db->insert('user_quete', $data);
		}

    }

}