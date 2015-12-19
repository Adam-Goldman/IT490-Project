#!/usr/bin/php
<?php
	ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(-1);

	$username;

	$connection = new MongoClient("mongodb://testadmin:12adam12@ds041633.mongolab.com:41633/it420");

        $db = $connection->selectDB("it420");
        $gamename = $db->games_description;
	$owner = $gamename->find(array('name' => 'Bass Avenger'));
    	while ( $owner->hasNext() )
	{
    		$tempArray = $owner->getNext();
	}
	var_dump($owner);
?>
