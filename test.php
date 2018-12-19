
<?php

$jsondata = file_get_contents('cve.json');
$null = 'null';
$json = json_decode($jsondata,true);
$header = 1;
$output = "<channel>";


foreach($json['testjson'] as $testjson){
    while ($header <=1){
        $output.="<title>".'RSS Title'."</title>";
        $output.="<description>".'This is an example of an RSS feed'."</description>";
        $output.="<link><a href>".'http://www.example.com/main.html'."</a></link>";
        $output.="<lastBuildDate>".'Mon, 06 Sep 2010 00:01:00 +0000 '."</lastBuildDate>";
        $output.="<pubDate>".'Sun, 06 Sep 2009 16:20:00 +0000'."</pubDate>";
        $output.="<ttl>".'1800'."</ttl>";
        $header++;
    }
    $output.="<item>";
    $output.="<title>".$testjson['CVE']."</title>";
    $output.="<li>".$testjson['severity']."</li>";
    $output.="<pubDate>".$testjson['public_date']."</pubDate>";
    $output.="<guid>".$testjson['bugzilla']."</guid>";
    $output.="<description>".$testjson['bugzilla_description']."</description>";

    if($testjson['cvss_score']='null'){
       $output.= "<li>".$null."</li>";}
    else{$output.="<li>".$testjson['cvss_score']."</li>";
}

if($testjson['cvss_scoring_vector']='null'){
    $output.= "<li>".$null."</li>";}
 else{$output.="<li>".$testjson['cvss_scoring_vector']."</li>";
}


    $output.="<li>".$testjson['CWE']."</li>";
    $output.="<li>".$testjson['affected_packages'][0]."</li>";
    $output.="<li><a href>".$testjson['resource_url']."</a></li>";
    $output.="<li>".$testjson['cvss3_score']."</li>";
    $output.="</item>";
}
$output.="</channel>";


echo $output;

?>

