<?php

/* Security Function */
function _clean($str){
	return is_array($str) ? array_map('_clean', $str) : str_replace('\\', '\\\\', strip_tags(trim(htmlspecialchars((get_magic_quotes_gpc() ? stripslashes($str) : $str), ENT_QUOTES))));
}
_clean($_GET);

$dem = "200x200";

$_GET = str_replace(' ','+',$_GET);
$_GET = str_replace('@','%40',$_GET);

// output business card
if($_GET['qrtype'] == 'buscardqr'){

	$image_src = 'http://chart.apis.google.com/chart?cht=qr&chs='.$dem.'&chl=MECARD%3AN%3A'.$_GET['flname'].'%3BTEL%3A'.$_GET['phone'].'%3BURL%3A'.$_GET['website'].'%3BEMAIL%3A'.$_GET['email'].'%3BADR%3A'.$_GET['addr'].',+'.$_GET['city'].',+'.$_GET['state'].'%3BNOTE%3A'.$_GET['org'].'+Regarding:+'.$_GET['notes'].'%3BTITLE%3A'.$_GET['org'].'%3B%3B';
	// set qr code size, larger for bus card
	$qr_width=28;$qr_height="173";
} // output URL
else if($_GET['qrtype'] == 'urlqr'){
	$image_src = "http://chart.apis.google.com/chart?cht=qr&chs=$dem&chl=".$_GET['qrurl'];
	// set qr code size, smaller for url
	$qr_width=38;$qr_height="168";
} // output message
else if($_GET['qrtype'] == 'messageqr'){
	$image_src = 'http://chart.apis.google.com/chart?cht=qr&chs='.$dem.'&chl='.str_replace(" ","+",$_GET['qrmessage']).'&chld=L';
	// set qr code size, smaller for short message
	$qr_width=38;$qr_height="176";
}

// create bitwise image header for PNG file
$img_header = 'U0FJIExhYnM=';
// allocate image memory, requires GD lib, php5-gd
$image = imagecreatefrompng($image_src);
// create output bits for image
imagestring($image,1,$qr_width,$qr_height,base64_decode($img_header),0x8a8a8a);
// output image, bitwise
header('Content-type: '.image_type_to_mime_type(IMAGETYPE_WBMP));
header('Content-Disposition: inline; filename="QR-Code.jpg"');
imagejpeg($image);
// cleanup memory
imagedestroy($image);
?>
