<?php
/*
Plugin Name: Berri Personalized Care
Plugin URI: http://www.berriart.com/personalizedcare/
Description: This plugin will give up to four personalized messages depending on the origin of the visitors of your blog. Originally based on the rthanks plugin by Alamsyah Rasyid. Add <strong>&lt;? berri_personalized_message(); ?&gt;</strong> on your template where you want to show the message.
Author: Alberto Varela
Version: beta
Author URI: http://www.berriart.com

	My plugin is released under the GNU General Public License (GPL)
	http://www.gnu.org/licenses/gpl.txt
*/

/******************************************************************************

Copyright 2007  Alberto Varela  (email : alberto@berriart.com)

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
The license is also available at http://www.gnu.org/copyleft/gpl.html

*********************************************************************************/

ini_set("memory_limit","12M");

// Add a new menu under Options:
function personalized_care_pages() {
    add_options_page('Berri Personalized Care', 'PersonalizedCare', 8, 'personalizedcare', 'personalized_care_options');
}

// personalized_care_options() displays the page content for the PersonalizedCare submenu
function personalized_care_options() {

	//Lets add some default options if they don't exist
	add_option('berri_pc_tags_1', '');
	add_option('berri_pc_message_1', '');
	add_option('berri_pc_tags_2', '');
	add_option('berri_pc_message_2', '');
	add_option('berri_pc_tags_3', '');
	add_option('berri_pc_message_3', '');
	add_option('berri_pc_message_else', '');

	//check form submission and update options
	if (isset($_POST['action']) && ('update' == $_POST['action']))
	{
		if ((!empty($_POST['berri_pc_tags_1'])) && (!empty($_POST['berri_pc_message_1'])))
		{
			$berri_pc_tags_1 = $_POST['berri_pc_tags_1'];
			$berri_pc_message_1 = $_POST['berri_pc_message_1'];
		}
		else
		{
			$berri_pc_tags_1 = '';
			$berri_pc_message_1 = '';			
		}

		update_option('berri_pc_tags_1', $berri_pc_tags_1);
		update_option('berri_pc_message_1', $berri_pc_message_1);

		if ((!empty($_POST['berri_pc_tags_2'])) && (!empty($_POST['berri_pc_message_2'])))
		{
			$berri_pc_tags_2 = $_POST['berri_pc_tags_2'];
			$berri_pc_message_2 = $_POST['berri_pc_message_2'];
		}
		else
		{
			$berri_pc_tags_2 = '';
			$berri_pc_message_2 = '';			
		}
		update_option('berri_pc_tags_2', $berri_pc_tags_2);
		update_option('berri_pc_message_2', $berri_pc_message_2);

		if ((!empty($_POST['berri_pc_tags_3'])) && (!empty($_POST['berri_pc_message_3'])))
		{
			$berri_pc_tags_3 = $_POST['berri_pc_tags_3'];
			$berri_pc_message_3 = $_POST['berri_pc_message_3'];
		}
		else
		{
			$berri_pc_tags_3 = '';
			$berri_pc_message_3 = '';			
		}
		update_option('berri_pc_tags_3', $berri_pc_tags_3);
		update_option('berri_pc_message_3', $berri_pc_message_3);

		$berri_pc_message_else = $_POST['berri_pc_message_else'];
		update_option('berri_pc_message_else', $berri_pc_message_else);

	}

	//Get options for form fields
	$berri_pc_tags_1 = get_option('berri_pc_tags_1');
	$berri_pc_message_1 = stripslashes(get_option('berri_pc_message_1')); 
	$berri_pc_tags_2 = get_option('berri_pc_tags_2');
	$berri_pc_message_2 = stripslashes(get_option('berri_pc_message_2'));
	$berri_pc_tags_3 = get_option('berri_pc_tags_3');
	$berri_pc_message_3 = stripslashes(get_option('berri_pc_message_3'));

	$berri_pc_message_else = stripslashes(get_option('berri_pc_message_else'));

	//The options page
	?>
	<div class='wrap'>
		<h2>Berri Personalized Care (beta)</h2>
		<form name="berri_pc_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=personalizedcare&updated=true">
		<input type="hidden" name="action" value="update" />
		<fieldset class="options">
		<legend>Set the personalized messages depending on the origin of the visitors:<br /><em><small>If you don't want to use some of the personalized messages, keep them blank</small></em></legend>
		<table width="100%" cellspacing="2" cellpadding="5" class="optiontable editform"> 
		<tr valign="top"> 
			<th width="33%" scope="row"><strong>Peronalized message 1</strong></th>
			<td>&nbsp;</td> 
		</tr>
		<tr valign="top"> 
			<th width="33%" scope="row"><label for="berri_pc_tags_1">Came from:</label></th> 
			<td><input name="berri_pc_tags_1" type="text" id="berri_pc_tags_1" value="<? echo $berri_pc_tags_1; ?>" size="44" class="code" /><br />
			Enter one or more referers, separated by commas (google,technorati,del.icio.us)</td> 
		</tr>
		<tr valign="top"> 
			<th width="33%" scope="row"><label for="berri_pc_message_1">Message:</label></th> 
			<td><textarea name="berri_pc_message_1" id="berri_pc_message_1" cols="40" rows="5"><? echo $berri_pc_message_1; ?></textarea><br />
			<acronym title="HyperText Markup Language" lang="en">HTML</acronym> code is allowed<br />
			<strong>{hostname}</strong> tag will show the referer host name</td> 
		</tr>
		<tr valign="top"> 
			<th width="33%" scope="row"><strong>Peronalized message 2</strong></th>
			<td>&nbsp;</td> 
		</tr>
		<tr valign="top"> 
			<th width="33%" scope="row"><label for="berri_pc_tags_2">Came from:</label></th> 
			<td><input name="berri_pc_tags_2" type="text" id="berri_pc_tags_2" value="<? echo $berri_pc_tags_2; ?>" size="44" class="code" /><br />
			Enter one or more referers, separated by commas (google,technorati,del.icio.us)</td> 
		</tr>
		<tr valign="top"> 
			<th width="33%" scope="row"><label for="berri_pc_message_2">Message:</label></th> 
			<td><textarea name="berri_pc_message_2" id="berri_pc_message_2" cols="40" rows="5"><? echo $berri_pc_message_2; ?></textarea><br />
			<acronym title="HyperText Markup Language" lang="en">HTML</acronym> code is allowed<br />
			<strong>{hostname}</strong> tag will show the referer host name</td> 
		</tr>
		<tr valign="top"> 
			<th width="33%" scope="row"><strong>Peronalized message 3</strong></th>
			<td>&nbsp;</td> 
		</tr>
		<tr valign="top"> 
			<th width="33%" scope="row"><label for="berri_pc_tags_3">Came from:</label></th> 
			<td><input name="berri_pc_tags_3" type="text" id="berri_pc_tags_3" value="<? echo $berri_pc_tags_3; ?>" size="44" class="code" /><br />
			Enter one or more referers, separated by commas (google,technorati,del.icio.us)</td> 
		</tr>
		<tr valign="top"> 
			<th width="33%" scope="row"><label for="berri_pc_message_3">Message:</label></th> 
			<td><textarea name="berri_pc_message_3" id="berri_pc_message_3" cols="40" rows="5"><? echo $berri_pc_message_3; ?></textarea><br />
			<acronym title="HyperText Markup Language" lang="en">HTML</acronym> code is allowed<br />
			<strong>{hostname}</strong> tag will show the referer host name</td> 
		</tr>
		<tr valign="top"> 
			<th width="33%" scope="row"><strong>Else</strong><br/><em><small>This message will be showed if the origin of the visitor don't match with previous conditions. Keep it blank if you want.</small></em></th>
			<td><textarea name="berri_pc_message_else" id="berri_pc_message_else" cols="40" rows="5"><? echo $berri_pc_message_else; ?></textarea><br />
			<acronym title="HyperText Markup Language" lang="en">HTML</acronym> code is allowed<br />
			<strong>{hostname}</strong> tag will show the referer host name</td>  
		</tr>
		</table> 
		</fieldset>
		<p>
			<center><a href="http://www.berriart.com/personalizedcare/">Berriart.com</a> - Commentaries are welcome</center>
		</p>
		<p class="submit">
			<input type="submit" name="Submit" value="<?php _e('Update Options') ?> &raquo;" />
		</p>	
		</form>
	</div>
	<?
}

//This function push tags into array
function berri_extract_tags($tags) {

	$tags_array = Array();
	$tags_array = split (',',$tags);
	$i = 0;
	$tags_ok = '';
	foreach ($tags_array as $tag)
	{
		$tag = trim($tag);

		if ($i != 0)
		{
			$tags_ok .= '|';
		}
		$tags_ok .= $tag;
		$i++;
	}
	return $tags_ok;
}

//This function will show the message
function berri_personalized_message(){

	$pattern1 = '/^http:\/\/(\w+\.)?(' . berri_extract_tags(get_option('berri_pc_tags_1')) . ')\./';
	$pattern2 = '/^http:\/\/(\w+\.)?(' . berri_extract_tags(get_option('berri_pc_tags_2')) . ')\./';
	$pattern3 = '/^http:\/\/(\w+\.)?(' . berri_extract_tags(get_option('berri_pc_tags_3')) . ')\./';

	//First message
	if ((preg_match($pattern1, $_SERVER['HTTP_REFERER']) == 1) && get_option('berri_pc_message_1') != '' && get_option('berri_pc_tags_1') != '') {
 		// get host name from URL
		preg_match('@^(?:http://)?([^/]+)@i', $_SERVER['HTTP_REFERER'], $matches);
		$host = $matches[1];

 		// get last two segments of host name
		preg_match('/[^.]+\.[^.]+$/', $host, $matches);

		$personalized1 = stripslashes(get_option('berri_pc_message_1'));
		$personalized1 = str_replace ('{hostname}', $matches[0], $personalized1);

		echo $personalized1;
	}

	//Second message
	elseif ((preg_match($pattern2, $_SERVER['HTTP_REFERER']) == 1) && get_option('berri_pc_message_2') != '' && get_option('berri_pc_tags_2') != '') {

 		// get host name from URL
		preg_match('@^(?:http://)?([^/]+)@i', $_SERVER['HTTP_REFERER'], $matches);
		$host = $matches[1];

 		// get last two segments of host name
		preg_match('/[^.]+\.[^.]+$/', $host, $matches);

		$personalized2 = stripslashes(get_option('berri_pc_message_2'));
		$personalized2 = str_replace ('{hostname}', $matches[0], $personalized2);

		echo $personalized2;
	}

	//Third message
	elseif ((preg_match($pattern3, $_SERVER['HTTP_REFERER']) == 1) && get_option('berri_pc_message_3') != '' && get_option('berri_pc_tags_3') != '') {

 		// get host name from URL
		preg_match('@^(?:http://)?([^/]+)@i', $_SERVER['HTTP_REFERER'], $matches);
		$host = $matches[1];

 		// get last two segments of host name
		preg_match('/[^.]+\.[^.]+$/', $host, $matches);

		$personalized3 = stripslashes(get_option('berri_pc_message_3'));
		$personalized3 = str_replace ('{hostname}', $matches[0], $personalized3);

		echo $personalized3;
	}

	//Else
	else
	{
		if (get_option('berri_pc_message_else') != '') {

 		// get host name from URL
		preg_match('@^(?:http://)?([^/]+)@i', $_SERVER['HTTP_REFERER'], $matches);
		$host = $matches[1];

 		// get last two segments of host name
		preg_match('/[^.]+\.[^.]+$/', $host, $matches);

		$personalizedelse = stripslashes(get_option('berri_pc_message_else'));
		$personalizedelse = str_replace ('{hostname}', $matches[0], $personalizedelse);

		echo $personalizedelse;

		}
	}

}

// Insert the personalized_care_pages() sink into the plugin hook list for 'admin_menu'
add_action('admin_menu', 'personalized_care_pages');

?>
