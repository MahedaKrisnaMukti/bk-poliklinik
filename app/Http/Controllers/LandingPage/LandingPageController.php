<?php

namespace App\Http\Controllers\LandingPage;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class LandingPageController extends Controller
{
    /**
     * Index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('landing-page.index', [
            'title' => 'BK Poliklinik',
            'description' => '',
            'keywords' => '',
        ]);
    }
}
