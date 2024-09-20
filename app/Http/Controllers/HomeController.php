<?php

namespace App\Http\Controllers;


use App\Enums\MenuEnum;
use App\Models\District;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function welcome(): View
    {
        $districts = District::cached();
        $menu = MenuEnum::MAIN;
        return view(
            'home',
            compact('districts', 'menu')
        );
    }

    public function district(Request $request): View
    {
        $code = explode('/', $request->getRequestUri())[1];
        $districts = District::cached();
        $menu = MenuEnum::SHOW;
        return view(
            'home',
            compact('districts', 'code', 'menu')
        );
    }

    public function about(Request $request): View
    {
        $code = explode('/', $request->getRequestUri())[1];
        $districts = District::cached();
        $menu = MenuEnum::ABOUT;
        return view(
            'home',
            compact('districts', 'code', 'menu')
        );
    }

    public function news(Request $request): View
    {
        $code = explode('/', $request->getRequestUri())[1];
        $districts = District::cached();
        $menu = MenuEnum::NEWS;
        return view(
            'home',
            compact('districts', 'code', 'menu')
        );
    }
}
