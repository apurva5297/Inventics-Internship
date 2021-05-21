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
 namespace App\Http\Controllers\Installer\Helpers; use Exception; use Illuminate\Database\SQLiteConnection; use Illuminate\Support\Facades\Artisan; use Illuminate\Support\Facades\Config; use Illuminate\Support\Facades\DB; use Symfony\Component\Console\Output\BufferedOutput; class DatabaseManager { public function migrateAndSeed() { $outputLog = new BufferedOutput(); $this->sqlite($outputLog); return $this->migrate($outputLog); } private function migrate($outputLog) { try { Artisan::call("\155\x69\147\x72\x61\164\x65", ["\x2d\55\146\157\162\x63\145" => true], $outputLog); } catch (Exception $e) { return $this->response($e->getMessage(), "\x65\162\162\x6f\162", $outputLog); } return $this->seed($outputLog); } private function seed($outputLog) { try { Artisan::call("\144\x62\72\163\x65\x65\x64", ["\55\x2d\146\157\162\143\145" => true], $outputLog); } catch (Exception $e) { return $this->response($e->getMessage(), "\145\x72\162\x6f\162", $outputLog); } return $this->response(trans("\x69\x6e\x73\164\x61\154\154\145\162\137\155\145\x73\163\141\x67\x65\x73\x2e\x66\x69\156\x61\154\56\146\x69\156\x69\x73\x68\145\144"), "\x73\165\143\x63\x65\163\x73", $outputLog); } public function seedDemoData() { ini_set("\155\141\170\x5f\145\x78\145\x63\165\164\151\x6f\156\x5f\x74\151\x6d\x65", 1200); $outputLog = new BufferedOutput(); try { Artisan::call("\x69\156\143\145\166\151\157\72\144\145\x6d\157"); } catch (Exception $e) { return $this->response($e->getMessage(), "\x65\x72\162\x6f\162", $outputLog); } return $this->response(trans("\151\156\x73\164\x61\x6c\154\x65\x72\x5f\x6d\145\163\163\x61\147\145\x73\x2e\146\151\156\141\x6c\56\146\151\x6e\151\163\150\145\x64"), "\163\165\x63\143\x65\x73\163", $outputLog); } private function response($message, $status = "\144\x61\156\147\x65\162", $outputLog) { return ["\x73\x74\x61\164\x75\163" => $status, "\x6d\145\x73\163\141\147\x65" => $message, "\x64\142\x4f\x75\x74\160\165\x74\114\157\x67" => $outputLog->fetch()]; } private function sqlite($outputLog) { if (!DB::connection() instanceof SQLiteConnection) { goto VZkgH; } $database = DB::connection()->getDatabaseName(); if (file_exists($database)) { goto C6xNM; } touch($database); DB::reconnect(Config::get("\x64\141\164\141\142\x61\163\145\x2e\x64\x65\146\x61\x75\154\164")); C6xNM: $outputLog->write("\125\163\151\156\x67\40\123\161\x6c\x4c\x69\x74\x65\x20\144\x61\164\141\142\141\163\145\x3a\40" . $database, 1); VZkgH: } }