<?php

class Produit_Model_Mapper_Unite
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
            $this->setDbTable('Produit_Model_DbTable_Unite');
        }
        return $this->_dbTable;
    }
    
    public function save(Produit_Model_Unite $Unite)
    {
        $data = array(  'pa_id'             => $Unite->getId(),
                        'pa_titre'          => $Unite->getTitre(),
                        'pa_description'    => $Unite->getDescription(),
                        'pa_prix'           => $Unite->getPrix(),
                        'pc_id'             => $Unite->getPcid(),
                        'pa_population'     => $Unite->getPopulation(),
                        'pa_bois'           => $Unite->getBois(),
                        'pa_mana'           => $Unite->getMana(),
                        'pa_duree'          => $Unite->getDuree(),
                        'pa_victoire'       => $Unite->getvictoire(),
                        'pa_pillage'        => $Unite->getPillage(),
                        'pa_attaque'        => $Unite->getAttaque(),
                        'pa_defense'        => $Unite->getDefense(),
                        'pa_image'          => $Unite->getImage(),
                        'pa_magie'          => $Unite->getMagie()
                    );
        if (null === ($id = $Unite->getId())) {
            unset($data['pa_id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('pa_id = ?' => $id));
        }
    }
        
    public function find($id, Produit_Model_Unite $Unite, Produit_Model_CategorieUnite $categorie = null )
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        
        $row = $result->current();
        $Unite      ->setId($row->pa_id)
                      ->setTitre($row->pa_titre)
                      ->setDescription($row->pa_description)
                      ->setPrix($row->pa_prix)
                      ->setPopulation($row->pa_population)
                      ->setBois($row->pa_bois)
                      ->setMana($row->pa_mana)
                      ->setDuree($row->pa_duree)
                      ->setVictoire($row->pa_victoire)
                      ->setPillage($row->pa_pillage)
                      ->setAttaque($row->pa_attaque)
                      ->setDefense($row->pa_defense)
                      ->setMagie($row->pa_magie)
                      ->setImage($row->pa_image)
                      ->setPcid($row->pc_id);
                      
                     // print_r($Unite);die();
                     
        if ( $categorie instanceof Produit_Model_Categorie ){
            
            $catEntry = $row->findParentRow('Produit_Model_DbTable_Categorie');
            $categorie  ->setId( $catEntry->pc_id )
                        ->setCategorie( $catEntry->pc_categorie );
        }
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        
        foreach ($resultSet as $row) {
            $entry = new Produit_Model_Unite();
            $entry  ->setId($row->pa_id)
                    ->setTitre($row->pa_titre)
                    ->setDescription($row->pa_description)
                    ->setPrix($row->pa_prix)
                    ->setDuree($row->pa_duree)
                    ->setVictoire($row->pa_victoire)
                      ->setPillage($row->pa_pillage)
                      ->setBois($row->pa_bois)
                      ->setMana($row->pa_mana)
                      ->setAttaque($row->pa_attaque)
                      ->setDefense($row->pa_defense)
                       ->setImage($row->pa_image)
                      ->setMagie($row->pa_magie)
                    ->setPcid($row->pc_id);
            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function fetchByCategory( $pc_id )
    {
        $query      = $this -> getDbTable()     -> select()
                                                -> where( 'pc_id= "'.$pc_id.'"' ); 
        $resultSet  = $this->getDbTable()->fetchAll( $query );                           
        foreach ($resultSet as $row) {
            $entry = new Produit_Model_Unite();
            $entry  ->setId($row->pa_id)
                    ->setTitre($row->pa_titre)
                    ->setDescription($row->pa_description)
                    ->setPrix($row->pa_prix)
                    ->setDuree($row->pa_duree)
                    ->setVictoire($row->pa_victoire)
                      ->setPillage($row->pa_pillage)
                      ->setBois($row->pa_bois)
                      ->setMana($row->pa_mana)
                      ->setAttaque($row->pa_attaque)
                      ->setDefense($row->pa_defense)
                      ->setMagie($row->pa_magie)
                       ->setImage($row->pa_image)
                    ->setPcid($row->pc_id);
            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function fetchByCategoryWithCategory( $pc_id )
    {
        $query      = $this -> getDbTable()     -> select()
                                                -> setIntegrityCheck(false)
                                                -> from( array( 'pa' => 'produit_unite' ),
                                                         array( 'pa.pa_id',
                                                                'pa.pa_titre', 
                                                                'pa_description' => 'LOWER(pa.pa_description)',
                                                                'prix_avec_taxe' => new Zend_Db_Expr('pa.pa_prix * 1.196')
                                                              )
                                                       )
                                                -> join(array('pc' => 'produit_categorie_unite'),
                                                        'pa.pc_id = pc.pc_id'
                                                       )
                                                -> where( 'pa.pc_id= "'.$pc_id.'"' ); 
        $resultSet  = $this->getDbTable()->fetchAll( $query );     

        foreach ($resultSet as $row) {
            $entry = new Produit_Model_Unite();
            $entry  ->setId($row->pa_id)
                    ->setTitre($row->pa_titre)
                    ->setDescription($row->pa_description)
                    ->setPrix($row->prix_avec_taxe)
                    ->setDuree($row->pa_duree)
                    ->setVictoire($row->pa_victoire)
                      ->setPillage($row->pa_pillage)
                      ->setBois($row->pa_bois)
                      ->setMana($row->pa_mana)
                      ->setAttaque($row->pa_attaque)
                      ->setDefense($row->pa_defense)
                      ->setMagie($row->pa_magie)
                      ->setImage($row->pa_image)
                    ->setPcid($row->pc_id);
            $entries[] = $entry;
        }
        return $entries;
    }
	
	public function fetchUnitesPanier( $pa_id )
    {
        $query = $this -> getDbTable()  -> select()
                                        -> where( 'pa_id= "'.$pa_id.'"' ); 
        $row    = $this->getDbTable()->fetchRow( $query );                           
        if ( !$row ){
            return;
        }
        $Unite  ->setId($row->pa_id)
                  ->setTitre($row->pa_titre)
                  ->setDescription($row->pa_description)
                  ->setPrix($row->pa_prix)
                  ->setPopulation($row->pa_population)
                      ->setBois($row->pa_bois)
                      ->setDuree($row->pa_duree)
                    ->setVictoire($row->pa_victoire)
                      ->setPillage($row->pa_pillage)
                      ->setMana($row->pa_mana)
                      ->setAttaque($row->pa_attaque)
                      ->setDefense($row->pa_defense)
                      ->setMagie($row->pa_magie)
                       ->setImage($row->pa_image)
                      ->setMana($row->pa_mana)
                  ->setPcid($row->pc_id);
        return $Unite;
    }
    
}