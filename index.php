<?php
if(isset($_POST)) {
	$bgs = array('Black','White','DarkGrey','LightGrey','Red','Yellow','DarkGreen','LightGreen','Blue','Cyan','Purple','Magenta','Orange','Brown','Beige');
	$fonts = array(	"Arial"              => "./-fonts/arial.ttf",
					"Arial Bold"         => "./-fonts/arialbd.ttf",
					"Comic Sans MS"      => "./-fonts/comic.ttf",
					"Comic Sans MS Bold" => "./-fonts/comicbd.ttf",
					"Tahoma"             => "./-fonts/tahoma.ttf",
					"Tahoma Bold"        => "./-fonts/tahomabd.ttf",
					"Verdana"            => "./-fonts/verdana.ttf",
					"Verdana Bold"       => "./-fonts/verdanab.ttf");
	$sizes = array( 10 => 33,
					15 => 36,
					20 => 38,
					25 => 40,
					30 => 41,
					35 => 43,
					40 => 44,
					45 => 47);
	$size = 20;
	$offs = 38;
	if(in_array(@$_POST['bgs'],$bgs)) $bg = @$_POST['bgs'];
	else $bg = 'Black';
	if(isset($_POST['size'])) {
		foreach($sizes as $k => $v) {
			if($k == $_POST['size']) {
				$size = $k;
				$offs = $v;
	}}}
	
	$font_name = null;
	$font_ref = null;
	if(isset($_POST['font'])) {
		foreach($fonts as $x => $y) {
			if($_POST['font'] == $x) {
				$font_name = $x;
				$font_ref  = $y;
	}}}
	if($font_ref === null) {$font_ref = "./-fonts/arial.ttf"; $font_name="Arial";}
	$fgcol = isset($_POST['fgcol']) && preg_match("~^[0-9A-Fa-f]{6}$~",$_POST['fgcol']) ? hexdec($_POST['fgcol']) : 0xFFFFFF;
	$sigtxt = isset($_POST['sigtxt']) && trim($_POST['sigtxt']) !== '' ? trim(stripslashes($_POST['sigtxt'])) : 'text';
	
	$im = imagecreatetruecolor(500, 60);
	$bgc = imagecolorallocate($im, 100, 255, 30);

	imagettftext($im, $size, 0, 5, $offs, $fgcol, $font_ref, $sigtxt);
	imagestring($im, 2, 454, 47,  'tnuC', 0xFFCC00);
	imagestring($im, 1, 478, 51, ".org", 0xFFCC00);
	imagepng($im,'lolwat.png');	
	imagedestroy($im);
	
}
?>

<center><img src="./lolwat.png">
<h2>Dynamic Signature</h2>
<p>Change settings below and test with 'Preview'.<br />Push 'Apply' when done.</p>
<form name="newimg" action="./" method="post">
<table>
<tr><td align="right">text</td><td><input type="text" name="sigtxt" value="<?=htmlspecialchars($sigtxt)?>" /></td></tr>

<tr><td align="right">font family</td>
<td><select size="1" name="font">
<?php
foreach($fonts as $k => $v) {
	echo '<option value="'.$k.'"'.($k === $font_name?' selected=selected':'').'>'.$k.'</option>\n';
}
?>
</select></td></tr>
<tr><td align="right">font size</td>
<td><select size="1" name="size">
<?php
foreach($sizes as $k => $v) {
	echo '<option value="'.$k.'"'.($k === $size?' selected=selected':'').'>'.$k.'px</option>\n';
}
?>
</select></td></tr>
<tr><td align="right">text colour (hex)</td>
<td><input type="text" name="fgcol" value="<?php echo isset($_POST['fgcol']) ? $_POST['fgcol'] : 'FFFFFF'; ?>" maxlength="6" /></td></tr>

<tr><td align="right">background colour</td>
<td><select size="1" name="bgs">
<?php
foreach($bgs as $v) {
	echo '<option value="'.$v.'"'.($v == $bg?' selected=selected':'').'>'.$v.'</option>\n';
}
?>
</select></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="prev" value=" preview " /><input type="submit" value=" apply " /></td></tr>
</table>
</form></center>