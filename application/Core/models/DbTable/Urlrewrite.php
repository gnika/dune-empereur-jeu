<?php

class Core_Model_DbTable_Urlrewrite extends Zend_Db_Table_Abstract
{
    public function __construct()
    {
        $options = array(   'db'                => 'db',
                            'name'              => 'core_urlrewrite',
                            'primary'           => 'id',
                            'rowClass'          => 'Zend_Db_Table_Row',  // Valeur par défaut
                            'rowsetClass'       => 'Zend_Db_Table_Rowset', // Valeur par défaut
                            'referenceMap'      => array(), // Valeur par défaut
                            'dependentTables'   => array(), // Valeur par défaut
                            //'metadataCache'     => ''
                        );
                        
        parent::__construct( $options );
    }
}