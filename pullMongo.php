#!/usr/bin/php
<?php
	ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(-1);

	$connection = new MongoClient("mongodb://testadmin:12adam12@ds041633.mongolab.com:41633/it420");

        $db = $connection->selectDB("it420");
        $gamename = $db->games;
	$owner = $gamename->find(array('owner' => 'agoldman'));
    	while ( $owner->hasNext() )
	{
    		$tempArray = $owner->getNext();
	}
	print_r ( $tempArray['Titles'] );
?>
