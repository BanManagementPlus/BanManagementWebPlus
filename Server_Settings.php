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
		if(!is_writable('settings.php')) {
			echo $language_admin_page['add_server_one'];
		} else{
			echo $language_admin_page['add_server_two'];
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