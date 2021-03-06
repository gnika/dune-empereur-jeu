<?php

class Customer_Model_DbTable_User extends Zend_Db_Table_Abstract
{
    public function __construct()
    {
        $options = array(   'db'                => 'db',
                            'name'              => 'customer_user',
                            'primary'           => 'cuu_id',
                            'rowClass'          => 'Zend_Db_Table_Row',  // Valeur par d�faut
                            'rowsetClass'       => 'Zend_Db_Table_Rowset', // Valeur par d�faut
                            'referenceMap'      => array(), 
                            'dependentTables'   => array(), // Valeur par d�faut
                            //'metadataCache'     => ''
                        );
                        
        parent::__construct( $options );
    }
}