<?phpclass Produit_Model_DbTable_CategorieUnite extends Zend_Db_Table_Abstract{    public function __construct()    {        $options = array(   'db'                => 'db',                            'name'              => 'produit_categorie_unite',                            'primary'           => 'pc_id',                            'rowClass'          => 'Zend_Db_Table_Row',  // Valeur par d�faut                            'rowsetClass'       => 'Zend_Db_Table_Rowset', // Valeur par d�faut                            'referenceMap'      => array(), // Valeur par d�faut                            'dependentTables'   => array('Produit_Model_DbTable_Unite'), // Valeur par d�faut                            //'metadataCache'     => ''                        );                                parent::__construct( $options );    }}