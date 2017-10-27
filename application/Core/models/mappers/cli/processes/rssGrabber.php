<?php 
// on va chercher les dernières news 
        $cache_id    = 'umpFeed';
        if (!($feed = Zend_Registry::get('cacheCore')->load($cache_id)) ) {
            try {
                $rssOE = Zend_Feed::import('http://www.u-m-p.org/site/rss/actualites.xml');

                // on initialise un tableau contenant les données du canal RSS
                $canal = array(
                    'titre'       => $rssOE->title(),
                    'lien'        => $rssOE->link(),
                    'elements'    => array()
                    );
                
                // on itère sur chaque élément du canal et on stocke les données qui nous intéressent
                foreach ($rssOE as $elem) {
                    $canal['elements'][] = array(
                        'titre'       => $elem->title(),
                        'lien'        => $elem->link(),
                        'description' => $elem->description()
                        );
                }
                
                $feed = $canal;
                
            } catch (Zend_Feed_Exception $e) {
                // l'importation du flux a échoué
                $feed = "Une exception a été renvoyée lors de l'importation du flux.\n";
            }
        Zend_Registry::get('cacheCore')->save( $feed );
}

 