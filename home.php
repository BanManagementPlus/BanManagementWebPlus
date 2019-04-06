<?php
/*  BanManagement � 2012, a web interface for the Bukkit plugin BanManager
    by James Mortemore of http://www.frostcast.net
	is licenced under a Creative Commons
	Attribution-NonCommercial-ShareAlike 2.0 UK: England & Wales.
	Permissions beyond the scope of this licence 
	may be available at http://creativecommons.org/licenses/by-nc-sa/2.0/uk/.
	Additional licence terms at https://raw.github.com/confuser/Ban-Management/master/banmanagement/licence.txt
*/

function latestBans($server, $serverID) {	
	// Clear old latest bans cache's
	clearCache($serverID.'/latestbans', 300);
	clearCache($serverID.'/mysqlTime', 300);

	$result = cache("SELECT banned, banned_by, ban_reason, ban_expires_on FROM ".$server['bansTable']." ORDER BY ban_time DESC LIMIT 5", 300, $serverID.'/latestbans', $server);

	if(isset($result[0]) && !is_array($result[0]) && !empty($result[0]))
		$result = array($result);
	$rows = count($result);

	if($rows == 0)
		echo '<li>没有记录</li>';
	else {
		$timeDiff = cache('SELECT ('.time().' - UNIX_TIMESTAMP(now()))/3600 AS mysqlTime', 5, $serverID.'/mysqlTime', $server); // Cache it for a few seconds

		$mysqlTime = $timeDiff['mysqlTime'];
		$mysqlTime = ($mysqlTime > 0)  ? floor($mysqlTime) : ceil ($mysqlTime);
		$mysqlSecs = ($mysqlTime * 60) * 60;
		foreach($result as $r) {
			$expires = ($r['ban_expires_on'] + $mysqlSecs)- time();
			echo '
					<li class="latestban"><a href="index.php?action=viewplayer&player='.$r['banned'].'&server='.$serverID.'"><img src="https://minotar.net/avatar/'.$r['banned'].'/20" alt="'.$r['banned'].'" class="minihead" /> '.$r['banned'].'</a><button class="btn btn-info" rel="popover" data-html="true" data-content="'.$r['ban_reason'].'" data-original-title="'.$r['banned_by'];
			if($r['ban_expires_on'] == 0)
				echo ' <span class=\'label label-important\'>永久</span>';
			else if($expires > 0)
				echo ' <span class=\'label label-warning\'>'.secs_to_hmini($expires).'</span>';
			else
				echo ' <span class=\'label label-success\'>现在</span>';
			echo '"><i class="icon-question-sign icon-white"></i></button></li>';
		}
	}
}

function latestMutes($server, $serverID) {	
	// Clear old latest mutes cache's
	clearCache($serverID.'/latestmutes', 300);
	clearCache($serverID.'/mysqlTime', 300);

	$result = cache("SELECT muted, muted_by, mute_reason, mute_expires_on FROM ".$server['mutesTable']." ORDER BY mute_time DESC LIMIT 5", 300, $serverID.'/latestmutes', $server);

	if(isset($result[0]) && !is_array($result[0]) && !empty($result[0]))
		$result = array($result);
	$rows = count($result);

	if($rows == 0)
		echo '<li>没有记录</li>';
	else {
		$timeDiff = cache('SELECT ('.time().' - UNIX_TIMESTAMP(now()))/3600 AS mysqlTime', 5, $serverID.'/mysqlTime', $server); // Cache it for a few seconds

		$mysqlTime = $timeDiff['mysqlTime'];
		$mysqlTime = ($mysqlTime > 0)  ? floor($mysqlTime) : ceil ($mysqlTime);
		$mysqlSecs = ($mysqlTime * 60) * 60;
		foreach($result as $r) {
			$expires = ($r['mute_expires_on'] + $mysqlSecs)- time();
			echo '<li class="latestban"><a href="index.php?action=viewplayer&player='.$r['muted'].'&server='.$serverID.'"><img src="https://minotar.net/avatar/'.$r['muted'].'/20" alt="'.$r['muted'].'" class="minihead" /> '.$r['muted'].'</a><button class="btn btn-info" rel="popover" data-html="true" data-content="'.$r['mute_reason'].'" data-original-title="'.$r['muted_by'];
			if($r['mute_expires_on'] == 0)
				echo ' <span class=\'label label-important\'>永久</span>';
			else if($expires > 0)
				echo ' <span class=\'label label-warning\'>'.secs_to_hmini($expires).'</span>';
			else
				echo ' <span class=\'label label-success\'>现在</span>';
			echo '"><i class="icon-question-sign icon-white"></i></button></li>';
		}
	}
}

function latestWarnings($server, $serverID) {		
	// Clear old latest warnings cache's
	clearCache($serverID.'/latestwarnings', 300);
	clearCache($serverID.'/mysqlTime', 300);

	$result = cache("SELECT warned, warned_by, warn_reason FROM ".$server['warningsTable']." ORDER BY warn_time DESC LIMIT 5", 300, $serverID.'/latestwarnings', $server);

	if(isset($result[0]) && !is_array($result[0]) && !empty($result[0]))
		$result = array($result);
	$rows = count($result);

	if($rows == 0)
		echo '<li>没有记录</li>';
	else {
		$timeDiff = cache('SELECT ('.time().' - UNIX_TIMESTAMP(now()))/3600 AS mysqlTime', 5, $serverID.'/mysqlTime', $server); // Cache it for a few seconds

		$mysqlTime = $timeDiff['mysqlTime'];
		$mysqlTime = ($mysqlTime > 0)  ? floor($mysqlTime) : ceil ($mysqlTime);
		$mysqlSecs = ($mysqlTime * 60) * 60;
		foreach($result as $r) {
			echo '<li class="latestban"><a href="index.php?action=viewplayer&player='.$r['warned'].'&server='.$serverID.'"><img src="https://minotar.net/avatar/'.$r['warned'].'/20" alt="'.$r['warned'].'" class="minihead" /> '.$r['warned'].'</a><button class="btn btn-info" rel="popover" data-html="true" data-content="'.$r['warn_reason'].'" data-original-title="'.$r['warned_by'].'"><i class="icon-question-sign icon-white"></i></button></li>';
		}
	}
}
?>
<div class="hero-unit">
	<h1>封禁查询</h1>
	<br />
	<form action="index.php" method="get" class="form-horizontal" id="search">
		<fieldset>
			<div class="control-group">
				<!-- <label class="control-label" for="servername">
					<div class="btn-group" id="searchtype">
						<button class="btn" id="player">玩家</button>
						<button class="btn dropdown-toggle" data-toggle="dropdown">
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li id="ip"><a href="#">IP</a></li>
						</ul>
					</div>
				</label> -->
					<div class="input-prepend">
						<div class="btn-group">
							<button id="player" class="btn dropdown-toggle" data-toggle="dropdown" type="button">
								玩家
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li id="ip"><a href="#">IP</a></li>
							</ul>
						</div>
						<input type="text" name="player" class="span4 required" placeholder="请输入玩家游戏名">
					</div>

			</div>
		<?php
		if(!empty($settings['servers']) && count($settings['servers']) > 1) {
			echo '
			<div class="control-group">
				<label class="control-label" for="servername">服务器：</label>
				<div class="controls">';
			$id = array_keys($settings['servers']);
			$i = 0;
			foreach($settings['servers'] as $server) {
				echo '
					<label class="radio">
						<input type="radio" value="'.$id[$i].'" name="server"'.($i == 0 ? ' checked="checked"' : '').' />
						'.$server['name'].'
					</label>';
				++$i;
			}
			echo '
				</div>
			</div>';
		} else if(count($settings['servers']) == 1) {
			echo '<input type="hidden" value="0" name="server" />';
		}
		?>
			<div class="form-actions"><?php
				if(isset($settings['submit_buttons_before_html']))
					echo htmlspecialchars_decode($settings['submit_buttons_before_html'], ENT_QUOTES);
				?>
				<input type="submit" class="btn btn-primary" value="<?php echo $language['Search']; ?>" />
				<input type="hidden" name="action" value="searchplayer" />
				<a href="#" class="btn" id="viewall"><?php echo $language['Display_All']; ?></a>
				<?php
				if(isset($settings['submit_buttons_after_html']))
					echo htmlspecialchars_decode($settings['submit_buttons_after_html'], ENT_QUOTES);
				?>
			</div>
		</fieldset>
    </form>
</div>
<?php
if(count($settings['servers']) > 1) {
	if((isset($settings['latest_bans']) && $settings['latest_bans']) || !isset($settings['latest_bans'])) {
?>
<h2><?php echo $language['Latest_Bans']; ?></h2>
<?php
		if(!empty($settings['servers'])) {
			echo '
	<div class="row">';
			$id = array_keys($settings['servers']);
			$i = 0;
			foreach($settings['servers'] as $server) {
				echo '
		<div class="span4">
			<h3>'.$server['name'].'</h3>
			<ul class="nav nav-tabs nav-stacked">';	
				latestBans($server, $i);
				echo '
			</ul>
		</div>';
		
				++$i;
			}
			echo '
	</div>';
		} else
			echo '<p>没有记录</p>';
}

	if((isset($settings['latest_mutes']) && $settings['latest_mutes'])) {
?>
<br />
<h2><?php echo $language['Latest_Mutes']; ?></h2>
<?php
		if(!empty($settings['servers'])) {
			echo '
	<div class="row">';
			$id = array_keys($settings['servers']);
			$i = 0;
			foreach($settings['servers'] as $server) {
				echo '
		<div class="span4">
			<h3>'.$server['name'].'</h3>
			<ul class="nav nav-tabs nav-stacked">';	
				latestMutes($server, $i);
				echo '
			</ul>
		</div>';
				
				++$i;
			}
			echo '
	</div>';
		} else
			echo '<p>没有记录</p>';
}

	if((isset($settings['latest_warnings']) && $settings['latest_warnings'])) {
?>
<br />
<h2><?php echo $language['Latest_warnings']; ?></h2>
<?php
		if(!empty($settings['servers'])) {
			echo '
	<div class="row">';
			$id = array_keys($settings['servers']);
			$i = 0;
			foreach($settings['servers'] as $server) {
				echo '
		<div class="span4">
			<h3>'.$server['name'].'</h3>
			<ul class="nav nav-tabs nav-stacked">';	
				latestWarnings($server, $i);
				echo '
			</ul>
		</div>';
				
				++$i;
			}
			echo '
	</div>';
		} else
			echo '<p>没有记录</p>';
	}
} else if(count($settings['servers']) == 1) {
	$display = false;
	
	if((isset($settings['latest_bans']) && $settings['latest_bans']) || !isset($settings['latest_bans']))
		$display = true;
	if((isset($settings['latest_mutes']) && $settings['latest_mutes']))
		$display = true;
	if((isset($settings['latest_warnings']) && $settings['latest_warnings']))
		$display = true;
		
	if($display) {
		$server = $settings['servers'][0];
		echo '
		<h2>'.$server['name'].'</h2>
		<div class="row">';
		
		if((isset($settings['latest_bans']) && $settings['latest_bans']) || !isset($settings['latest_bans'])) {
			echo '
			<div class="span4">
				<h3>最新封禁</h3>
				<ul class="nav nav-tabs nav-stacked">';	
					latestBans($server, 0);
				echo '
				</ul>
			</div>';
		}
		
		if((isset($settings['latest_mutes']) && $settings['latest_mutes'])) {
			echo '
			<div class="span4">
				<h3>最新禁言</h3>
				<ul class="nav nav-tabs nav-stacked">';	
					latestMutes($server, 0);
					echo '
				</ul>
			</div>';
		}
		
		if((isset($settings['latest_warnings']) && $settings['latest_warnings'])) {
			echo '
			<div class="span4">
				<h3>最新警告</h3>
				<ul class="nav nav-tabs nav-stacked">';	
					latestWarnings($server, 0);
				echo '
				</ul>
			</div>';
		}
		
		echo '
		</div>';
	}
}
?>