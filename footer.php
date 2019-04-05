<?php
/*  BanManagement � 2012, a web interface for the Bukkit plugin BanManager
    by James Mortemore of http://www.frostcast.net
	is licenced under a Creative Commons
	Attribution-NonCommercial-ShareAlike 2.0 UK: England & Wales.
	Permissions beyond the scope of this licence 
	may be available at http://creativecommons.org/licenses/by-nc-sa/2.0/uk/.
	Additional licence terms at https://raw.github.com/confuser/Ban-Management/master/banmanagement/licence.txt
*/
?>
			<hr>
			<footer>
			<?php
			if($settings['footer'] == ''){
				?><p class="pull-left"><?php echo $settings['footer']; ?></p><?php
			} else {
				if($settings['footer_url'] == ''){
					?><p class="pull-left">Copyright (c) <?php echo $settings['footer']; ?></p><?php
				} else {
					?><p class="pull-left"><a href="<?php echo $settings['footer_url']; ?>" target="_blank">Copyright (c) <?php echo $settings['footer']; ?></a></p><?php
				}
			}
				?>
				<!-- Must not be removed as per the licence terms -->
				<p class="pull-right">
					创作团队 By <a href="https://github.com/BanManagement" target="_blank">BanManagement</a>
					<br />
					技术&汉化 By <a href="http://www.mcbbs.net/?1691353" target="_blank">Xiao_Fang_He</a>
					<br />
					plus版的编写 By <a href="https://weibo.com/u/6833082752?refer_flag=1005055010_" target="_blank">Mr.yan
				</p>
			</footer>
		</div> <!-- /container -->
		<script type="text/javascript">
			$(function() {
				$(".span4 button[rel='popover']").popover({trigger: 'hover', placement: 'left'});
				$("#search li").click(function(e) {
					var s = $(this);
					if(s.attr("id") == 'ip') {
						var player = $("#player");
						$("#ip").attr('id', 'player').find("a").text('Player');
						player.attr('id', 'ip').html('IP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="caret"></span>');
						$("#search input[type=text]").attr('placeholder', 'Enter IP Address');
						$("#search input[name=action]").attr('value', 'searchip');
					} else {
						var ip = $("#ip");
						$("#player").attr('id', 'ip').find("a").text('IP');
						ip.attr('id', 'player').html('Player <span class="caret"></span>');
						$("#search input[type=text]").attr('placeholder', 'Enter Player Name');
						$("#search input[name=action]").attr('value', 'searchplayer');
					}
				});
				$("#viewall").click(function() {
					var server = $("#search input[name=server]:checked").val();
					
					 if(typeof server === 'undefined')
						server = 0;
					
					window.location.href = 'index.php?action='+$("#search input[name=action]").val()+'&server='+server+'&player=%';
				});
			});
		</script>
	</body>
</html>