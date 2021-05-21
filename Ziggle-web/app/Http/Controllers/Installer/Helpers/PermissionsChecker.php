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
 namespace App\Http\Controllers\Installer\Helpers; class PermissionsChecker { protected $results = []; public function __construct() { $this->results["\160\x65\x72\x6d\151\x73\x73\x69\x6f\156\163"] = []; $this->results["\x65\x72\162\x6f\162\x73"] = null; } public function check(array $folders) { foreach ($folders as $folder => $permission) { if (!($this->getPermission($folder) >= $permission)) { goto u9RCv; } $this->addFile($folder, $permission, true); goto c350W; u9RCv: $this->addFileAndSetErrors($folder, $permission, false); c350W: ucTEv: } KVkJt: return $this->results; } private function getPermission($folder) { return substr(sprintf("\x25\x6f", fileperms(base_path($folder))), -4); } private function addFile($folder, $permission, $isSet) { array_push($this->results["\160\145\162\x6d\x69\163\x73\x69\157\156\x73"], ["\146\x6f\x6c\144\x65\162" => $folder, "\160\145\162\x6d\x69\x73\163\x69\x6f\156" => $permission, "\151\x73\x53\x65\164" => $isSet]); } private function addFileAndSetErrors($folder, $permission, $isSet) { $this->addFile($folder, $permission, $isSet); $this->results["\145\x72\162\x6f\162\163"] = true; } }
