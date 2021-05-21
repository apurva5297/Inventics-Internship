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
 namespace App\Http\Controllers\Installer; use App\Http\Requests; use Illuminate\Routing\Controller; use App\Http\Controllers\Installer\Helpers\PermissionsChecker; class PermissionsController extends Controller { protected $permissions; public function __construct(PermissionsChecker $checker) { $this->permissions = $checker; } public function permissions() { $permissions = $this->permissions->check(config("\x69\x6e\x73\x74\141\154\154\x65\162\x2e\x70\x65\x72\x6d\x69\163\163\151\x6f\x6e\163")); return view("\x69\156\163\x74\141\154\154\x65\162\x2e\160\x65\x72\155\x69\x73\x73\x69\157\156\x73", compact("\x70\x65\162\x6d\x69\163\163\x69\x6f\x6e\163")); } }
