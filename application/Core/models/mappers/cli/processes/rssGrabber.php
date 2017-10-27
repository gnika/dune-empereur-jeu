<?php 
// on va chercher les derni�res news 
        $cache_id    = 'umpFeed';
        if (!($feed = Zend_Registry::get('cacheCore')->load($cache_id)) ) {
            try {
                $rssOE = Zend_Feed::import('http://www.u-m-p.org/site/rss/actualites.xml');

                // on initialise un tableau contenant les donn�es du canal RSS
                $canal = array(
                    'titre'       => $rssOE->title(),
                    'lien'        => $rssOE->link(),
                    'elements'    => array()
                    );
                
                // on it�re sur chaque �l�ment du canal et on stocke les donn�es qui nous int�ressent
                foreach ($rssOE as $elem) {
                    $canal['elements'][] = array(
                        'titre'       => $elem->title(),
                        'lien'        => $elem->link(),
                        'description' => $elem->description()
                        );
                }
                
                $feed = $canal;
                
            } catch (Zend_Feed_Exception $e) {
                // l'importation du flux a �chou�
                $feed = "Une exception a �t� renvoy�e lors de l'importation du flux.\n";
            }
        Zend_Registry::get('cacheCore')->save( $feed );
}

 