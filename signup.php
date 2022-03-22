<?php
if(!isset($_POST['signupName']))
registerPage();
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
//$aUser->addChild('COMMENT', 'So Bad it is to see passwd');
file_put_contents('include/userList.xml', $xml->asXML());
//registerPage();
//window.location = "index.html";
//window.open('index.html');
}
else
echo "sss";
function registerPage(){
?>
<html>
<head>
<style>
body
{
background-color:#9ACD32;
}
h1,h2
{
color:green;
text-align:center;
}

#signup{
background-image:url('img/signup.jpg');
//border: 5px solid #7CFC00;
//background-color:#9ACD32;
width:370px;
height:160px;
margin:20px auto;
padding:75px 15px;
font-style:bold;
background-repeat:repeat-x;
}
.span{
    font-weight:bold;
    width:170px;
    display: block;
    float: left;
}
</style>
</head>

<body>

<div id="signup">
<form name="" method="POST" action="signup.php" enctype="application/x-www-form-urlencoded">
<span class="span">User name : </span>
<input type="text" size="15" name="signupName" /><br /><br />
<span class="span">Email Address : </span>
<input type="text" size="15"  name="signupEmail" /><br /><br />
<span class="span">Password : </span>
<input type="password" size="15"  name="signupPasswd" /><br /><br />
<span class="span">Re-type Password : </span>
<input type="password" size="15"  name="signupRepasswd" /><br /><br />
<input style="color:sienna;margin-left:120px" src="img/signupButton.PNG" type="image" />
</form>
</div>

</body>
</html>
<?php
}
?>
