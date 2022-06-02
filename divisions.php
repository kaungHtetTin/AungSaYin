<?php
require 'vendor/autoload.php';

$url="https://2017.myanmarexam.org";


$httpClient = new \GuzzleHttp\Client();
$response = $httpClient->get($url);
$htmlString = (string) $response->getBody();

//add this line to suppress any warnings
libxml_use_internal_errors(true);
$doc = new DOMDocument();
$doc->loadHTML($htmlString);
$xpath = new DOMXPath($doc);

$tds=$xpath->evaluate('//div[@class="container"]//table//td//a');

for($i=0;$i<count($tds);$i++){
    $td=$tds[$i];
    $result[$i]['link']=$td->attributes[0]->textContent;
    $result[$i]['title']=$td->nodeValue;
}

echo json_encode($result);

    echo"<pre>";
    print_r($result);
    echo "</pre>";


?>