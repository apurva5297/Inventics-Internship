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
 namespace App\Http\Controllers\Installer\Helpers; class InstalledFileManager { public function create() { $installedLogFile = storage_path("\151\x6e\x73\164\141\x6c\x6c\145\144"); $dateStamp = date("\131\57\155\x2f\x64\x20\x68\x3a\151\x3a\x73\x61"); if (!file_exists($installedLogFile)) { goto wtYc6; } $message = trans("\x69\x6e\163\164\x61\154\x6c\x65\162\x5f\155\145\163\163\x61\147\145\x73\56\x75\160\x64\x61\164\145\x72\x2e\x6c\157\147\56\x73\x75\143\143\x65\163\163\137\155\x65\x73\x73\x61\147\145") . $dateStamp; file_put_contents($installedLogFile, $message . PHP_EOL, FILE_APPEND | LOCK_EX); goto FZTgt; wtYc6: $message = trans("\151\156\163\x74\x61\x6c\x6c\145\x72\x5f\155\x65\163\163\141\x67\145\x73\56\x69\156\x73\164\x61\154\x6c\145\144\56\163\165\143\x63\x65\x73\163\137\x6c\x6f\x67\x5f\155\x65\x73\163\x61\147\145") . $dateStamp . "\xa"; file_put_contents($installedLogFile, $message); FZTgt: return $message; } public function update() { return $this->create(); } }
