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
 namespace App\Http\Controllers\Installer; use Illuminate\Routing\Controller; use Illuminate\Http\Request; use Illuminate\Routing\Redirector; use App\Http\Controllers\Installer\Helpers\EnvironmentManager; use Validator; class EnvironmentController extends Controller { protected $EnvironmentManager; public function __construct(EnvironmentManager $environmentManager) { $this->EnvironmentManager = $environmentManager; } public function environmentMenu() { return view("\151\156\163\164\141\154\x6c\145\x72\56\x65\x6e\166\x69\162\x6f\156\x6d\x65\x6e\x74"); } public function environmentWizard() { } public function environmentClassic() { $envConfig = $this->EnvironmentManager->getEnvContent(); return view("\151\x6e\x73\x74\x61\154\x6c\145\x72\56\x65\156\x76\x69\162\x6f\156\x6d\145\156\164\x2d\143\x6c\141\x73\163\x69\x63", compact("\145\156\166\103\157\x6e\x66\151\147")); } public function saveClassic(Request $input, Redirector $redirect) { $message = $this->EnvironmentManager->saveFileClassic($input); return $redirect->route("\x49\156\163\x74\x61\x6c\154\145\162\56\x65\x6e\x76\x69\162\x6f\156\155\x65\156\x74\103\x6c\x61\163\x73\151\143")->with(["\x6d\145\163\163\141\x67\x65" => $message]); } }
