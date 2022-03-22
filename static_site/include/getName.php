<?php
$axml = simplexml_load_file('include/userList.xml');
$users = array();
foreach($axml->children() as $child){
  $auser = array();
  foreach($child->children() as $subchild)
  {
       $auser[] = $subchild;
  }
  $users[trim($auser[1])] = $auser[0];
}
?>
