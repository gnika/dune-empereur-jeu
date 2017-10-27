<?php

class Customer_Model_User
{

    protected $_cuu_id;
    protected $_cuu_login;
    protected $_cuu_password = null;
    protected $_cuu_name;
    protected $_cuu_email;
    protected $_cuu_securitytoken;
    protected $_cuu_heure;
    protected $_cuu_jour;
    protected $_cuu_epice;
    protected $_cuu_impot;
    protected $_cuu_soin;
    protected $_cuu_serviteur;
    protected $_cuu_influence;
    protected $_cuu_gardien;
    protected $_cuu_vaisseau;
    protected $_cuu_troupe;
    protected $_cuu_corruption;
    protected $_cuu_entretien;
    protected $_cuu_salle;
    protected $_cuu_renommee;
    protected $_cuu_delai_attentat;
    protected $_cuu_nb_victime;
    protected $_cuu_valeur_serviteur;
    protected $_cuu_valeur_troupe;
    protected $_cuu_valeur_vaisseau;
    protected $_cuu_entrainement;
    protected $_cuu_exploration;
    protected $_cuu_objets;
    protected $_cuu_rapport_planete;
    protected $_cuu_connexion;
 
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
            $method = 'set' . ucfirst( $method[2] );
        }
        else {
             $method = 'set' . $name;
        }
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid user property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        if ( strpos( $name, '_' ) ) {
            $method = explode( '_' , $name );
            $method = 'get' . ucfirst( $method[2] );
        }
        else {
             $method = 'get' . $name;
        }   
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid user property');
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
        $this->_cuu_id =  $id;
        return $this;
    }
 
    public function getId()
    {
        return $this->_cuu_id;
    }
   
    public function setSecuritytoken($hash)
    {
        $this->_cuu_securitytoken = (string) $hash;
        return $this;
    }
 
    public function getSecuritytoken()
    {
        return $this->_cuu_securitytoken;
    }
	
    public function setLogin($text)
    {
        $this->_cuu_login = (string) $text;
        return $this;
    }

    public function getLogin()
    {
        return $this->_cuu_login;
    }
 
    public function setPassword($text)
    {
        $this->_cuu_password = (string) md5($text);
        return $this;
    }
 
    public function setPasswordNotMd5($text)
    {
        $this->_cuu_password = (string) $text;
        return $this;
    }
   
    public function getPassword()
    {
        return $this->_cuu_password;
    }
    
    public function setName($text)
    {
        $this->_cuu_name = (string) $text;
        return $this;
    }

    public function getName()
    {
        return $this->_cuu_name;
    }
    
    public function setEmail($text)
    {
        $this->_cuu_email = (string) $text;
        return $this;
    }

    public function getEmail()
    {
        return $this->_cuu_email;
    }
	
	public function setJour($text)
    {
        $this->_cuu_jour =  $text;
        return $this;
    }

    public function getJour()
    {
        return $this->_cuu_jour;
    }
	
	public function setHeure($text)
    {
        $this->_cuu_heure = $text;
        return $this;
    }

    public function getHeure()
    {
        return $this->_cuu_heure;
    }
        
	public function setEpice($text)
    {
        $this->_cuu_epice =  $text;
        return $this;
    }

    public function getEpice()
    {
        return $this->_cuu_epice;
    }
	
	public function setImpot($text)
    {
        $this->_cuu_impot =  $text;
        return $this;
    }

    public function getImpot()
    {
        return $this->_cuu_impot;
    }
	
	public function setSoin($text)
    {
        $this->_cuu_soin =  $text;
        return $this;
    }

    public function getSoin()
    {
        return $this->_cuu_soin;
    }
	
	public function setServiteur($text)
    {
        $this->_cuu_serviteur =  $text;
        return $this;
    }

    public function getServiteur()
    {
        return $this->_cuu_serviteur;
    }
	
	public function setInfluence($text)
    {
        $this->_cuu_influence =  $text;
        return $this;
    }

    public function getInfluence()
    {
        return $this->_cuu_influence;
    }
	
	public function setGardien($text)
    {
        $this->_cuu_gardien =  $text;
        return $this;
    }

    public function getGardien()
    {
        return $this->_cuu_gardien;
    }
	
	public function setVaisseau($text)
    {
        $this->_cuu_vaisseau =  $text;
        return $this;
    }

    public function getVaisseau()
    {
        return $this->_cuu_vaisseau;
    }
	
	public function setTroupe($text)
    {
        $this->_cuu_troupe =  $text;
        return $this;
    }

    public function getTroupe()
    {
        return $this->_cuu_troupe;
    }
	
	public function setCorruption($text)
    {
        $this->_cuu_corruption =  $text;
        return $this;
    }

    public function getCorruption()
    {
        return $this->_cuu_corruption;
    }
	
	public function setEntretien($text)
    {
        $this->_cuu_entretien =  $text;
        return $this;
    }

    public function getEntretien()
    {
        return $this->_cuu_entretien;
    }
	
	public function setSalle($text)
    {
        $this->_cuu_salle =  $text;
        return $this;
    }

    public function getSalle()
    {
        return $this->_cuu_salle;
    }
	
	public function setRenommee($text)
    {
        $this->_cuu_renommee =  $text;
        return $this;
    }

    public function getRenommee()
    {
        return $this->_cuu_renommee;
    }
	
	public function setDelaiAttentat($text)
    {
        $this->_cuu_delai_attentat =  $text;
        return $this;
    }

    public function getDelaiAttentat()
    {
        return $this->_cuu_delai_attentat;
    }
	
	public function setNbVictime($text)
    {
        $this->_cuu_nb_victime =  $text;
        return $this;
    }

    public function getNbVictime()
    {
        return $this->_cuu_nb_victime;
    }
	
	public function setValeurServiteur($text)
    {
        $this->_cuu_valeur_serviteur =  $text;
        return $this;
    }

    public function getValeurServiteur()
    {
        return $this->_cuu_valeur_serviteur;
    }
	
	public function setValeurTroupe($text)
    {
        $this->_cuu_valeur_troupe =  $text;
        return $this;
    }

    public function getValeurTroupe()
    {
        return $this->_cuu_valeur_troupe;
    }
	
	public function setValeurVaisseau($text)
    {
        $this->_cuu_valeur_vaisseau =  $text;
        return $this;
    }

    public function getValeurVaisseau()
    {
        return $this->_cuu_valeur_vaisseau;
    }
	
	public function setEntrainement($text)
    {
        $this->_cuu_entrainement =  $text;
        return $this;
    }

    public function getEntrainement()
    {
        return $this->_cuu_entrainement;
    }
    
    public function setExploration($text)
    {
        $this->_cuu_exploration =  $text;
        return $this;
    }

    public function getExploration()
    {
        return $this->_cuu_exploration;
    }
    
    public function setObjets($text)
    {
        $this->_cuu_objets =  $text;
        return $this;
    }

    public function getObjets()
    {
        return $this->_cuu_objets;
    }
    
    public function setRapport($text)
    {
        $this->_cuu_rapport_planete =  $text;
        return $this;
    }

    public function getRapport()
    {
        return $this->_cuu_rapport_planete;
    }
    
    public function setConnexion($text)
    {
        $this->_cuu_connexion =  $text;
        return $this;
    }

    public function getConnexion()
    {
        return $this->_cuu_connexion;
    }
    
    



}