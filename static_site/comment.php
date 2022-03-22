<?php
if(!isset($_POST['signupName']))
fullPage();
else if(isset($_POST['signupName'])){
$name = $_POST['signupName'];
$email = $_POST['signupEmail'];
$passwd = $_POST['signupPasswd'];
$repasswd = $_POST['signupRepasswd'];
$xml = simplexml_load_file('include/userList.xml');
$aUser = $xml->addChild('USER');
$aUser->addChild('NAME', $name);
$aUser->addChild('EMAIL', $email);
$aUser->addChild('PASSWD', $passwd);
$aUser->addChild('COMMENT', 'So Bad it is to see passwd');
file_put_contents('userList.xml', $xml->asXML());
fullPage();
}
else
echo "sss";
function fullPage(){
?>
<html>
<head>
<script type="text/javascript" src="graphene_data/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#isLogin").click(function(){
$( "#comment" ).load( 'login.php' )
	});
	$("#isSignup").click(function(){
$( "#comment" ).load( 'signup.php' )
	});
});
</script>
<style type="text/css">
body {
    background-color:#9ACD32;
}
#isLogin,#isSignup{
//background-color:#9ACD32;
width:125px;
height:30px;
}
#comment{
background-image:url('img/badckground.jpg');
width:960px;
height:660px;
margin:20px auto;
padding:20px;
overflow:scroll;
}
.span{
    font-weight:bold;
    width:140px;
    display: block;
    float: left;
}
h1,h2,h3
{
color:green;
text-align:center;
}
</style>
</head>
<body>
<div id="comment">
<h2>Comment</h2>
<font size="4" face="verdana"><u>Previous comments:</u></font>
<?php
include_once('include/getName.php');
$xml = simplexml_load_file('include/commentList.xml');
 foreach($xml->children() as $child){
   $user = array();
   foreach($child->children() as $subchild)
   {
      $user[] = $subchild;
   }
?>
<div style="margin:5px;font-style:italic;font-weight:bold;color:#3399ff;"><img src="img/user.png" alt="user" /><?php echo $users[trim($user[0])]; ?></div>
<textarea readonly="true" rows="3" cols="125"><?php echo $user[1]; ?>
</textarea>
<hr align="left" noshade="noshade" width="95%" />
<?php
 }
?>
<h4>Have you any Comments:</h4>
<form name="" method="POST" enctype="application/x-www-form-urlencoded">
<textarea name="comment" rows="3" cols="100" DISABLED></textarea>
<input style="color:sienna;margin-left:665px" type="submit" value="Post" DISABLED />
</form>
<div style="font-weight:bold;font-size:17px;margin:0px 30px 20px;">To comment, Please <span style="word-spacing:2em;">..... </span>
<button  id="isLogin"> Log In </button> &ensp; OR, &nbsp;&nbsp;
<button id="isSignup"> Sign Up </button></div>
</div>
</body>
</html>
<?php
}
?>
