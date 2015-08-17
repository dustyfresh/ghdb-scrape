<?php
require_once 'simple_html_dom.php';
foreach(glob('./*.html') as $fileName){
        $id = preg_replace('/.html/', '', $fileName);
        $id = preg_replace('/.\//', '', $id);
	print "Processing $id...";
	$html = file_get_html($fileName);
	$description = preg_replace('/Google dork Description: /', '', trim($html->find('div.l-main', 0)->find('table', 0)->find('tr', 0)->find('td', 0)->plaintext));
	$search = preg_replace('/Google search: /', '', trim($html->find('div.l-main', 0)->find('table', 0)->find('tr', 1)->plaintext));
	$submitted = preg_replace('/Submited: /', '', trim($html->find('div.l-main', 0)->find('table', 0)->find('tr', 2)->plaintext));
	$info = trim($html->find('div.l-main', 0)->find('table', 0)->find('tr', 3)->plaintext);
        $dorkData = array($id => array(
                        'description' => $description,
                        'search' => $search,
                        'submitted' => $submitted,
                        'info' => $info));
	$m = new MongoClient();
	$db = $m->ghdb;
	$collection = $db->entries;
	$collection->insert($dorkData);
	print "OK!\n";
}
