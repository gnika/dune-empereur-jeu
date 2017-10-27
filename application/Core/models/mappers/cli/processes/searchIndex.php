<?php

require_once 'Zend/Search/Lucene.php';

//open the index
$index = new Zend_Search_Lucene(PATH_VAR . 'lucene/siteIndex');

$query = '*';

$hits = $index->find($query);

//echo "L'index contient ".$index->count()." documents.\n\n";

//echo "La recherche '".$query."' a retourné " .count($hits). " résultats\n\n";

foreach ($hits as $hit) {
	//echo $hit->title."\n";
	//echo "\tPertinence : ".sprintf('%.2f', $hit->score)."\n";
}
 