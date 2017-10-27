<?php

class Produit_Form_Batiment extends Zend_Form
{
    
    public $elementDecorators = array(
        'ViewHelper',
        array(array('row' => 'HtmlTag'), array('tag' => 'p')),
    );

    public $buttonDecorators = array(
        'ViewHelper',
        array(array('row' => 'HtmlTag'), array('tag' => 'p')),
    );

    
    public function __construct($id = null)
    {
        $this->setName('envoiForm');
        
                    
        $redirectBatiment = new Zend_Form_Element_Hidden('redirect');
        $redirectBatiment   
                    ->setRequired(true)
                    ->addValidator(new Zend_Validate_NotEmpty())
                    ->setValue($_SERVER['REQUEST_URI'])
                    ->addFilter(new Zend_Filter_StripTags);
                  
        $id_batiment = new Zend_Form_Element_Hidden('id_batiment');
        $id_batiment   
                    ->setRequired(true)
                    ->addValidator(new Zend_Validate_NotEmpty())
                    ->setValue($id)////$this->pageData['batiment']->getId()
                    ->addFilter(new Zend_Filter_StripTags)
                    ->addValidator(new Zend_Validate_Digits());
        
        

        $submit = new Zend_Form_Element_Submit('send');
        $submit     ->setIgnore( true )
                    ->setLabel( 'valider');
 
        $this->addElements(array(
           $redirectBatiment,
           $id_batiment,
            $submit
        ));
 
        
        $this->setDecorators(array(
            'FormElements',
            'Form'
        ));
        


    }
}