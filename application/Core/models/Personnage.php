<?php

class Core_Model_Personnage
{

    protected $_pers_id;
    protected $_pers_nom;
    protected $_pers_faction;
    
    
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
            throw new Exception('Invalid urlrewrite property');
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
            throw new Exception('Invalid urlrewrite property');
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
        $this->_pers_id = (int) $id;
        return $this;
    }
 
    public function getId()
    {
        return $this->_pers_id;
    }
	
	public function setNom($id)
    {
        $this->_pers_nom = 	$id;
        return $this;
    }
 
    public function getNom()
    {
        return $this->_pers_nom;
    }
	
	public function setFaction($id)
    {
        $this->_pers_faction =  $id;
        return $this;
    }
 
    public function getFaction()
    {
        return $this->_pers_faction;
    }
}