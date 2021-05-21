<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Bank;
use App\Product;
use App\Wallet;
use App\Transaction;
use App\Common\Authorizable;
use Illuminate\Http\Request;
use App\Events\User\UserCreated;
use App\Events\User\UserUpdated;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Events\Profile\PasswordUpdated;
use App\Repositories\User\UserRepository;
use App\Http\Requests\Validations\CreateUserRequest;
use App\Http\Requests\Validations\UpdateUserRequest;
use App\Http\Requests\Validations\AdminUserUpdatePasswordRequest as UpdatePasswordRequest;

class FetchController extends Controller
{
    use Authorizable;

    public function getProducts_ethnicbazaar()
    {
        $url='https://www.ethnicbazaar.com/api/getProducts';

        $crl = curl_init();
        
        curl_setopt($crl, CURLOPT_URL, $url);
        curl_setopt($crl, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($crl);
        $response_data = json_decode($response);
        curl_close($crl);

        return $response_data;

        // DB::table('data_sync_records')->create([
        //     'source' => 'Ethnicbazaar',
        //     'table_name' => 'products',
        //     'table_name' => 'products',
        // ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
       //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
       //
    }


}