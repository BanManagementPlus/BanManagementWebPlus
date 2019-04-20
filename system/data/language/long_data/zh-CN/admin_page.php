<?php
$language_admin_page['one_is_writable_save'] = '<input type="submit" class="btn btn-primary btn-large disabled" disabled="disabled" value="保存" />';
$language_admin_page['two_is_writable_save'] = '<input type="submit" class="btn btn-primary btn-large" value="保存" />';
$language_admin_page['settings_file_can_not_be_written_to'] = '
<tr>
    <td colspan="2">settings.php无法写入</td>
</tr>';
$language_admin_page['one_is_writable_Homepage_Settings'] = '
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
$language_admin_page['two_is_writable_Homepage_Settings'] = '
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
$language_admin_page['No_Servers_Defined'] = '<tr id="noservers"><td colspan="2">列表中没有服务器</td></tr>';
$language_admin_page['add_server_one'] = '<a class="btn btn-primary btn-large disabled" href="#addserver" title="Settings file not writable">添加服务器</a>';
$language_admin_page['add_server_two'] = '<a class="btn btn-primary btn-large" href="#addserver" data-toggle="modal">添加服务器</a>';
?>