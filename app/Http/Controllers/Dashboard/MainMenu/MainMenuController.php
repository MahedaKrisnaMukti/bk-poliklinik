<?php

namespace App\Http\Controllers\Dashboard\MainMenu;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class MainMenuController extends Controller
{
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
}
