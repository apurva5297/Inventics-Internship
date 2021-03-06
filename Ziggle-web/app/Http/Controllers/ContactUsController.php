<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use App\Jobs\SendContactFromMessageToAdmin;
use App\Http\Requests\Validations\ContactUsRequest;

class ContactUsController extends Controller
{
    private $model;

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = trans('app.model.message');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send(ContactUsRequest $request)
    {
        $message = Message::create($request->all());

        // Dispatching SendContactFromMessageToAdmin job
        SendContactFromMessageToAdmin::dispatch($message);

        if($request->ajax())
            return response(trans('messages.sent', ['model' => $this->model]), 200);

       return back()->with('success', trans('messages.sent', ['model' => $this->model]));
    }

}
