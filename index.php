<?php

require_once 'src/SubdomainRow.php';
require_once 'src/Subdomains.php';
require_once 'src/CookieKey.php';
require_once 'src/KeyValuePair.php';
require_once 'src/KeyValuePairCollection.php';



if ($argc == 2) {    
    $path_to_xml_file = $argv[1];
    $print_keys = false;
}
elseif ($argc == 3) {
    $path_to_xml_file = $argv[2];
    $print_keys = true;
    $keys_to_print = [];
}



//try {
    $xml = simplexml_load_file($path_to_xml_file);
    //$xml = new SimpleXMLElement($argv[1], LIBXML_NOERROR);
/*}
catch (Exception $e) {
   echo 'Exception message: ' . $e->getMessage();   
}*/
/*if ($xml === false) {
    foreach(libxml_get_errors() as $error) {
        echo "\t", $error->message;
    }
}*/

$subdomainsFromXML = $xml->subdomains;
$cookiesFromXML = $xml->cookies;

$keyValuePairCollection = new KeyValuePairCollection();


if (count($subdomainsFromXML->children()) > 0) {

    $subdomains = new Subdomains();

    foreach($subdomainsFromXML->children() as $subdomain) {    
        $subdomainRow = new SubdomainRow((string) $subdomain);
        $subdomains->addSubdomain($subdomainRow);
    }

    $keyValuePair = new KeyValuePair('subdomains', $subdomains->getSubdomains());
    $keyValuePairCollection->addKeyValuePair($keyValuePair);

}

foreach ($cookiesFromXML->children() as $cookie) {
    
    $cookieKey = new CookieKey($cookie['name'], $cookie['host']);
    $keyValuePair = new KeyValuePair($cookieKey->getCookieKey(), (string) $cookie);
    $keyValuePairCollection->addKeyValuePair($keyValuePair);
    
}



if ($print_keys) {

    foreach ($keyValuePairCollection->getKeyValuePairCollection() as $keyValuePair) {
        echo $keyValuePair->getKey() . "\n";
    }

}



$redis = new Redis();
$redis->connect('localhost', 6379);
foreach ($keyValuePairCollection->getKeyValuePairCollection() as $keyValuePair) {
    $redis->set($keyValuePair->getKey(), $keyValuePair->getValue());
}















