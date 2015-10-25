#!/usr/bin/php
<?php

        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(-1);
	
	$username;
	$passwd;
	$powerlvl;

	$connection = new MongoClient("mongodb://testadmin:12adam12@ds041633.mongolab.com:41633/it420");

	$db = $connection->selectDB("it420");
	$test = $db->users;
	$test->createIndex(array('username' => 1), array('unique' => 1, 'dropDups' => 1));
        $test->insert(array('username' => 'anthony', 'passwd' => sha1('bodypillow'), 'powerlevel' => '9010'));
	$connection->close();



?>
