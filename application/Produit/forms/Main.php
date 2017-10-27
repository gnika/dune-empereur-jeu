<?php

class Produit_Form_Main extends Zend_Form
{

    public $elementDecorators = array(
        'ViewHelper',
        array(array('row' => 'HtmlTag'), array('tag' => 'p')),
    );

    public $buttonDecorators = array(
        'ViewHelper',
        array(array('row' => 'HtmlTag'), array('tag' => 'p')),
    );

    
    public function init()
    {
        $this->setName('envoiForm');

        
        

        $submit = new Zend_Form_Element_Submit('send');
        $submit     ->setIgnore( true )
                    ->setLabel( 'valider tous mes achats');
 
        $this->addElements(array(
            $submit
        ));
 
        
        $this->setDecorators(array(
            'FormElements',
            //'Fieldset',
            'Form'
        ));
        


    }
}