<?php

class Cms_Model_Mapper_Static
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
            $this->setDbTable('Cms_Model_DbTable_Static');
        }
        return $this->_dbTable;
    }
    
    public function save(Cms_Model_Static $static)
    {
        $data = array(  'cs_id'             => $static->getId(),
                        'cs_headtitle'      => $static->getHeadTitle(),
                        'cs_description'    => $static->getDescription(),
                        'cs_keywords'       => $static->getKeywords(),
                        'cs_title'          => $static->getTitle(),
                        'cs_content'        => $static->getContent()
                    );
        if (null === ($id = $static->getId())) {
            unset($data['cs_id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('cs_id = ?' => $id));
        }
    }
        
    public function find($id, Cms_Model_Static $static )
    {
        
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $static     ->setId($row->cs_id)
                    ->setHeadTitle($row->cs_headtitle)
                    ->setDescription($row->cs_description)
                    ->setKeywords($row->cs_keywords)
                    ->setTitle($row->cs_title)
                    ->setContent($row->cs_content);
                    
         
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        
        foreach ($resultSet as $row) {
            $entry = new Cms_Model_Static();
            $entry  ->setId($row->cs_id)
                    ->setHeadTitle($row->cs_headtitle)
                    ->setDescription($row->cs_description)
                    ->setKeywords($row->cs_keywords)
                    ->setTitle($row->cs_title)
                    ->setContent($row->cs_content);
            $entries[] = $entry;
        }
        return $entries;
    }
    
}