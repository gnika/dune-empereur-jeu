<?php

class Core_Model_Page
{

    protected $_id;
    protected $_headtitle;
    protected $_description;
    protected $_keywords;
    protected $_title;
    protected $_content;
    
    
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
            throw new Exception('Invalid page property');
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
            throw new Exception('Invalid page property');
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
 
    public function setHeadtitle($text)
    {
        $this->_headtitle = (string) $text;
        return $this;
    }

    public function getHeadtitle()
    {
        return $this->_headtitle;
    }
 
    public function setDescription($text)
    {
        $this->_description = (string) $text;
        return $this;
    }
    
    public function getDescription()
    {
        return $this->_description;
    }

    public function setKeywords($text)
    {
        $this->_keywords = (string) $text;
        return $this;
    }
 
    public function getKeywords()
    {
        return $this->_keywords;
    }
 
    public function setTitle($text)
    {
        $this->_title = (string) $text;
        return $this;
    }
 
    public function getTitle()
    {
        return $this->_title;
    }
    
    public function setContent($text)
    {
        $this->_content = (string) $text;
        return $this;
    }
 
    public function getContent()
    {
        return $this->_content;
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