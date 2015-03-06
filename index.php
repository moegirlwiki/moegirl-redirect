<?php
if (empty($_GET['target'])){
	header("Location:http://zh.moegirl.org/");
}

// 获取UA
$userAgent = $_SERVER['HTTP_USER_AGENT'];

//判断
$is_iOS = false;
$is_Android = false;
$is_WP = false;
$is_WeChat = false;
$is_Weibo = false;

$browser_hint = '浏览器中打开';

if (strpos($userAgent, "iPhone")||strpos($userAgent, "iPad")||strpos($userAgent, "iPod")) {
	$is_iOS = true;
	$browser_hint = 'Safari中打开';
}
if (strpos($userAgent, "Android")) {
	$is_Android = true;
}
if (strpos($userAgent, "IEMobile")){
	$is_WP = true;
}
if (strpos($userAgent, "MicroMessenger")){
	$is_WeChat = true;
	$browser_hint = '在'.$browser_hint;
}
if (strpos($userAgent, "Weibo")){
	$is_Weibo = true;
	$browser_hint = '用'.$browser_hint;
}

//处理提交字符串
$target = str_replace(array("<",">","=\"","='","eval","<!--","|","-->"),"-",htmlspecialchars($_GET['target']));


if (!($is_iOS||$is_Android)) {
//if (!($is_iOS||$is_Android||$is_WP)) {  Windows Phone 暂时不支持
	header("Location:http://zh.moegirl.org/".$target);
}else{


?>
<!DOCTYPE html>
<html>
<head>
	<title>萌娘百科 转跳页 - <?php echo $target;?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css" href="source/style.css">
</head>
<body>

<?php if ($is_WeChat || $is_Weibo) {?>
<div id="forWeChat">
<p>链接打不开？请点击右上角选择<strong><?php echo $browser_hint;?></strong>。</p>
</div>
<?php } ?>

<?php if ($is_iOS) { ?>
<!--iOS-->
<a href="moegirl://?w=<?php echo $target;?>" target="_blank">
<div id="mainbtn">
	<div class="subtitle">使用萌娘百科iOS客户端浏览</div>
	<div class="title"><?php echo $target;?></div>
</div>
</a>
<?php } ?>

<?php if ($is_Android) { ?>
<!--Android-->
<a href="moepad://view/<?php echo $target;?>" target="_blank">
<div id="mainbtn">
	<div class="subtitle">使用萌娘百科Android客户端浏览</div>
	<div class="title"><?php echo $target;?></div>
</div>
</a>
<?php } ?>

<?php if ($is_WP) { ?>
<!--WP-->
<a href="moepad://view/<?php echo $target;?>?>" target="_blank">
<div id="mainbtn">
	<div class="subtitle">使用萌娘百科WindowsPhone客户端浏览</div>
	<div class="title"><?php echo $target;?></div>
</div>
</a>
<?php } ?>

<div id="otherinfo">
<?php if ($is_iOS) { ?>
	<p><a href="https://itunes.apple.com/cn/app/meng-niang-bai-ke/id892053828" target="_blank">下载iOS客户端</a></p>
<?php } ?>
<?php if ($is_Android) { ?>
	<p><a href="http://my-h.net/moepad/moepad_a_2.0.apk" target="_blank">下载Android客户端</a></p>
<?php } ?>
<?php if ($is_WP) { ?>
	<p><a href="http://www.windowsphone.com/zh-cn/store/app/%E8%90%8C%E5%A8%98%E7%99%BE%E7%A7%91/194aa2ab-f4e3-4762-9f88-6edf23cdc50d" target="_blank">下载WindowsPhone客户端</a></p>
<?php } ?>
	<p><a href="http://m.moegirl.org/<?php echo $target;?>" target="_blank">访问手机版萌娘百科</a></p>
	<p><a href="http://zh.moegirl.org/<?php echo $target;?>" target="_blank">访问电脑版萌娘百科</a></p>
</div>
<img src="source/moegirl.gif" id="welcomeimg" />
</body>
</html> 
<?php


}
?>