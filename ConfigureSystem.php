<a href="index.php?action=Manage_website"><?php echo $language['back']; ?></a>
<?php
/*  BanManagement � 2012, a web interface for the Bukkit plugin BanManager
    by James Mortemore of http://www.frostcast.net
	is licenced under a Creative Commons
	Attribution-NonCommercial-ShareAlike 2.0 UK: England & Wales.
	Permissions beyond the scope of this licence 
	may be available at http://creativecommons.org/licenses/by-nc-sa/2.0/uk/.
	Additional licence terms at https://raw.github.com/confuser/Ban-Management/master/banmanagement/licence.txt
*/
if(isset($_SESSION['admin']) && $_SESSION['admin']) {
	?>
	<h3><?php echo $language['Homepage_Settings']; ?> <small><?php echo $language['You_may_find_more_settings_in_settings_php']; ?></small></h3>
	<form class="form-horizontal settings" action="" method="post">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th><?php echo $language['Options']; ?></th>
					<th><?php echo $language['Value']; ?></th>
				</tr>
			</thead>
			<tbody>

	<?php
	if(!is_writable('settings.php')) {
		echo $language_admin_page['one_is_writable_Homepage_Settings'];
	} else {
		echo $language_admin_page['one_is_writable_Homepage_Settings'];
	} ?>
	
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2">
	<?php
	if(!is_writable('settings.php')) {
		echo $language_admin_page['one_is_writable_save'];
	} else {
		echo $language_admin_page['two_is_writable_save'];
	} ?>
			
					</td>
				</tr>
			</tfoot>
		</table>
	</form>
	<br />
	<br />
	<h3><?php echo$language['View_Player_Settings']; ?></h3>
	<form class="form-horizontal settings" action="" method="post">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th><?php echo $language['Visible_Options']; ?></th>
					<th><?php echo $language['Value']; ?></th>
				</tr>
			</thead>
			<tbody>
	<?php
	if(!is_writable('settings.php')) {
		echo $language_admin_page['settings_file_can_not_be_written_to'];
	} else {
		echo $language_admin_page['two_is_writable_Homepage_Settings'];
	} ?>
	
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2">
	<?php
	if(!is_writable('settings.php')) {
		echo $language_admin_page['settings_file_can_not_be_written_to'];
	} else {
		echo $language_admin_page['two_is_writable_save'];
	} ?>
			
					</td>
				</tr>
			</tfoot>
		</table>
	</form>
	<br />
	<br />
	<h3><?php echo $language['other_matters']; ?></h3>
	<form class="form-horizontal settings" action="" method="post">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th><?php echo $language['project']; ?></th>
					<th><?php echo $language['Button']; ?></th>
				</tr>
			</thead>
			<tbody>	
				<tr>
					<td><?php echo $language['Refresh_Buffer']; ?></td>
					<td><a href="index.php?action=plugin/refreshbuffer" class="btn btn-primary"><?php echo $language['start']; ?></a></td>
				</tr>
				<tr>
					<td><?php echo $language['Clear_Cache']; ?></td>
					<td><a href="index.php?action=plugin/clearcache" class="btn btn-primary"><?php echo $language['start']; ?></a></td>
			</tbody>
		</table>
	<br />
	<br />
	<br />
	<h3><?php echo $language['Website_statu']; ?></h3>
	<form class="form-horizontal settings" action="" method="post">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th><?php echo $language['project']; ?></th>
					<th><?php echo $language['statu']; ?></th>
				</tr>
			</thead>
			<tbody>	
				<tr>
					<td><?php echo $language['php_version']; ?></td>
					<td><?php echo phpversion(); ?></td>
				</tr>
				<tr>
					<td><?php echo $language['website_version']; ?></td>
					<td><?php echo $language['website_version_long']; ?></td>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2">
			</tfoot>
		</table>
	</form>
<?php
} else {
	redirect('index.php?action=login');
}
?>
<script src="//<?php echo $path; ?>js/admin.js"></script>