<?php

spl_autoload_register(function($className) {
    require_once "src/$className.php";
});


if ($argc == 2) {    
    $pathToXMLFile = $argv[1];
    $printKeys = false;
}
elseif ($argc == 3) {
    $pathToXMLFile = $argv[2];
    $printKeys = true;
}


$xml = simplexml_load_file($pathToXMLFile);

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



if ($printKeys) {

    foreach ($keyValuePairCollection->getKeyValuePairCollection() as $keyValuePair) {
        echo $keyValuePair->getKey() . "\n";
    }

}



$redis = new Redis();
$redis->connect('localhost', 6379);
foreach ($keyValuePairCollection->getKeyValuePairCollection() as $keyValuePair) {
    $redis->set($keyValuePair->getKey(), $keyValuePair->getValue());
}







