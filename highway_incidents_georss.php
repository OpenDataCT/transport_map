<?php 
2 header( 'Expires: -1' ); 
3 header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );  
4 header( 'Cache-Control: no-store, no-cache, must-revalidate' );  
5 header( 'Cache-Control: post-check=0, pre-check=0', false );  
6 header( 'Pragma: no-cache' ); 
7  
8  // create doctype 
9 $dom = new DOMDocument("1.0"); 
10 // save and display tree 
11 header('Content-Type: application/rss+xml; charset=utf-8'); 
12 echo $dom->saveXML(); 
13  ?> 
14 <rss version="2.0" xmlns:georss="http://www.georss.org/georss" > 
15 <channel> 
16 <title>CT Roadway Events</title> 
17 <description></description> 
18 <link></link> 
19 
 
20  <?php 
21 function xml_attribute($object, $attribute) 
22 { 
23     if(isset($object[$attribute])) 
24         return (string) $object[$attribute]; 
25 } 
26  
27 function xml_character_encode($string, $trans='') { 
28   $trans = (is_array($trans)) ? $trans : get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);  
29   foreach ($trans as $k=>$v)  
30     $trans[$k]= "&#".ord($k).";";  
31  
32   return strtr($string, $trans); 
33 } 
34  
35 $xml = simplexml_load_file('http://www.dotdata.ct.gov/iti/Data/CurrentActiveEvents.xml'); 
36  foreach ($xml->event as $item) { 
37  
38  
39    $cause=xml_attribute($item, 'cause'); 
40    $description=xml_attribute($item, 'description'); 
41    $lat=xml_attribute($item, 'lat'); 
42    $long=xml_attribute($item, 'long'); 
43  
44  
45  
46    $description = xml_character_encode($description); 
47  
48  
49  
50    echo "<item><title>".$cause."</title>\n<description>".$description."</description>\n<georss:point>".$lat." ".$long."</georss:point>\n</item>\n"; 
51    } 
52  
53  
54   echo "</channel>\n"; 
55 echo "</rss>"; 
56 ?> 
