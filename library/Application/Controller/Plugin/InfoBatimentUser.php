<?php

class Application_Controller_Plugin_InfoBatimentUser extends Zend_Controller_Plugin_Abstract
{
        
    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {
    
       $this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        };                                    
        $user=new Customer_Model_Mapper_User();
        $us=new Customer_Model_User;
        $user->find($member->cuu_id, $us);
        $uniteUserMapper=new Produit_Model_Mapper_UserBatiment();
        $resultSet=$uniteUserMapper->fetchAllbyUser($member->cuu_id);
        if (!$resultSet) {
            return;
        }
        foreach ($resultSet as $row) {
            if($row['ub_duree'] < time() && $row['ub_duree']!=0)
            {   
                $entry = new Produit_Model_UserBatiment();
                $entry  ->setUserId($row['ub_user_id'])
                        ->setProduitBatimentId($row['ub_produit_batiment_id'])
                        ->setDuree(0)
                        ->setQuantite($row['ub_quantite']+1);

                    $data = array(  'ub_quantite'      => $entry->getQuantite(),
                                 'ub_duree'            => 0
                            );

                    $uniteUserMapper->getDbTable()->update($data, 
                    array('ub_user_id  = ?' => $entry->getUserId(),
                    'ub_produit_batiment_id = ?' =>$entry->getProduitBatimentId()));
                    
                    $user->misajour($us, $row);
                    
                
            }
        }
       
    }
    
}