<?php

// export data from BioNames CouchDB

require_once (dirname(__FILE__) . '/config.inc.php');
require_once (dirname(__FILE__) . '/lib.php');



$databases = array(
'archive',
'gallica',
/*'phylota_184',
'bionames',*/
);

foreach ($databases as $database)
{

	// Folder for each database
	$db_dir = dirname(__FILE__) . "/" . $database;
	if (!file_exists($db_dir))
	{
		$oldumask = umask(0); 
		mkdir($db_dir, 0777);
		umask($oldumask);
	}


	file_put_contents($database . '/data.jsonl', '');

	$rows_per_page = 100;
	$skip = 0;

	$done = false;
	while (!$done)
	{
		$url = 'http://direct.bionames.org:5984/' . $database . '/_design/export/_view/jsonl';
	
		$url .= '?limit=' . $rows_per_page . '&skip=' . $skip;
	
		echo $url . "\n";

		$resp = get($url);

		if ($resp)
		{
			$response_obj = json_decode($resp);
			if (!isset($response_obj->error))
			{
				$n = count($response_obj->rows);
			
				foreach ($response_obj->rows as $row)
				{
			
					file_put_contents($database . '/data.jsonl', json_encode($row) . "\n", FILE_APPEND);

				}	
			}
		}
	
		$skip += $rows_per_page;
		$done = ($n < $rows_per_page);			
	}
}

			


?>