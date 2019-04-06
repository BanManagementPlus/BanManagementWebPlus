<?php
/*  BanManagement � 2012, a web interface for the Bukkit plugin BanManager
    by James Mortemore of http://www.frostcast.net
	is licenced under a Creative Commons
	Attribution-NonCommercial-ShareAlike 2.0 UK: England & Wales.
	Permissions beyond the scope of this licence 
	may be available at http://creativecommons.org/licenses/by-nc-sa/2.0/uk/.
	Additional licence terms at https://raw.github.com/confuser/Ban-Management/master/banmanagement/licence.txt
*/
if($settings['password'] == '')
	errors('您没有输入管理员密码，请输入密码！');
else if(isset($_SESSION['failed_attempts']) && $_SESSION['failed_attempts'] > 4) {
	die('您没有设置密码或您的密码不正确，请稍后在尝试！');
	if($_SESSION['failed_attempt'] < time())
		unset($_SESSION['failed_attempts']);
} else if(!isset($_SESSION['admin']) && !isset($_POST['password'])) {
	?><form action="" method="post" class="well form-inline">
    <input type="password" class="input-xlarge" name="password" placeholder="请输入密码">
    <button type="submit" class="btn"><?php echo $language['login']; ?></button>
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
		if(empty($settings['language']) || ($settings['language'] == 'en')){
			echo '<tr id="noservers"><td colspan="2">No Servers Defined</td></tr>';
		} elseif($settings['language'] == 'zh-hans') {
			echo '<tr id="noservers"><td colspan="2">列表中没有服务器</td></tr>';
		}
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
	if(empty($settings['language']) || ($settings['language'] == 'en')){
		if(!is_writable('settings.php')) {
			echo '<a class="btn btn-primary btn-large disabled" href="#addserver" title="Settings file not writable">Add Server</a>';
		} else{
			echo '<a class="btn btn-primary btn-large" href="#addserver" data-toggle="modal">Add Server</a>';
		}
	} else if($settings['language'] == 'zh-hans'){
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

<?php // -------------------------------------------------------------------------   ?>
	<?php
	if(!is_writable('settings.php')) {
		echo '
				<tr>
					<td colspan="2">settings.php can not be written to</td>
				</tr>';
	} else {
		echo '
				<tr>
					<td>iFrame 保护（推荐开启）</td>
					<td><input type="hidden" name="type" value="mainsettings" /><input type="checkbox" name="iframe"'.((isset($settings['iframe_protection']) && $settings['iframe_protection']) || !isset($settings['iframe_protection']) ? ' checked="checked"' : '').' /></td>
				</tr>
				<tr>
					<td>UTF8</td>
					<td><input type="checkbox" name="utf8"'.(isset($settings['utf8']) && $settings['utf8'] ? ' checked="checked"' : '').' /></td>
				</tr>
				<tr>
					<td>页脚版权</td>
					<td><input type="text" name="footer" value="'.$settings['footer'].'" /></td>
				</tr>
				<tr>
					<td>最新封禁</td>
					<td><input type="checkbox" name="latestbans"'.((isset($settings['latest_bans']) && $settings['latest_bans']) || !isset($settings['latest_bans']) ? ' checked="checked"' : '').' /></td>
				</tr>
				<tr>
					<td>最新禁言</td>
					<td><input type="checkbox" name="latestmutes"'.(isset($settings['latest_mutes']) && $settings['latest_mutes'] ? ' checked="checked"' : '').' /></td>
				</tr>
				<tr>
					<td>最新警告</td>
					<td><input type="checkbox" name="latestwarnings"'.(isset($settings['latest_warnings']) && $settings['latest_warnings'] ? ' checked="checked"' : '').' /></td>
				</tr>
				<tr>
					<td>网页按钮前缀</td>
					<td><input type="text" name="buttons_before" value="'.(isset($settings['submit_buttons_before_html']) ? $settings['submit_buttons_before_html'] : '').'" /></td>
				</tr>
				<tr>
					<td>网页按钮后缀</td>
					<td><input type="text" name="buttons_after" value="'.(isset($settings['submit_buttons_after_html']) ? $settings['submit_buttons_after_html'] : '').'" /></td>
				</tr>';
	} ?>
	
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2">
	<?php
	if(!is_writable('settings.php')) {
		echo '<input type="submit" class="btn btn-primary btn-large disabled" disabled="disabled" value="保存" />';
	} else {
		echo '<input type="submit" class="btn btn-primary btn-large" value="保存" />';
	} ?>
			
					</td>
				</tr>
			</tfoot>
		</table>
	</form>
	<br />
	<br />
	<h3>用户查询设置</h3>
	<form class="form-horizontal settings" action="" method="post">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>可见选项</th>
					<th>设定</th>
				</tr>
			</thead>
			<tbody>
	<?php
	if(!is_writable('settings.php')) {
		echo '
				<tr>
					<td colspan="2">settings.php can not be written to</td>
				</tr>';
	} else {
		echo '
				<tr>
					<td>最新封禁记录</td>
					<td><input type="hidden" name="type" value="viewplayer" /><input type="checkbox" name="ban"'.((isset($settings['player_current_ban']) && $settings['player_current_ban']) || !isset($settings['player_current_ban']) ? ' checked="checked"' : '').' /></td>
				</tr>
				<tr>
					<td>最新封禁网页额外内容</td>
					<td><input type="input" name="banextra"'.(isset($settings['player_current_ban_extra_html']) ? ' value="'.$settings['player_current_ban_extra_html'].'"' : '').' /></td>
				</tr>
				<tr>
					<td>最新禁言记录</td>
					<td><input type="checkbox" name="mute"'.((isset($settings['player_current_mute']) && $settings['player_current_mute']) || !isset($settings['player_current_mute']) ? ' checked="checked"' : '').' /></td>
				</tr>
				<tr>
					<td>最新禁言网页额外内容</td>
					<td><input type="input" name="muteextra"'.(isset($settings['player_current_mute_extra_html']) ? ' value="'.$settings['player_current_mute_extra_html'].'"' : '').' /></td>
				</tr>
				<tr>
					<td>以前的封禁记录</td>
					<td><input type="checkbox" name="prevbans"'.((isset($settings['player_previous_bans']) && $settings['player_previous_bans']) || !isset($settings['player_previous_bans']) ? ' checked="checked"' : '').' /></td>
				</tr>
				<tr>
					<td>以前的禁言记录</td>
					<td><input type="checkbox" name="prevmutes"'.((isset($settings['player_previous_mutes']) && $settings['player_previous_mutes']) || !isset($settings['player_previous_mutes']) ? ' checked="checked"' : '').' /></td>
				</tr>
				<tr>
					<td>警告记录</td>
					<td><input type="checkbox" name="warnings"'.((isset($settings['player_warnings']) && $settings['player_warnings']) || !isset($settings['player_warnings']) ? ' checked="checked"' : '').' /></td>
				</tr>
				<tr>
					<td>踢出记录</td>
					<td><input type="checkbox" name="kicks"'.((isset($settings['player_kicks']) && $settings['player_kicks']) || !isset($settings['player_kicks']) ? ' checked="checked"' : '').' /></td>
				</tr>';
	} ?>
	
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2">
	<?php
	if(!is_writable('settings.php')) {
		echo '<input type="submit" class="btn btn-primary btn-large disabled" disabled="disabled" value="保存" />';
	} else {
		echo '<input type="submit" class="btn btn-primary btn-large" value="保存" />';
	} ?>
			
					</td>
				</tr>
			</tfoot>
		</table>
	</form>
	<br />
	<br />
	<h3>其它事务</h3>
	<a href="index.php?action=deletecache&authid=<?php echo sha1($settings['password']); ?>" class="btn btn-primary">清理缓存</a>
	<br />
	<br />
	<br />
	<h3>网站状态</h3>
	<form class="form-horizontal settings" action="" method="post">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>项目</th>
					<th>状态</th>
				</tr>
			</thead>
			<tbody>	
				<tr>
					<td>PHP版本</td>
					<td><?php echo phpversion();?></td>
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