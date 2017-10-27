<?php

class Core_Model_DbTable_Urlrewrite extends Zend_Db_Table_Abstract
{
    public function __construct()
    {
        $options = array(   'db'                => 'db',
                            'name'              => 'core_urlrewrite',
                            'primary'           => 'id',
                            'rowClass'          => 'Zend_Db_Table_Row',  // Valeur par d�faut
                            'rowsetClass'       => 'Zend_Db_Table_Rowset', // Valeur par d�faut
                            'referenceMap'      => array(), // Valeur par d�faut
                            'dependentTables'   => array(), // Valeur par d�faut
                            //'metadataCache'     => ''
                        );
                        
        parent::__construct( $options );
    }
}