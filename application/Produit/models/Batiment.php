<?phpclass Produit_Model_Batiment {    protected $_pb_id;    protected $_pb_titre;    protected $_pb_description;    protected $_pb_prix;    protected $_pb_bois;    protected $_pb_mana;    protected $_pb_population;    protected $_pb_duree;    protected $_pb_victoire;    protected $_pb_pillage;    protected $_pb_attaque;    protected $_pb_defense;    protected $_pb_magie;    protected $_pb_image;    protected $_pb_taux_or;    protected $_pb_taux_bois;    protected $_pb_taux_population;    protected $_pb_taux_magie;    protected $_pb_taux_mana;    protected $_pb_structure;    protected $_pb_unique;    protected $_cuu_auth_unite;    protected $_cuu_auth_chateau;    protected $_cuu_auth_magie;     public function __construct(array $options = null)    {        if (is_array($options)) {            $this->setOptions($options);        }    }    public function __set($name, $value)    {        if ( strpos( $name, '_' ) ) {            $method = explode( '_' , $name );            $method = 'set' . ucfirst( $method[1] );        }        else {             $method = 'set' . $name;        }        if (('mapper' == $name) || !method_exists($this, $method)) {            throw new Exception('Invalid Unite property');        }        $this->$method($value);    }    public function __get($name)    {        if ( strpos( $name, '_' ) ) {            $method = explode( '_' , $name );            $method = 'get' . ucfirst( $method[1] );        }        else {             $method = 'get' . $name;        }           if (('mapper' == $name) || !method_exists($this, $method)) {            throw new Exception('Invalid Unite property');        }        return $this->$method();    }     public function setOptions(array $options)    {        $methods = get_class_methods($this);        foreach ($options as $key => $value) {            $method = 'set' . ucfirst($key);            if (in_array($method, $methods)) {                $this->$method($value);            }        }        return $this;    }     public function setTitre($text)    {        $this->_pb_titre = (string) $text;        return $this;    }    public function getTitre()    {        return $this->_pb_titre;    }     public function setDescription($text)    {        $this->_pb_description = (string) $text;        return $this;    }    public function getDescription()    {        return $this->_pb_description;    }        public function setPrix($price)    {        $this->_pb_prix = (float) $price;        return $this;    }    public function getPrix()    {        return $this->_pb_prix;    }        public function setId($id)    {        $this->_pb_id = (int) $id;        return $this;    }     public function getId()    {        return $this->_pb_id;    }        public function setPopulation($id)    {        $this->_pb_population = (int) $id;        return $this;    }     public function getPopulation()    {        return $this->_pb_population;    }                public function setBois($id)    {        $this->_pb_bois = (int) $id;        return $this;    }     public function getBois()    {        return $this->_pb_bois;    }            public function setMana($id)    {        $this->_pb_mana = (int) $id;        return $this;    }     public function getMana()    {        return $this->_pb_mana;    }            public function setDuree($id)    {        $this->_pb_duree = (int) $id;        return $this;    }     public function getDuree()    {        return $this->_pb_duree;    }            public function setVictoire($id)    {        $this->_pb_victoire = (int) $id;        return $this;    }     public function getVictoire()    {        return $this->_pb_victoire;    }            public function setPillage($id)    {        $this->_pb_pillage = (int) $id;        return $this;    }     public function getPillage()    {        return $this->_pb_pillage;    }            public function setAttaque($id)    {        $this->_pb_attaque= (int) $id;        return $this;    }     public function getAttaque()    {        return $this->_pb_attaque;    }                public function setDefense($id)    {        $this->_pb_defense= (int) $id;        return $this;    }     public function getDefense()    {        return $this->_pb_defense;    }        public function setMagie($id)    {        $this->_pb_magie= (int) $id;        return $this;    }     public function getMagie()    {        return $this->_pb_magie;    }        public function setImage($id)    {        $this->_pb_image= (string) $id;        return $this;    }     public function getImage()    {        return $this->_pb_image;    }        public function setTauxOr($id)    {        $this->_pb_taux_or= (string) $id;        return $this;    }     public function getTauxOr()    {        return $this->_pb_taux_or;    }        public function setTauxBois($id)    {        $this->_pb_taux_bois= (string) $id;        return $this;    }     public function getTauxBois()    {        return $this->_pb_taux_bois;    }        public function setTauxPopulation($id)    {        $this->_pb_taux_population= (string) $id;        return $this;    }     public function getTauxPopulation()    {        return $this->_pb_taux_population;    }        public function setTauxMana($id)    {        $this->_pb_taux_mana= (string) $id;        return $this;    }     public function getTauxMana()    {        return $this->_pb_taux_mana;    }        public function setStructure($id)    {        $this->_pb_structure= (string) $id;        return $this;    }     public function getStructure()    {        return $this->_pb_structure;    }        public function setUnique($id)    {        $this->_pb_unique= (string) $id;        return $this;    }     public function getUnique()    {        return $this->_pb_unique;    }                public function setAuthUnite($id)    {        $this->_cuu_auth_unite = (int) $id;        return $this;    }        public function getAuthUnite()    {        return $this->_cuu_auth_unite;    }     public function getAuthChateau()    {        return $this->_cuu_auth_chateau;    }        public function setAuthChateau($id)    {        $this->_cuu_auth_chateau = (int) $id;        return $this;    }        public function getAuthMagie()    {        return $this->_cuu_auth_magie;    }        public function setAuthMagie($id)    {        $this->_cuu_auth_magie = (int) $id;        return $this;    }}