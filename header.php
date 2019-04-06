<?php
/*  BanManagement � 2012, a web interface for the Bukkit plugin BanManager
    by James Mortemore of http://www.frostcast.net
	is licenced under a Creative Commons
	Attribution-NonCommercial-ShareAlike 2.0 UK: England & Wales.
	Permissions beyond the scope of this licence 
	may be available at http://creativecommons.org/licenses/by-nc-sa/2.0/uk/.
	Additional licence terms at https://raw.github.com/confuser/Ban-Management/master/banmanagement/licence.txt
*/
$nav = array(
	'首页' => 'index.php',
	'服务器列表' => 'index.php?action=servers',
	'个人设置' =>  'index.php?action=PersonalSettings',
);
if(isset($_SESSION['admin']) && $_SESSION['admin']) {
	$nav['管理中心'] = 'index.php?action=admin';
	$nav['登出'] = 'index.php?action=logout';
} else {
  $nav['登录后台']='index.php?action=admin';
}


$path = $_SERVER['HTTP_HOST'].str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
// about title
if(empty($settings['website_title']))
	$settings['website_title'] = 'Ban Management | 玩家封禁系统';
if(empty($settings['header_icon']))
	$settings['header_icon'] ="img\header.ico"
?>
<!DOCTYPE html>
<html lang="zh-cn">
	<head>
		<meta charset="utf-8">
		<link rel="icon" href="<?php echo $settings['header_icon']; ?>" type="image/x-icon"/>
		<title><?php echo $settings['website_title']; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Le styles -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.min.css" rel="stylesheet">

		<link href="css/style.css" rel="stylesheet">
		
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.validate.min.js"></script>
		<script src="js/heartcode-canvasloader-min.js"></script>
		<script src="js/jquery.countdown.min.js"></script>
		<script src="js/jquery.tablesorter.min.js"></script>
		<script src="js/jquery.tablesorter.widgets.min.js"></script>
		<script src="js/jquery.tablesorter.pager.min.js"></script>
<?php
if((isset($settings['iframe_protection']) && $settings['iframe_protection']) || !isset($settings['iframe_protection'])) {
	echo '
		<script type="text/javascript">
			if (top.location != self.location) { top.location = self.location.href; }
		</script>';
}
if(isset($_SESSION['admin']) && $_SESSION['admin']) {
	echo '
		<script type="text/javascript">
			var authid = \''.sha1($settings['password']).'\';
		</script>';
	if(isset($_GET['action']) && $_GET['action'] != 'admin')
		echo '
		<script src="//'.$path.'js/bootstrap-datetimepicker.min.js"></script>
		<script src="//'.$path.'js/admin.js"></script>
';
}
		?>
		
		<script src="js/core.js"></script>
	</head>
<?php
if(empty($settings['background'])){
	?><body><?php
} else {
	?><body background="<?php echo $settings['background']; ?>" style="background-size:100% 100%;background-attachment:fixed"><?php
}
?>
	    <body style="font-family: Microsoft YaHei">
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="index.php">玩家封禁系统</a>
					<div class="nav-collapse">
						<ul class="nav">
						<?php
						$request = basename($_SERVER['REQUEST_URI']);
						foreach($nav as $name => $link) {
							?><li
							<?php
							if($request == $link)
								echo ' class="active"';
							?>><a href="<?php echo $link; ?>"><?php echo $name ?></a><?php
						}
						?>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>
		<div id="container" class="container">
