<?php

class Produit_Form_NombreUnite extends Zend_Form
{
    protected $_table=array();
    
    public function __construct($array=null)
    {
        if($array==null)
        $this->_table=$array;
        else
        $this->_table=$array['unite']->getId();
        $this->getForm();
    }
    public $elementDecorators = array(
        'ViewHelper',
        array(array('row' => 'HtmlTag'), array('tag' => 'p')),
    );

    public $buttonDecorators = array(
        'ViewHelper',
        array(array('row' => 'HtmlTag'), array('tag' => 'p')),
    );

    
    public function getForm()
    {
        $this->setName('envoiForm');
        
        $demandeUnite = new Zend_Form_Element_Text('demandeUnite');
        $demandeUnite   ->setLabel('Combien en voulez vous ? :')
                        ->setRequired(true)
                   /* ->addValidator(new Zend_Validate_Alnum( true ))
                    ->addValidator(new Zend_Validate_StringLength( array( 'min' => 3, 'max' => 40 )))*/
                    ->addValidator(new Zend_Validate_NotEmpty())
                    ->addValidator(new Zend_Validate_Digits())
                    ->addFilter(new Zend_Filter_StripTags);
                    
        $redirectUnite = new Zend_Form_Element_Hidden('redirect');
        $redirectUnite   
                    ->setRequired(true)
                    ->addValidator(new Zend_Validate_NotEmpty())
                    ->setValue($_SERVER['REQUEST_URI'])
                    ->addFilter(new Zend_Filter_StripTags);
                  
        $id_unite = new Zend_Form_Element_Hidden('id_unite');
        $id_unite   
                    ->setRequired(true)
                    ->addValidator(new Zend_Validate_NotEmpty())
                    ->setValue($this->_table)////$this->pageData['unite']->getId()
                    ->addFilter(new Zend_Filter_StripTags)
                    ->addValidator(new Zend_Validate_Digits());
        
        

        $submit = new Zend_Form_Element_Submit('send');
        $submit     ->setIgnore( true )
                    ->setLabel( 'valider');
 
        $this->addElements(array(
            $demandeUnite,
           $redirectUnite,
           $id_unite,
            $submit
        ));
 
        
        $this->setDecorators(array(
            'FormElements',
            'Form'
        ));
        


    }
}