<?php

class Attaque_Model_Mapper_Journal
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
            $this->setDbTable('Attaque_Model_DbTable_Journal');
        }
        return $this->_dbTable;
    }
    
    public function save(Attaque_Model_Journal $Journal)
    { 
		
        $data = array(  'jo_id'            		 => $Journal->getId(),
						'jo_id_user'			 => $Journal->getIdAttaque(),
                        'jo_id_attaque'          => $Journal->getIdAttaque(),
						'jo_id_victoire'		 => $Journal->getIdVictoire(),
						'jo_login_attaque'       => $Journal->getLoginAttaque(),
						'jo_login_defense'		 => $Journal->getLoginDefense(),
                        'jo_id_defense'  		 => $Journal->getIdDefense(),
                        'jo_or_pille'            => $Journal->getOrPille(),
                        'jo_bois_pille'    		 => $Journal->getBoisPille(),
                        'jo_population_pille'    => $Journal->getPopulationPille(),
                        'jo_mana_pille'          => $Journal->getManaPille(),
                        'jo_date'      		     => $Journal->getDate()
                    );
        if (null === ($id = $Journal->getId())) {
            unset($data['jo_id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('jo_id = ?' => $id));
        }
		
		$data = array(  'jo_id'            		 => $Journal->getId(),
						'jo_id_user'			 => $Journal->getIdDefense(),
                        'jo_id_attaque'          => $Journal->getIdAttaque(),
						'jo_id_victoire'		 => $Journal->getIdVictoire(),
						'jo_login_attaque'       => $Journal->getLoginAttaque(),
						'jo_login_defense'		 => $Journal->getLoginDefense(),
                        'jo_id_defense'  		 => $Journal->getIdDefense(),
                        'jo_or_pille'            => $Journal->getOrPille(),
                        'jo_bois_pille'    		 => $Journal->getBoisPille(),
                        'jo_population_pille'    => $Journal->getPopulationPille(),
                        'jo_mana_pille'          => $Journal->getManaPille(),
                        'jo_date'      		     => $Journal->getDate()
                    );
        if (null === ($id = $Journal->getId())) {
            unset($data['jo_id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('jo_id = ?' => $id));
        }
    }
        
    public function find($id, Attaque_Model_Journal $Journal)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        
        $row = $result->current();
        $Journal      ->setId($row->jo_id)
                      ->setIdAttaque($row->jo_id_attaque)
					  ->setIdVictoire($row->jo_id_victoire)
					  ->setLoginAttaque($row->jo_login_attaque)
					  ->setLoginDefense($row->jo_login_defense)
                      ->setIdDefense($row->jo_id_defense)
                      ->setOrPille($row->jo_or_pille)
                      ->setBoisPille($row->jo_bois_pille)
                      ->setPopulationPille($row->jo_population_pille)
                      ->setManaPille($row->jo_mana_pille)
                      ->setDate($row->jo_date);
                      
                     // print_r($Journal);die();
                     
    }
	public function suppression($id)
	{
		$this->getDbTable->delete("journal", " jo_id = '".$id."'");
	}
	
	
    public function fetchAllbyUser($id, $verif=null, $tout=null)
    {

			$table = $this->getDbTable();
			if($tout!=null){
				$select = $table->select();
				$select->from($table)
				   ->where('jo_id_user ='.$id);
			}else{
					$select = $table->select();
					$select->from($table)
					   ->where('jo_id_attaque = ?', $id);
				}

			$resultSet = $table->fetchAll($select);
			
			//$resultSet = $this->getDbTable()->fetchAll($id);
			$entries   = array();
			if($verif==null){
				foreach ($resultSet as $row) {
					$entry = new Attaque_Model_Journal();
					$entry      ->setId($row->jo_id)
							  ->setIdAttaque($row->jo_id_attaque)
							  ->setIdVictoire($row->jo_id_victoire)
							  ->setLoginAttaque($row->jo_login_attaque)
							  ->setLoginDefense($row->jo_login_defense)
							  ->setIdDefense($row->jo_id_defense)
							  ->setOrPille($row->jo_or_pille)
							  ->setBoisPille($row->jo_bois_pille)
							  ->setPopulationPille($row->jo_population_pille)
							  ->setManaPille($row->jo_mana_pille)
							  ->setDate($row->jo_date);
							  
					$entries[] = $entry;
				}
			}
			else
			{
				$datejour = date('d/m/Y');
				$djour = explode("/", $datejour); 
				$auj = $djour[2].$djour[1].$djour[0]; 
				foreach ($resultSet as $row) {
					 $finab=$row->jo_date;

					if ($finab==$auj)
					{
						if(!array_key_exists($row->jo_id_defense, $entries))
							$entries[$row->jo_id_defense]=1;
						else
							$entries[$row->jo_id_defense]+=1;
					}
				}
			}
			return $entries;
		
			
	}
	
    
}