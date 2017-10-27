<?php

class Core_Model_Urlrewrite
{

    protected $_id;
    protected $_requestpath;
    protected $_responsepath;
    protected $_responsecode;
    
    
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
 
    public function setRequestpath($text)
    {
        $this->_requestpath = (string) $text;
        return $this;
    }

    public function getRequestpath()
    {
        return $this->_requestpath;
    }
 
    public function setResponsepath($text)
    {
        $this->_responsepath = (string) $text;
        return $this;
    }
    
    public function getResponsepath()
    {
        return $this->_responsepath;
    }

    public function setResponsecode($text)
    {
        $this->_responsecode = (string) $text;
        return $this;
    }
 
    public function getResponsecode()
    {
        return $this->_responsecode;
    }
 

    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }
 
    public function getId()
    {
        return $this->_id;
    }
}