<?php
if(empty($settings['Default_language']) || ($settings['Default_language'] == 'en')){
	include('data\language\Basic_data\Default.php');
	include('data\language\long_data\Default\admin_page.php');
	include('data\language\long_data\Default\home_page.php');
} elseif($settings['Default_language'] == 'zh' || $settings['Default_language'] == 'zh-cn' || $settings['Default_language'] == 'zh-Hans' || $settings['Default_language'] == 'zh-hans' || $settings['Default_language'] == 'zh-CN') {
	include('data\language\Basic_data\zh-CN.php');
	include('data\language\long_data\zh-CN\admin_page.php');
	include('data\language\long_data\zh-CN\home-page.php');
	$footer_Xiao_Fang_He = 'true';
}
?>