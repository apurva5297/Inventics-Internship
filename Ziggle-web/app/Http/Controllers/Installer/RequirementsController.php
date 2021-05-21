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
 namespace App\Http\Controllers\Installer; use Illuminate\Routing\Controller; use App\Http\Controllers\Installer\Helpers\RequirementsChecker; class RequirementsController extends Controller { protected $requirements; public function __construct(RequirementsChecker $checker) { $this->requirements = $checker; } public function requirements() { $phpSupportInfo = $this->requirements->checkPHPversion(config("\151\156\163\164\x61\154\x6c\145\162\56\x63\157\162\x65\56\155\151\156\120\150\x70\126\x65\162\163\x69\x6f\156"), config("\x69\156\163\x74\141\154\x6c\x65\162\56\x63\x6f\x72\x65\56\155\x61\170\120\150\160\126\x65\x72\163\x69\x6f\x6e")); $requirements = $this->requirements->check(config("\151\x6e\163\164\x61\154\x6c\145\162\x2e\162\x65\161\165\x69\x72\x65\x6d\145\156\164\163")); return view("\151\x6e\x73\164\141\x6c\x6c\145\162\56\x72\145\161\x75\x69\162\145\x6d\145\x6e\x74\x73", compact("\x72\145\x71\165\151\x72\x65\155\145\156\164\163", "\x70\150\x70\x53\165\160\160\x6f\x72\x74\111\x6e\146\x6f")); } }
