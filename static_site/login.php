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
#login{
background-image:url('img/login.JPG');
width:370px;
height:70px;
margin:20px auto;
padding:75px 15px;
font-style:bold;
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

<div id="login">
<form action="signup.php" method="POST" enctype="application/x-www-form-urlencoded">
<span class="span">Email Address : </span>
<input type="text"  size="15" name="loginEmail" /><br /><br />
<span class="span">Password : </span>
<input type="password"  size="15"  name="loginPasswd" /><br /><br />
<input style="color:sienna;margin-left:120px" src="img/loginButton.PNG" type="image" />
</form></div>

</body>
</html>
