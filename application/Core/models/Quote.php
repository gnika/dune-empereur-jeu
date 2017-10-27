<?php

class Core_Model_Quote
{

    protected $_quo_id;
    protected $_quo_id_perso;
    protected $_quo_quete;
    protected $_quo_maj_quete;
    protected $_quo_maj_quete_perso;
    protected $_quo_maj_quete_id_ext;
    protected $_quo_reponse;
    protected $_quo_quote;
    protected $_quo_quote_en;
    protected $_quo_humeur;
    protected $_quo_id_multiple;
    protected $_quo_nb_multiple;
    protected $_quo_fnctn;
    protected $_quo_journal;
    
    
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        if ( strpos( $name, '_' ) ) {
            $method = explode( '_' , $name );
            $method = 'set' . ucfirst( $method[1] );
        }
        else {
             $method = 'set' . $name;
        }
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid quote property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        if ( strpos( $name, '_' ) ) {
            $method = explode( '_' , $name );
            $method = 'get' . ucfirst( $method[1] );
        }
        else {
             $method = 'get' . $name;
        }
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid quote property');
        }
        return $this->$method();
    }
 
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }
 
    public function setId($id)
    {
        $this->_quo_id = (int) $id;
        return $this;
    }
 
    public function getId()
    {
        return $this->_quo_id;
    }
	
	public function setIdPerso($id)
    {
        $this->_quo_id_perso = (int) $id;
        return $this;
    }
 
    public function getIdPerso()
    {
        return $this->_quo_id_perso;
    }
	
	public function setQuete($id)
    {
        $this->_quo_quete = 	$id;
        return $this;
    }
 
    public function getQuete()
    {
        return $this->_quo_quete;
    }
	
	public function setMajQuete($id)
    {
        $this->_quo_maj_quete = 	$id;
        return $this;
    }
 
    public function getMajQuete()
    {
        return $this->_quo_maj_quete;
    }
	
	public function setMajQuetePerso($id)
    {
        $this->_quo_maj_quete_perso = 	$id;
        return $this;
    }
 
    public function getMajQuetePerso()
    {
        return $this->_quo_maj_quete_perso;
    }
	
	public function setMajQueteIdExt($id)
    {
        $this->_quo_maj_quete_id_ext = 	$id;
        return $this;
    }
 
    public function getMajQueteIdExt()
    {
        return $this->_quo_maj_quete_id_ext;
    }
	
	public function setQuote($id)
    {
        $this->_quo_quote =  $id;
        return $this;
    }
 
    public function getQuote()
    {
        return $this->_quo_quote;
    }
	
	public function setQuoteEn($id)
    {
        $this->_quo_quote_en =  $id;
        return $this;
    }
 
    public function getQuoteEn()
    {
        return $this->_quo_quote_en;
    }
	
	public function setHumeur($id)
    {
        $this->_quo_humeur =  $id;
        return $this;
    }
 
    public function getHumeur()
    {
        return $this->_quo_humeur;
    }
	
	public function setReponse($id)
    {
        $this->_quo_reponse =  $id;
        return $this;
    }
 
    public function getReponse()
    {
        return $this->_quo_reponse;
    }
	
	public function setNbMultiple($id)
    {
        $this->_quo_nb_multiple =  $id;
        return $this;
    }
 
    public function getNbMultiple()
    {
        return $this->_quo_nb_multiple;
    }
	
	public function setIdMultiple($id)
    {
        $this->_quo_id_multiple =  $id;
        return $this;
    }
 
    public function getIdMultiple()
    {
        return $this->_quo_id_multiple;
    }
	
	public function setFnctn($id)
    {
        $this->_quo_fnctn =  $id;
        return $this;
    }
 
    public function getFnctn()
    {
        return $this->_quo_fnctn;
    }
	
	public function setJournal($id)
    {
        $this->_quo_journal =  $id;
        return $this;
    }
 
    public function getJournal()
    {
        return $this->_quo_journal;
    }

}