<?php
/*  BanManagement � 2012, a web interface for the Bukkit plugin BanManager
    by James Mortemore of http://www.frostcast.net
	is licenced under a Creative Commons
	Attribution-NonCommercial-ShareAlike 2.0 UK: England & Wales.
	Permissions beyond the scope of this licence 
	may be available at http://creativecommons.org/licenses/by-nc-sa/2.0/uk/.
	Additional licence terms at https://raw.github.com/confuser/Ban-Management/master/banmanagement/licence.txt
*/
if(empty($settings['password']))
	errors('您没有输入管理员密码，请输入密码！');
else if(isset($_SESSION['failed_attempts']) && $_SESSION['failed_attempts'] > 4) {
	die('您没有设置密码或您的密码不正确，请稍后在尝试！');
	if($_SESSION['failed_attempt'] < time())
		unset($_SESSION['failed_attempts']);
} else if(!isset($_SESSION['admin']) && !isset($_POST['password'])) {
	?><form action="" method="post" class="well form-inline">
    <input type="password" class="input-xlarge" name="password" placeholder="<?php echo $language['Please_enter_your_password']; ?>">
    <button type="submit" class="btn"><?php echo $language['Sign_In']; ?></button>
    </form><?php
} else if(isset($_POST['password']) && !isset($_SESSION['admin'])) {
	if(htmlspecialchars_decode($_POST['password'], ENT_QUOTES) != $settings['password']) {
		//set how long we want them to have to wait after 5 wrong attempts
		$time = 1800; //make them wait 30 mins
		if(isset($_SESSION['failed_attempts']))
			++$_SESSION['failed_attempts']; 
		else
			$_SESSION['failed_attempts'] = 1;
		$_SESSION['failed_attempt'] = time() + $time;
		redirect('index.php?action=admin');
	} else {
		$_SESSION['admin'] = true;
		redirect('index.php?action=admin');
	}
} else if(isset($_SESSION['admin']) && $_SESSION['admin']) {
	?>
	<table class="table table-striped table-bordered" id="servers">
		<thead>
			<tr>
				<th><?php echo $language['Server_Name']; ?></th>
				<th><?php echo $language['Options']; ?></th>
			</tr>
		</thead>
		<tbody><?php
	if(empty($settings['servers']))
		echo $language_admin_page['No_Servers_Defined'];
	else {
		$id = array_keys($settings['servers']);
		$i = 0;
		$count = count($settings['servers']) - 1;
		
		foreach($settings['servers'] as $server) {
			echo '
				<tr>
					<td>'.$server['name'].'</td>
					<td>
						<a href="#" class="btn btn-danger deleteServer" data-serverid="'.$id[$i].'"><i class="icon-trash icon-white"></i></a>';
			if($count > 0) {
				if($i == 0)
					echo '
					<a href="#" class="btn reorderServer" data-order="down" data-serverid="'.$id[$i].'"><i class="icon-arrow-down"></i></a>';
				else if($i == $count)
					echo '
					<a href="#" class="btn reorderServer" data-order="up" data-serverid="'.$id[$i].'"><i class="icon-arrow-up"></i></a>';
				else {
					echo '
					<a href="#" class="btn reorderServer" data-order="up" data-serverid="'.$id[$i].'"><i class="icon-arrow-up"></i></a>
					<a href="#" class="btn reorderServer" data-order="down" data-serverid="'.$id[$i].'"><i class="icon-arrow-down"></i></a>';
				}
			}
			echo '
					</td>
				</tr>';
			++$i;
		}
	}
		?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="2">
		<?php
	if(empty($settings['Default_language']) || ($settings['Default_language'] == 'en')){
		if(!is_writable('settings.php')) {
			echo '<a class="btn btn-primary btn-large disabled" href="#addserver" title="Settings file not writable">Add Server</a>';
		} else{
			echo '<a class="btn btn-primary btn-large" href="#addserver" data-toggle="modal">Add Server</a>';
		}
	} else if($settings['Default_language'] == 'zh-hans'){
		if(!is_writable('settings.php')) {
			echo '<a class="btn btn-primary btn-large disabled" href="#addserver" title="Settings file not writable">添加服务器</a>';
		} else{
			echo '<a class="btn btn-primary btn-large" href="#addserver" data-toggle="modal">添加服务器</a>';
		}
	}

	?>
	
				</td>
			</tr>
		</tfoot>
	</table>
	<div class="modal hide fade" id="addserver">
		<form class="form-horizontal" action="" method="post">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3><?php echo $language['Add_Server']; ?></h3>
			</div>
			<div class="modal-body">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="servername"><?php echo $language['Server_Name']; ?>:</label>
						<div class="controls">
							<input type="text" class="input-xlarge required" name="servername" id="servername">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="host"><?php echo $language['MySQL_Host']; ?>：</label>
						<div class="controls">
							<input type="text" class="input-xlarge required" name="host" id="host">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="database"><?php echo $language['MySQL_Database']; ?>：</label>
						<div class="controls">
							<input type="text" class="input-xlarge required" name="database" id="database">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="username"><?php echo $language['MySQL_Username']; ?>:</label>
						<div class="controls">
							<input type="text" class="input-xlarge required" name="username" id="usernme">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="password"><?php echo $language['MySQL_Password']; ?>:</label>
						<div class="controls">
							<input type="password" class="input-xlarge" name="password" id="password">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="banstable"><?php echo $language['Bans_Table']; ?>：</label>
						<div class="controls">
							<input type="text" class="input-xlarge required" name="banstable" id="banstable" value="bm_bans">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="recordtable"><?php echo $language['Bans_Record_Table']; ?>：</label>
						<div class="controls">
							<input type="text" class="input-xlarge required" name="recordtable" id="recordtable" value="bm_ban_records">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="iptable"><?php echo $language['IP_Bans_Table']; ?>：</label>
						<div class="controls">
							<input type="text" class="input-xlarge required" name="iptable" id="iptable" value="bm_ip_bans">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="iprecordtable"><?php echo $language['IP_Record_Table']; ?>：</label>
						<div class="controls">
							<input type="text" class="input-xlarge required" name="iprecordtable" id="iprecordtable" value="bm_ip_records">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="mutestable"><?php echo $language['Mutes_Table']; ?>:</label>
						<div class="controls">
							<input type="text" class="input-xlarge required" name="mutestable" id="mutestable" value="bm_mutes">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="mutesrecordtable"><?php echo $language['Mutes_Record_Table']; ?>：</label>
						<div class="controls">
							<input type="text" class="input-xlarge required" name="mutesrecordtable" id="mutesrecordtable" value="bm_mutes_records">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="kickstable"><?php echo $language['Kicks_Table']; ?>：</label>
						<div class="controls">
							<input type="text" class="input-xlarge required" name="kickstable" id="kickstable" value="bm_kicks">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="warningstable"><?php echo $language['Warnings_Table']; ?>：</label>
						<div class="controls">
							<input type="text" class="input-xlarge required" name="warningstable" id="warningstable" value="bm_warnings">
						</div>
					</div>
				</fieldset>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal"><?php echo $language['Close']; ?></a>
				<input type="submit" class="btn btn-primary" value="<?php echo $language['Save']; ?>" />
			</div>
		</form>
	</div>
	<br />
	<br />
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
					<td><?php echo $language['Clear_Cache']; ?></td>
					<td><a href="clearcache.php" class="btn btn-primary"><?php echo $language['start']; ?></a></td>
				</tr>
			</tbody>
		</table>
	</form>
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
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2">
			</tfoot>
		</table>
	</form>
<?php
}
?>
<script src="//<?php echo $path; ?>js/admin.js"></script>