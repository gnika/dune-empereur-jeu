<?php

class Produit_Model_Mapper_Magie
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
            $this->setDbTable('Produit_Model_DbTable_Magie');
        }
        return $this->_dbTable;
    }
    
    public function save(Produit_Model_Magie $Magie)
    {
        $data = array(  'pm_id'             => $Magie->getId(),
                        'pm_titre'          => $Magie->getTitre(),
                        'pm_description'    => $Magie->getDescription(),
                        'pm_prix'           => $Magie->getPrix(),
                        'pm_mana'           => $Magie->getMana(),
                        'pm_duree'          => $Magie->getDuree(),
                        'pm_victoire'       => $Magie->getvictoire(),
                        'pm_pillage'        => $Magie->getPillage(),
                        'pm_attaque'        => $Magie->getAttaque(),
                        'pm_defense'        => $Magie->getDefense(),
                        'pm_image'          => $Magie->getImage(),
                        'pm_multi_or'          => $Magie->getMultiOr(),
                        'pm_multi_bois'        => $Magie->getMultiBois(),
                        'pm_multi_population'  => $Magie->getMultiPopulation(),
                        'pm_multi_mana'        => $Magie->getMultiMana(),
                        'pm_magie'          => $Magie->getMagie()
                    );
        if (null === ($id = $Magie->getId())) {
            unset($data['pm_id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('pm_id = ?' => $id));
        }
    }
        
    public function find($id, Produit_Model_Magie $Magie)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        
        $row = $result->current();
        $Magie        ->setId($row->pm_id)
                      ->setTitre($row->pm_titre)
                      ->setDescription($row->pm_description)
                      ->setPrix($row->pm_prix)
                      ->setMana($row->pm_mana)
                      ->setDuree($row->pm_duree)
                      ->setVictoire($row->pm_victoire)
                      ->setPillage($row->pm_pillage)
                      ->setAttaque($row->pm_attaque)
                      ->setDefense($row->pm_defense)
                      ->setMagie($row->pm_magie)
                      ->setImage($row->pm_image)
                      ->setMultiOr($row->pm_multi_or)
                      ->setMultiBois($row->pm_multi_bois)
                      ->setMultiPopulation($row->pm_multi_population)
                      ->setMultiMana($row->pm_multi_mana);
                      
                     // print_r($Magie);die();
                     
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        
        foreach ($resultSet as $row) {
            $entry = new Produit_Model_Magie();
            $entry  ->setId($row->pm_id)
                      ->setTitre($row->pm_titre)
                      ->setDescription($row->pm_description)
                      ->setPrix($row->pm_prix)
                      ->setMana($row->pm_mana)
                      ->setDuree($row->pm_duree)
                      ->setVictoire($row->pm_victoire)
                      ->setPillage($row->pm_pillage)
                      ->setAttaque($row->pm_attaque)
                      ->setDefense($row->pm_defense)
                      ->setMagie($row->pm_magie)
                      ->setImage($row->pm_image)
                      ->setMultiOr($row->pm_multi_or)
                      ->setMultiBois($row->pm_multi_bois)
                      ->setMultiPopulation($row->pm_multi_population)
                      ->setMultiMana($row->pm_multi_mana);
            $entries[] = $entry;
        }
        return $entries;
    }
    
}