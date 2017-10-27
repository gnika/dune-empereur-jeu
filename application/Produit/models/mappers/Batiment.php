<?php

class Produit_Model_Mapper_Batiment
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
            $this->setDbTable('Produit_Model_DbTable_Batiment');
        }
        return $this->_dbTable;
    }
    
    public function save(Produit_Model_Batiment $Batiment)
    {
        $data = array(  'pb_id'             => $Batiment->getId(),
                        'pb_titre'          => $Batiment->getTitre(),
                        'pb_description'    => $Batiment->getDescription(),
                        'pb_prix'           => $Batiment->getPrix(),
                        'pb_population'     => $Batiment->getPopulation(),
                        'pb_bois'           => $Batiment->getBois(),
                        'pb_mana'           => $Batiment->getMana(),
                        'pb_duree'          => $Batiment->getDuree(),
                        'pb_victoire'       => $Batiment->getvictoire(),
                        'pb_pillage'        => $Batiment->getPillage(),
                        'pb_attaque'        => $Batiment->getAttaque(),
                        'pb_defense'        => $Batiment->getDefense(),
                        'pb_image'          => $Batiment->getImage(),
                        'pb_taux_or'          => $Batiment->getTauxOr(),
                        'pb_taux_bois'          => $Batiment->getTauxBois(),
                        'pb_taux_population'          => $Batiment->getTauxPopulation(),
                        'pb_taux_mana'          => $Batiment->getTauxMana(),
                        'pb_structure'          => $Batiment->getStructure(),
                        'pb_unique'          => $Batiment->getUnique(),
                        'pb_magie'          => $Batiment->getMagie(),
                        'pb_auth_magie'     =>$Batiment->getAuthMagie(),
                        'pb_auth_magie'     =>$Batiment->getAuthMagie(),
                        'pb_auth_magie'     =>$Batiment->getAuthMagie(),
                    );
        if (null === ($id = $Batiment->getId())) {
            unset($data['pb_id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('pb_id = ?' => $id));
        }
    }
        
    public function find($id, Produit_Model_Batiment $Batiment)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        
        $row = $result->current();
        $Batiment      ->setId($row->pb_id)
                      ->setTitre($row->pb_titre)
                      ->setDescription($row->pb_description)
                      ->setPrix($row->pb_prix)
                      ->setPopulation($row->pb_population)
                      ->setBois($row->pb_bois)
                      ->setMana($row->pb_mana)
                      ->setDuree($row->pb_duree)
                      ->setVictoire($row->pb_victoire)
                      ->setPillage($row->pb_pillage)
                      ->setAttaque($row->pb_attaque)
                      ->setDefense($row->pb_defense)
                      ->setMagie($row->pb_magie)
                      ->setImage($row->pb_image)
                      ->setStructure($row->pb_structure)
                      ->setTauxOr($row->pb_taux_or)
                      ->setTauxBois($row->pb_taux_bois)
                      ->setTauxPopulation($row->pb_taux_population)
                      ->setUnique($row->pb_unique)
                      ->setTauxMana($row->pb_taux_mana)
                      ->setAuthUnite($row->pb_auth_unite)
                      ->setAuthMagie($row->pb_auth_magie)
                      ->setAuthChateau($row->pb_auth_chateau);
                      
                     // print_r($Batiment);die();
                     
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        
        foreach ($resultSet as $row) {
            $entry = new Produit_Model_Batiment();
            $entry  ->setId($row->pb_id)
                    ->setTitre($row->pb_titre)
                    ->setDescription($row->pb_description)
                    ->setPrix($row->pb_prix)
                    ->setDuree($row->pb_duree)
                    ->setVictoire($row->pb_victoire)
                      ->setPillage($row->pb_pillage)
                      ->setBois($row->pb_bois)
                      ->setMana($row->pb_mana)
                      ->setAttaque($row->pb_attaque)
                      ->setDefense($row->pb_defense)
                       ->setImage($row->pb_image)
                      ->setMagie($row->pb_magie)
                      ->setTauxOr($row->pb_taux_or)
                      ->setTauxBois($row->pb_taux_bois)
                      ->setStructure($row->pb_structure)
                      ->setTauxPopulation($row->pb_taux_population)
                      ->setUnique($row->pb_unique)
                      ->setTauxMana($row->pb_taux_mana)
                      ->setAuthUnite($row->pb_auth_unite)
                      ->setAuthMagie($row->pb_auth_magie)
                      ->setAuthChateau($row->pb_auth_chateau);
                      
            $entries[] = $entry;
        }
        return $entries;
    }
    
}