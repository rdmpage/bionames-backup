<?php

// export views from BioNames CouchDB

require_once (dirname(__FILE__) . '/config.inc.php');
require_once (dirname(__FILE__) . '/lib.php');


// Databases and views
$views = array(
	'archive' => array('export', 'housekeeping', 'pdf'),
	'gallica' => array('export'),
	'phylota_184' => array('cleaning', 'export', 'geojson', 'geometry', 'publication', 'taxa', 'tree'),
	'bionames' => array("app","author","bhl","biblife","citation","classification","cleaning","count","darwincorearchive","datamining","eol","export","genus","geo","geodd","html","identifier","ion","issn","oclc","openurl","publication","references","sandbox-gna","sandbox","search","taxonName")
);

foreach ($views as $database => $views)
{
	// Folder for each database
	$db_dir = dirname(__FILE__) . "/" . $database;
	if (!file_exists($db_dir))
	{
		$oldumask = umask(0); 
		mkdir($db_dir, 0777);
		umask($oldumask);
	}

	// Get views
	foreach ($views as $view)
	{
		$url = 'http://direct.bionames.org:5984/' . $database . '/_design/' . $view;
		$resp = get($url);
	
		file_put_contents($db_dir . '/' . $view . '.js', $resp);
	}
}
		


?>