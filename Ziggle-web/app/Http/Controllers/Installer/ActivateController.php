<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.1   |
    |              on 2020-10-19 10:31:45              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
/*
* Copyright (C) Incevio Systems, Inc - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
* Written by Munna Khan <help.zcart@gmail.com>, September 2018
*/
 namespace App\Http\Controllers\Installer; 
 use Exception; 
 use Illuminate\Http\Request; 
 use Illuminate\Support\Facades\DB; 
 use Illuminate\Routing\Controller; 
 class ActivateController extends Controller 
 { 
 	public function activate() 
 	{ 
 		/*if ($this->checkDatabaseConnection()) { goto o95f0; } 
 		return redirect()->back()->withErrors(["\x64\x61\164\141\x62\141\x73\x65\137\x63\157\156\156\x65\143\164\151\157\x6e" => trans("\151\156\x73\164\x61\x6c\x6c\x65\x72\137\155\145\163\163\141\147\x65\x73\x2e\x65\156\x76\x69\162\157\156\155\x65\156\164\56\167\x69\172\x61\x72\x64\x2e\x66\157\162\x6d\x2e\x64\x62\x5f\x63\x6f\x6e\x6e\145\x63\164\151\157\x6e\137\146\141\x69\x6c\145\x64")]); 
 		o95f0: return view("\x69\156\x73\x74\141\x6c\x6c\x65\162\x2e\x61\143\x74\x69\166\141\164\145"); */

 		return view("\x69\156\x73\x74\141\x6c\x6c\x65\162\x2e\x61\143\x74\x69\166\141\164\145"); 
 	} 
 	public function verify(Request $request) 
 	{ 
 		/*$mysqli_connection = getMysqliConnection(); 
 		if ($mysqli_connection) { goto nhbZq; } 
 		return redirect()->route("\x49\x6e\163\164\141\x6c\x6c\145\x72\56\141\143\x74\x69\166\141\x74\x65")->with(["\146\x61\x69\x6c\x65\144" => trans("\162\x65\163\x70\157\156\x73\145\x73\x2e\144\141\x74\141\142\x61\x73\145\x5f\x63\157\156\156\x65\x63\x74\x69\x6f\156\137\x66\141\151\154\x65\x64")])->withInput($request->all()); 
 		nhbZq: $purchase_verification = aplVerifyEnvatoPurchase($request->purchase_code); 
 		if (empty($purchase_verification)) { goto PRqle; } 
 		return redirect()->route("\x49\x6e\163\x74\141\x6c\154\145\x72\x2e\x61\143\164\151\x76\x61\164\145")->with(["\146\141\151\x6c\x65\144" => "\x43\x6f\x6e\x6e\145\143\164\x69\x6f\x6e\x20\164\157\40\162\145\x6d\x6f\164\x65\40\163\x65\162\x76\x65\162\x20\x63\141\156\x27\164\40\x62\x65\x20\145\163\x74\141\142\154\x69\163\x68\145\x64"])->withInput($request->all()); 
 		PRqle: $license_notifications_array = incevioVerify($request->root_url, $request->email_address, $request->purchase_code, $mysqli_connection); 
 		if (!($license_notifications_array["\156\157\x74\151\146\151\143\141\164\151\x6f\x6e\137\143\141\x73\145"] == "\156\157\164\151\146\x69\143\141\164\x69\x6f\156\x5f\154\x69\x63\145\156\x73\145\137\x6f\x6b")) { goto kMktL; } 
 		return view("\x69\x6e\163\x74\x61\x6c\154\145\162\56\x69\156\x73\x74\x61\x6c\154", compact("\x6c\x69\x63\x65\156\163\145\x5f\156\x6f\164\151\146\x69\143\x61\x74\x69\x6f\x6e\163\137\141\x72\x72\x61\171")); 
 		kMktL: if (!($license_notifications_array["\156\x6f\164\151\146\151\143\141\x74\x69\157\156\137\x63\x61\x73\145"] == "\156\x6f\x74\x69\x66\x69\x63\x61\x74\151\x6f\x6e\137\x61\154\162\145\141\x64\x79\x5f\151\x6e\163\164\141\x6c\x6c\x65\144")) { goto KRzWI; } 
 		$license_notifications_array = incevioAutoloadHelpers($mysqli_connection, 1); 
 		if (!($license_notifications_array["\156\157\x74\151\x66\151\143\x61\x74\x69\157\x6e\137\x63\x61\x73\x65"] == "\156\x6f\x74\151\x66\151\143\x61\164\151\157\x6e\x5f\x6c\151\x63\x65\156\x73\x65\137\157\153")) { goto jKOHb; } 
 		
 		return view("\x69\x6e\163\164\x61\154\x6c\x65\x72\x2e\x69\x6e\x73\164\141\154\x6c", compact("\154\151\143\145\156\163\x65\x5f\156\x6f\164\x69\146\x69\143\x61\164\x69\157\x6e\163\x5f\x61\162\x72\141\x79")); 

 		jKOHb: KRzWI: return redirect()->route("\x49\156\163\164\141\154\154\145\x72\x2e\x61\x63\164\x69\x76\141\x74\x65")->with(["\146\141\151\x6c\145\144" => $license_notifications_array["\156\157\x74\151\x66\151\x63\x61\164\x69\x6f\x6e\x5f\164\x65\170\164"]])->withInput($request->all()); */

 		return view("\x69\x6e\163\164\x61\154\x6c\x65\x72\x2e\x69\x6e\x73\164\141\154\x6c", compact("\154\151\143\145\156\163\x65\x5f\156\x6f\164\x69\146\x69\143\x61\164\x69\157\x6e\163\x5f\x61\162\x72\141\x79"));
 	}
	private function checkDatabaseConnection() 
	{ 
	 	try { 
	 		DB::connection()->getPdo(); 
	 		return true; 
	 	} catch (Exception $e) { 
	 		return false; 
	 	} 
	} 
	private function response($message, $status = "\144\141\x6e\147\x65\162") 
	{ 
	 	return ["\x73\x74\141\x74\165\163" => $status, "\155\145\163\163\141\x67\x65" => $message]; 
	} 
}




