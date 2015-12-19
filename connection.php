#!/usr/bin/php
<?php
 	ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(-1);

	function get_data($url)
        {
                $ch = curl_init();
                $timeout = 5;
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                $data = curl_exec($ch);
                curl_close($ch);
                return $data;
        }

	$connection = new MongoClient("mongodb://testadmin:12adam12@ds041633.mongolab.com:41633/it420");

	$db = $connection->selectDB("it420");
        $owner = $db->selectCollection('game_description');

	$timeToSleep;

	for ($x = 1; $x <= 1000; $x++)
        {
               if($timeToSleep == 200)
               {
                       sleep(900);
                       $timeToSleep = 0;
               }
                $json = 'http://www.giantbomb.com/api/game/3030-'.$x.'/?api_key=193e8694d3f76bad6edbce7452d3154ad8731a64&format=json&field_list=name,description,images';
                $data = get_data($json);
                $obj = json_decode($data);
		$owner->insert($obj);
		$timeToSleep++;
        }
	$connection->close();
	echo "We did it";
?>
