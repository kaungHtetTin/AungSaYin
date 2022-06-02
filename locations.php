<?php
require 'vendor/autoload.php';

$link=$_GET['link'];

$url="https://2017.myanmarexam.org/".$link;


$httpClient = new \GuzzleHttp\Client();
$response = $httpClient->get($url);
$htmlString = (string) $response->getBody();

//add this line to suppress any warnings
libxml_use_internal_errors(true);
$doc = new DOMDocument();
$doc->loadHTML($htmlString);
$xpath = new DOMXPath($doc);


$trs=$xpath->evaluate('//table[@id="tb"]//tr');

for($i=1;$i<count($trs);$i++){
    $tr=$trs[$i];

    $tds=$tr->childNodes;

    
    $result[$i-1]['sitting_plan']=$tds[2]->textContent;
    $result[$i-1]['location']=$tds[3]->textContent;

    $td=$tds[4];

    $result[$i-1]['download_url']=$td->firstElementChild->attributes[0]->textContent;
}

echo json_encode($result);
?>