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
 namespace App\Http\Controllers\Installer; use Exception; use Illuminate\Support\Facades\DB; use Illuminate\Routing\Controller; use App\Http\Controllers\Installer\Helpers\DatabaseManager; class DatabaseController extends Controller { private $databaseManager; public function __construct(DatabaseManager $databaseManager) { $this->databaseManager = $databaseManager; } public function database() { if ($this->checkDatabaseConnection()) { goto vDzvk; } return redirect()->back()->withErrors(["\x64\141\164\141\x62\141\163\x65\x5f\x63\x6f\156\156\145\143\x74\151\x6f\x6e" => trans("\x69\156\163\x74\x61\x6c\154\x65\162\x5f\155\145\163\163\141\147\145\163\56\x65\156\166\x69\162\x6f\x6e\155\145\156\164\56\167\151\172\141\162\x64\x2e\x66\x6f\162\x6d\56\x64\x62\x5f\x63\157\156\x6e\x65\x63\x74\x69\x6f\x6e\137\x66\141\151\x6c\145\x64")]); vDzvk: ini_set("\155\x61\170\x5f\145\x78\x65\143\165\x74\151\157\x6e\137\x74\151\x6d\x65", 600); $response = $this->databaseManager->migrateAndSeed(); return redirect()->route("\x49\x6e\x73\x74\141\154\154\x65\162\56\146\x69\x6e\141\x6c")->with(["\155\145\x73\163\141\147\145" => $response]); } private function checkDatabaseConnection() { try { DB::connection()->getPdo(); return true; } catch (Exception $e) { return false; } } }
