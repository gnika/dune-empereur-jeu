<?php

class Core_Model_DbTable_Personnage extends Zend_Db_Table_Abstract
{
    public function __construct()
    {
        $options = array(   'db'                => 'db',
                            'name'              => 'personnage',
                            'primary'           => 'pers_id',
                            'rowClass'          => 'Zend_Db_Table_Row',  // Valeur par défaut
                            'rowsetClass'       => 'Zend_Db_Table_Rowset', // Valeur par défaut
                            'referenceMap'      => array(), // Valeur par défaut
                            'dependentTables'   => array(), // Valeur par défaut
                            //'metadataCache'     => ''
                        );
                        
        parent::__construct( $options );
    }
}