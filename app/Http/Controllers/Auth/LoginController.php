<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Validations\Auth\LoginValidation;
use App\Services\Auth\LoginService;

class LoginController extends Controller
{
    /**
     * Validation instance.
     *
     * @var \App\Validations\Auth\LoginValidation
     */
    protected $loginValidation;

    /**
     * Service instance.
     *
     * @var \App\Services\Auth\LoginService
     */
    protected $loginService;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(LoginValidation $loginValidation, LoginService $loginService)
    {
        $this->loginValidation = $loginValidation;
        $this->loginService = $loginService;
    }

    /**
     * Index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login.index', [
            'title' => 'BK Poliklinik',
            'description' => '',
            'keywords' => '',
        ]);
    }

    /**
     * Authenticate.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $validation = $this->loginValidation->authenticate($request);

        if ($validation->status == false) {
            return redirect()->back()->with($validation->statusAlert, $validation->message);
        }

        $result = $this->loginService->authenticate($request);

        $request->session()->regenerate();
        return redirect()->intended('/menu-utama')->with($result->statusAlert, $result->message);
    }

    /**
     * Logout.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->loginService->logout($request);

        return redirect('/login');
    }
}
