<?phpclass Produit_Model_Unite {    protected $_pa_id;    protected $_pa_titre;    protected $_pa_description;    protected $_pa_prix;    protected $_pa_bois;    protected $_pa_mana;    protected $_pa_population;    protected $_pa_duree;    protected $_pa_victoire;    protected $_pa_pillage;    protected $_pa_attaque;    protected $_pa_defense;    protected $_pa_magie;    protected $_pa_pcid;    protected $_pa_image;     public function __construct(array $options = null)    {        if (is_array($options)) {            $this->setOptions($options);        }    }    public function __set($name, $value)    {        if ( strpos( $name, '_' ) ) {            $method = explode( '_' , $name );            $method = 'set' . ucfirst( $method[1] );        }        else {             $method = 'set' . $name;        }        if (('mapper' == $name) || !method_exists($this, $method)) {            throw new Exception('Invalid Unite property');        }        $this->$method($value);    }    public function __get($name)    {        if ( strpos( $name, '_' ) ) {            $method = explode( '_' , $name );            $method = 'get' . ucfirst( $method[1] );        }        else {             $method = 'get' . $name;        }           if (('mapper' == $name) || !method_exists($this, $method)) {            throw new Exception('Invalid Unite property');        }        return $this->$method();    }     public function setOptions(array $options)    {        $methods = get_class_methods($this);        foreach ($options as $key => $value) {            $method = 'set' . ucfirst($key);            if (in_array($method, $methods)) {                $this->$method($value);            }        }        return $this;    }     public function setTitre($text)    {        $this->_pa_titre = (string) $text;        return $this;    }    public function getTitre()    {        return $this->_pa_titre;    }     public function setDescription($text)    {        $this->_pa_description = (string) $text;        return $this;    }    public function getDescription()    {        return $this->_pa_description;    }        public function setPrix($price)    {        $this->_pa_prix = (float) $price;        return $this;    }    public function getPrix()    {        return $this->_pa_prix;    }        public function setPcid($id)    {        $this->_pa_pcid = (int) $id;        return $this;    }    public function getPcid()    {        return $this->_pa_pcid;    }        public function setId($id)    {        $this->_pa_id = (int) $id;        return $this;    }     public function getId()    {        return $this->_pa_id;    }        public function setPopulation($id)    {        $this->_pa_population = (int) $id;        return $this;    }     public function getPopulation()    {        return $this->_pa_population;    }                public function setBois($id)    {        $this->_pa_bois = (int) $id;        return $this;    }     public function getBois()    {        return $this->_pa_bois;    }            public function setMana($id)    {        $this->_pa_mana = (int) $id;        return $this;    }     public function getMana()    {        return $this->_pa_mana;    }            public function setDuree($id)    {        $this->_pa_duree = (int) $id;        return $this;    }     public function getDuree()    {        return $this->_pa_duree;    }            public function setVictoire($id)    {        $this->_pa_victoire = (int) $id;        return $this;    }     public function getVictoire()    {        return $this->_pa_victoire;    }            public function setPillage($id)    {        $this->_pa_pillage = (int) $id;        return $this;    }     public function getPillage()    {        return $this->_pa_pillage;    }            public function setAttaque($id)    {        $this->_pa_attaque= (int) $id;        return $this;    }     public function getAttaque()    {        return $this->_pa_attaque;    }                public function setDefense($id)    {        $this->_pa_defense= (int) $id;        return $this;    }     public function getDefense()    {        return $this->_pa_defense;    }        public function setMagie($id)    {        $this->_pa_magie= (int) $id;        return $this;    }     public function getMagie()    {        return $this->_pa_magie;    }        public function setImage($id)    {        $this->_pa_image= (string) $id;        return $this;    }     public function getImage()    {        return $this->_pa_image;    }}