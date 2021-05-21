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
 namespace App\Http\Controllers\Installer\Helpers; use Exception; use Illuminate\Support\Facades\Artisan; use Symfony\Component\Console\Output\BufferedOutput; class FinalInstallManager { public function runFinal() { $outputLog = new BufferedOutput(); $this->generateKey($outputLog); $this->publishVendorAssets($outputLog); return $outputLog->fetch(); } private static function generateKey($outputLog) { try { if (!config("\x69\x6e\x73\x74\141\x6c\154\145\162\x2e\146\151\156\141\x6c\56\x6b\x65\x79")) { goto cvlMm; } Artisan::call("\x6b\x65\x79\x3a\x67\x65\156\x65\x72\x61\164\x65", ["\x2d\55\x66\157\x72\x63\145" => true], $outputLog); cvlMm: } catch (Exception $e) { return static::response($e->getMessage(), $outputLog); } return $outputLog; } private static function publishVendorAssets($outputLog) { try { if (!config("\151\x6e\x73\164\x61\154\154\x65\162\56\x66\151\156\141\x6c\x2e\x70\x75\x62\154\151\163\x68")) { goto SRIda; } Artisan::call("\x76\x65\156\x64\x6f\x72\72\160\x75\x62\x6c\x69\163\x68", ["\x2d\55\141\x6c\x6c" => true], $outputLog); SRIda: } catch (Exception $e) { return static::response($e->getMessage(), $outputLog); } return $outputLog; } private static function response($message, $outputLog) { return ["\x73\164\x61\164\x75\x73" => "\145\x72\162\x6f\x72", "\x6d\145\163\163\x61\147\x65" => $message, "\x64\142\117\x75\x74\160\165\164\114\x6f\x67" => $outputLog->fetch()]; } }
