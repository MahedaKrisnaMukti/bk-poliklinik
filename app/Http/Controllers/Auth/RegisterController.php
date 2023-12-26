<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Validations\Auth\RegisterValidation;
use App\Services\Auth\RegisterService;

class RegisterController extends Controller
{
    /**
     * Validation instance.
     *
     * @var \App\Validations\Auth\RegisterValidation
     */
    protected $registerValidation;

    /**
     * Service instance.
     *
     * @var \App\Services\Auth\RegisterService
     */
    protected $registerService;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(RegisterValidation $registerValidation, RegisterService $registerService)
    {
        $this->registerValidation = $registerValidation;
        $this->registerService = $registerService;
    }

    /**
     * Index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.register.index', [
            'title' => 'BK Poliklinik',
            'description' => '',
            'keywords' => '',
        ]);
    }

    /**
     * Registration.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registration(Request $request)
    {
        $validation = $this->registerValidation->registration($request);

        if ($validation->status == false) {
            return redirect()->back()->with($validation->statusAlert, $validation->message);
        }

        $result = $this->registerService->registration($request);

        return redirect()->intended('/')->with($result->statusAlert, $result->message);
    }
}
