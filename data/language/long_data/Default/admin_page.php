<?php
$admin_page['one_is_writable_save'] = '<input type="submit" class="btn btn-primary btn-large disabled" disabled="disabled" value="Save" />';
$admin_page['two_is_writable_save'] = '<input type="submit" class="btn btn-primary btn-large" value="Save" />';
$admin_page['settings_file_can_not_be_written_to'] = '
<tr>
    <td colspan="2">settings.php can not be written to</td>
</tr>';
$admin_page['one_is_writable_Homepage_Settings'] = '
<tr>
    <td>iFrame Protection (Recommended)</td>
    <td><input type="hidden" name="type" value="mainsettings" /><input type="checkbox" name="iframe"'.((isset($settings['iframe_protection']) && $settings['iframe_protection']) || !isset($settings['iframe_protection']) ? ' checked="checked"' : '').' /></td>
</tr>
<tr>
    <td>UTF8</td>
    <td><input type="checkbox" name="utf8"'.(isset($settings['utf8']) && $settings['utf8'] ? ' checked="checked"' : '').' /></td>
</tr>
<tr>
    <td>Footer</td>
    <td><input type="text" name="footer" value="'.$settings['footer'].'" /></td>
</tr>
<tr>
    <td>Latest Bans</td>
    <td><input type="checkbox" name="latestbans"'.((isset($settings['latest_bans']) && $settings['latest_bans']) || !isset($settings['latest_bans']) ? ' checked="checked"' : '').' /></td>
</tr>
<tr>
    <td>Latest Mutes</td>
    <td><input type="checkbox" name="latestmutes"'.(isset($settings['latest_mutes']) && $settings['latest_mutes'] ? ' checked="checked"' : '').' /></td>
</tr>
<tr>
    <td>Latest Warnings</td>
    <td><input type="checkbox" name="latestwarnings"'.(isset($settings['latest_warnings']) && $settings['latest_warnings'] ? ' checked="checked"' : '').' /></td>
</tr>
<tr>
    <td>HTML Before Buttons</td>
    <td><input type="text" name="buttons_before" value="'.(isset($settings['submit_buttons_before_html']) ? $settings['submit_buttons_before_html'] : '').'" /></td>
</tr>
<tr>
    <td>HTML After Buttons</td>
    <td><input type="text" name="buttons_after" value="'.(isset($settings['submit_buttons_after_html']) ? $settings['submit_buttons_after_html'] : '').'" /></td>
</tr>';
$admin_page['two_is_writable_Homepage_Settings'] = '
<tr>
    <td>Current Ban</td>
    <td><input type="hidden" name="type" value="viewplayer" /><input type="checkbox" name="ban"'.((isset($settings['player_current_ban']) && $settings['player_current_ban']) || !isset($settings['player_current_ban']) ? ' checked="checked"' : '').' /></td>
</tr>
<tr>
    <td>Current Ban HTML Extra</td>
    <td><input type="input" class="form-control" name="banextra"'.(isset($settings['player_current_ban_extra_html']) ? ' value="'.$settings['player_current_ban_extra_html'].'"' : '').' /></td>
</tr>
<tr>
    <td>Current Mute</td>
    <td><input type="checkbox" name="mute"'.((isset($settings['player_current_mute']) && $settings['player_current_mute']) || !isset($settings['player_current_mute']) ? ' checked="checked"' : '').' /></td>
</tr>
<tr>
    <td>Current Mute HTML Extra</td>
    <td><input type="input" class="form-control" name="muteextra"'.(isset($settings['player_current_mute_extra_html']) ? ' value="'.$settings['player_current_mute_extra_html'].'"' : '').' /></td>
</tr>
<tr>
    <td>Previous Bans</td>
    <td><input type="checkbox" name="prevbans"'.((isset($settings['player_previous_bans']) && $settings['player_previous_bans']) || !isset($settings['player_previous_bans']) ? ' checked="checked"' : '').' /></td>
</tr>
<tr>
    <td>Previous Mutes</td>
    <td><input type="checkbox" name="prevmutes"'.((isset($settings['player_previous_mutes']) && $settings['player_previous_mutes']) || !isset($settings['player_previous_mutes']) ? ' checked="checked"' : '').' /></td>
</tr>
<tr>
    <td>Warnings</td>
    <td><input type="checkbox" name="warnings"'.((isset($settings['player_warnings']) && $settings['player_warnings']) || !isset($settings['player_warnings']) ? ' checked="checked"' : '').' /></td>
</tr>
<tr>
    <td>Kicks</td>
    <td><input type="checkbox" name="kicks"'.((isset($settings['player_kicks']) && $settings['player_kicks']) || !isset($settings['player_kicks']) ? ' checked="checked"' : '').' /></td>
</tr>';
$admin_page['No_Servers_Defined'] = '<tr id="noservers"><td colspan="2">No Servers Defined</td></tr>';
?>