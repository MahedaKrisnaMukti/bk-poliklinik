<?php

namespace App\Http\Controllers\Dashboard\MainMenu;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Services\Dashboard\MainMenu\MainMenuService;

class MainMenuController extends Controller
{
    /**
     * Service instance.
     *
     * @var \App\Services\Dashboard\MainMenu\MainMenuService
     */
    protected $mainMenuService;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(MainMenuService $mainMenuService)
    {
        $this->mainMenuService = $mainMenuService;
    }

    /**
     * Index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.main-menu.index', [
            'title' => 'BK Poliklinik',
            'description' => '',
            'keywords' => '',
        ]);
    }

    /**
     * Profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $result = $this->mainMenuService->profile();

        return view($result->view, [
            'title' => 'BK Poliklinik',
            'description' => '',
            'keywords' => '',
            'user' => $result->user,
            'admin' => $result->admin,
            'doctor' => $result->doctor,
            'patient' => $result->patient,
        ]);
    }

    /**
     * Update profile.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $result = $this->mainMenuService->updateProfile($request);

        return redirect()->back()->with($result->statusAlert, $result->message);
    }
}
