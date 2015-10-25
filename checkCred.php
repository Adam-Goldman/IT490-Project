#!/usr/bin/php
<?php

	ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(-1);
	
	$temp = json_decode($argv[1]);
	$userVar = $temp['username'];
	$userPass = $temp['password'];

	$connection = new MongoClient("mongodb://testadmin:12adam12@ds041633.mongolab.com:41633/it420");

        $db = $connection->selectDB("it420");
        $gamename = $db->users;
        $owner = $gamename->find(array('username' => $userVar));
        while ( $owner->hasNext() )
        {
                $tempArray = $owner->getNext();
        }
	//print_r ( $tempArray['passwd'] );
	if($tempArray['passwd'] === sha1($userPass)){
		echo 'true';
	}
	else{
		echo 'false';
	}

?>
