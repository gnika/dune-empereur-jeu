<?php

class Core_Model_Mapper_Urlrewrite
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
            $this->setDbTable('Core_Model_DbTable_Urlrewrite');
        }
        return $this->_dbTable;
    }
    
    public function save(Cms_Model_Urlrewrite $url)
    {
        $data = array(  'id'                => $url->getId(),
                        'request_path'      => $url->getRequestpath(),
                        'response_path'     => $url->getResponsepath(),
                        'response_code'     => $url->getresponsecode()
                    );
        if (null === ($id = $url->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    
    public function getInternalUri($requestpath, Core_Model_Urlrewrite $url)
    {
        $query  = $this->getDbTable()->select()
                                     ->where( 'request_path = ?', $requestpath ); 
        $row    = $this->getDbTable()->fetchRow( $query );                           
        if ( !$row ){
            return;
        }
        $url        ->setId( $row->id )
                    ->setRequestpath( $row->request_path )
                    ->setResponsepath( $row->response_path )
                    ->setResponsecode( $row->response_code );
        return $url;
    }
    
    public function getExternalUri($responsepath, Core_Model_Urlrewrite $url)
    {
        $query  = $this->getDbTable()->select()
                                     ->where( 'response_path = ?', $responsepath ); 
        $row    = $this->getDbTable()->fetchRow( $query );                           
        if ( !$row ){
            return;
        }
        $url        ->setId( $row->id )
                    ->setRequestpath( $row->request_path )
                    ->setResponsepath( $row->response_path )
                    ->setResponsecode( $row->response_code );
                    
        return $url;
    }

}