<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <style>
        body{ text-align:center}
        #div{position: absolute;width:400px;height:200px;left:50%;top:50%;
                 margin-left:-200px;margin-top:-100px;}
    </style>
</head>
<body>
<div id="div">
    <h1>登录</h1>
    <a href="<?php echo U('Home/HomePage/homePage');?>">回到主页</a>
    <br>
    <br>
    <br>
    <form action="<?php echo U('Home/LoginRegister/login');?>" name="form_login" id="form_login" method="post">
        <input type="text" name="user_name" id="user_name" placeholder="请输入用户名"><br>
        <input type="password" name="user_password" id="user_password" placeholder="请输入密码"><br>
        <button type="submit" name="user_submit" id="user_submit" onclick="">登录</button>
    </form>
    <br>
    <br>
    <br>
    <a href="<?php echo U('Home/LoginRegister/inputUser');?>">找回密码</a>
</div>
</body>
</html>