 <?php 

function sanitize($input) {
    return utf8_decode($input) ;
}

function fetchSearchableunites(){
    $db = Zend_Registry::get('db');
    $db->setFetchMode(Zend_Db::FETCH_OBJ);	
    $query = $db   ->select()
                    ->from( array("mba" => 'module_blog_unite' ) ) 
                    ->where( "mba.showInSearch = '1'");
    return $db->fetchAll($query);;
}

function fetchSearchableVideos(){
    $db = Zend_Registry::get('db');
    $db->setFetchMode(Zend_Db::FETCH_OBJ);	
    $query = $db   ->select()
                    ->from( array("mba" => 'module_video_entry' ) ) 
                    ->where( "mba.isActive = '1'");
    return $db->fetchAll($query);;
}

//create the index
$index = new Zend_Search_Lucene(PATH_VAR . 'lucene/siteIndex', true);
$searchableunites = fetchSearchableunites();
$searchableVideos = fetchSearchableVideos();

//grab each feed
foreach ($searchableunites as $content) {

    $doc = new Zend_Search_Lucene_Document();       
    $doc->addField(Zend_Search_Lucene_Field::Text('title', sanitize($content->htmlTitle)));
    $doc->addField(Zend_Search_Lucene_Field::UnIndexed('cid',$content->id));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('intro', sanitize($content->htmlIntro)));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('content', sanitize($content->htmlContent)));

    //echo "\tAjout dans l'index : ".utf8_decode($content->htmlTitle)." avec l'id " . $content->id ."\n";
    $index->addDocument($doc);
}
$index->commit();

foreach ($searchableVideos as $content) {

    $doc = new Zend_Search_Lucene_Document();       
    $doc->addField(Zend_Search_Lucene_Field::Text('title', sanitize($content->headTitle)));
    $doc->addField(Zend_Search_Lucene_Field::UnIndexed('cid',$content->id));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('intro', sanitize($content->htmlIntro)));
    $doc->addField(Zend_Search_Lucene_Field::Unstored('keywords', sanitize($content->headKeywords)));

    //echo "\tAjout vidéo dans l'index : ".utf8_decode($content->headTitle)." avec l'id " . $content->id ."\n";
    $index->addDocument($doc);
}
$index->commit();


//echo $index->count()." documents indexé.\n";
