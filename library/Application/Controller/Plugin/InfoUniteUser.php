<?php

class Application_Controller_Plugin_InfoUniteUser extends Zend_Controller_Plugin_Abstract
{    
    protected $_dbTable;
    protected $_items=array();
    
        
    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {
    
       $this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        };                                    

        $uniteUserMapper=new Produit_Model_Mapper_UserUnite();
        $resultSet=$uniteUserMapper->fetchAllbyUser($member->cuu_id);
        if (!$resultSet) {
            return;
        }
        foreach ($resultSet as $row) {
                    if($row['uu_duree'] < time())
            {
                $data = array(  'uu_quantite'      => $row['uu_en_cours']+$row['uu_quantite'],
                             'uu_duree'            => 0,
                             'uu_en_cours'            => 0
                        );

                $uniteUserMapper->getDbTable()->update($data, 
                array('uu_user_id  = ?' => $row['uu_user_id'],
                'uu_produit_unite_id = ?' =>$row['uu_produit_unite_id']));
            }
        }
        
    }
    
}