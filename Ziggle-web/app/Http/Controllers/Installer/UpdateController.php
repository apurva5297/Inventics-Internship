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
 namespace App\Http\Controllers\Installer; use Illuminate\Routing\Controller; use App\Http\Controllers\Installer\Helpers\InstalledFileManager; use App\Http\Controllers\Installer\Helpers\DatabaseManager; class UpdateController extends Controller { use \App\Http\Controllers\Installer\Helpers\MigrationsHelper; public function welcome() { return view("\x69\156\x73\x74\x61\154\154\x65\162\56\x75\x70\x64\141\164\x65\56\x77\145\x6c\x63\x6f\x6d\145"); } public function overview() { $migrations = $this->getMigrations(); $dbMigrations = $this->getExecutedMigrations(); return view("\x69\x6e\x73\x74\x61\x6c\x6c\x65\162\x2e\165\160\x64\141\x74\x65\56\157\166\x65\162\166\151\145\x77", ["\x6e\x75\x6d\142\x65\x72\117\146\125\x70\144\x61\x74\145\163\120\145\x6e\x64\151\x6e\x67" => count($migrations) - count($dbMigrations)]); } public function database() { $databaseManager = new DatabaseManager(); $response = $databaseManager->migrateAndSeed(); return redirect()->route("\x4c\141\x72\141\x76\x65\154\125\160\144\141\164\145\162\72\x3a\x66\x69\x6e\x61\154")->with(["\x6d\x65\163\163\x61\x67\145" => $response]); } public function finish(InstalledFileManager $fileManager) { $fileManager->update(); return view("\151\x6e\x73\x74\141\154\x6c\x65\162\x2e\165\160\x64\141\164\x65\56\146\151\156\151\x73\x68\x65\144"); } }
