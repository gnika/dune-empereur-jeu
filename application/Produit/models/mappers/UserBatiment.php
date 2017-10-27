<?phpclass Produit_Model_Mapper_UserBatiment{    protected $_dbTable;    protected $_auth;            public function init()     {            }        public function setDbTable($dbTable)    {        if (is_string($dbTable)) {            $dbTable = new $dbTable();        }        if (!$dbTable instanceof Zend_Db_Table_Abstract) {            throw new Exception('Invalid table data gateway provided');        }        $this->_dbTable = $dbTable;        return $this;    }    public function getDbTable()    {        if (null === $this->_dbTable) {            $this->setDbTable('Produit_Model_DbTable_UserBatiment');        }        return $this->_dbTable;    }        public function save(Produit_Model_Batiment $Batiment, $id)    {           $this->_auth = Zend_Auth::getInstance();        $member = $this->_auth->getIdentity();        if ($member == null) {            die('error');        };        $batimentMapper=new Produit_Model_Mapper_Batiment();        $batimentMapper->find($id, $Batiment);        $duree=time()+($Batiment->getDuree());        $query      = $this -> getDbTable()     -> select()                                                -> where( 'ub_produit_batiment_id= "'.$id.'" and ub_user_id="'.$member->cuu_id.'"' );         $row  = $this->getDbTable()->fetchRow( $query );        if ( $row !=false && $row->ub_duree != 0)        {               $message='vous devez attendre la fin de la construction du batiment pour reconstruire le meme batiment';            Application_Common::addSystemError($message);            return false;         }                if(count($row)!=0){            if(($row->ub_produit_batiment_id == $Batiment->getId()) && $Batiment->getUnique()==1)            {                $message='vous possedez deja ce batiment, et il ne peut y en avoir qu\'un seul de ce type';                Application_Common::addSystemError($message);                 return false;            }        }                    $decrement_user= new Customer_Model_Mapper_User();          $user= new Customer_Model_User();          $decrement_user->find($member->cuu_id, $user);                  if($decrement_user->achatBatiment($user, $Batiment)===false){            $message='ressources insuffisantes pour satisfaire tout vos besoins.';            Application_Common::addSystemError($message);            return false;        }          $decrement_user->save($user);          $batimentUser=    new Produit_Model_UserBatiment();                                          if(count($row)!=0)            {                $batimentUser      ->setUserId($row->ub_user_id )                    ->setProduitBatimentId($id)                    ->setDuree($duree)                    ->setQuantite($row->ub_quantite + 1)                    ->setStructure($Batiment->getStructure());                  $data = array('ub_duree'  =>  $duree);                $this->getDbTable()->update($data,                 array('ub_user_id  = ?' => $row->ub_user_id,                'ub_produit_batiment_id = ?' =>$row->ub_produit_batiment_id));            }            else            {                $data = array(  'ub_user_id'             => $member->cuu_id,                                'ub_produit_batiment_id'    => $id,                                'ub_quantite'            => 0,                                'ub_duree'              =>  $duree,                                'ub_structure'          =>  $Batiment->getStructure()                            );                $this->getDbTable()->insert($data);            }              }        public function destruct($id)	{		$nbChoisi=0;		$idChoisi;		$query      = $this -> getDbTable()     -> select()                                                -> from('user_batiment')                                                -> where( 'ub_user_id= "'.$id.'" and ub_quantite<>"0"' );        $resultSet  = $this->getDbTable()->fetchAll( $query );  		$limit=count($resultSet);		$rand=rand(0,$limit);		foreach ($resultSet as $row) {			if($nbChoisi==$rand){				$idChoisi=$row->ub_produit_batiment_id;				$strChoisi=$row->ub_structure;			}			$nbChoisi++;		}		$nvlstruct=$strChoisi-1;		if($nvlstruct>0){			$data=array('ub_structure' => $nvlstruct);			$this->getDbTable()->update($data,                 array('ub_user_id  = ?' => $id,                'ub_produit_batiment_id = ?' =>$idChoisi));		}		else		{			 $this->getDbTable->delete("user_batiment", " ub_produit_batiment_id = '".$idChoisi."' AND  ub_user_id = '".$id."'");		}		    }	            public function fetchAllbyUser($id)    {         $this->_auth = Zend_Auth::getInstance();        $member = $this->_auth->getIdentity();        if ($member == null) {            die('error');        };                $query      = $this -> getDbTable()     -> select()                                                -> setIntegrityCheck(false)                                                -> from( array( 'ub' => 'user_batiment' ),                                                         array( 'ub.ub_produit_batiment_id',                                                                'ub.ub_quantite',                                                                 'ub.ub_user_id',                                                                'ub.ub_duree',                                                                'ub.ub_structure'                                                                                                                            )                                                       )                                                -> join(array('pb' => 'produit_batiment'),                                                        'pb.pb_id = ub.ub_produit_batiment_id'                                                       )                                                -> where( 'ub.ub_user_id= "'.$id.'"' );        $resultSet  = $this->getDbTable()->fetchAll( $query );                  if (!$resultSet) {            return;        }        $entree=array();        $entreefinal=array();        foreach ($resultSet as $row) {            $entree['ub_user_id']=$row->ub_user_id;            $entree['ub_produit_batiment_id']=$row->ub_produit_batiment_id;            $entree['ub_duree']=$row->ub_duree;            $entree['ub_quantite']=$row->ub_quantite;            $entree['ub_structure']=$row->ub_structure;            $entree['pb_titre']=$row->pb_titre;            $entree['pb_image']=$row->pb_image;                 $entree['pb_structure']= $row->pb_structure;              $entree['pb_taux_or']= $row->pb_taux_or;            $entree['pb_taux_bois']= $row->pb_taux_bois;            $entree['pb_taux_population']= $row->pb_taux_population;            $entree['pb_taux_mana']= $row->pb_taux_mana;            $entree['pb_auth_magie']= $row->pb_auth_magie;            $entree['pb_auth_chateau']= $row->pb_auth_chateau;            $entree['pb_auth_unite']= $row->pb_auth_unite;            $entree['pb_attaque']= $row->pb_attaque;            $entree['pb_defense']= $row->pb_defense;            $entree['pb_magie']= $row->pb_magie;            $entree['pb_pillage']= $row->pb_pillage;            if($entree['ub_structure']> (2/3)*$row->pb_structure)            $entree['etat_batiment']='etat neuf';            elseif($entree['ub_structure']< (2/3)*$row->pb_structure && $entree['ub_structure']> (1/3)*$row->pb_structure)            $entree['etat_batiment']='necessite des reparations';            else            $entree['etat_batiment']='sur le point de s\'écrouler';            $entreefinal[]=$entree;        }        return $entreefinal;    }            }