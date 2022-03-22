
<?php
$xml = simplexml_load_file('userList.xml');
 foreach($xml->children() as $child){
   echo "--".$child->getName()."--" . "<br />";
   foreach($child->children() as $subchild)
   {
      echo $subchild->getName() . ": " . $subchild . "<br />";
   }
   echo "</br>";
 }
?>

<?php
$aUser = $xml->addChild('USER');
$aUser->addChild('NAME', 'Sanaulla');
$aUser->addChild('EMAIL', 'sanaulla@tspbd.com');
$aUser->addChild('PASSWD', 'sana123');
file_put_contents('userList.xml', $xml->asXML());
?>

