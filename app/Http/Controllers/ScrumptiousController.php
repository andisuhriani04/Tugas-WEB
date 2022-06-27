<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ScrumptiousController extends Controller
{
    public function index()
    {
        $menu = User::paginate(1);
        if (count($menu) == 0) {
            return view('scrumptious/index');
        } else {
            return view('scrumptious/index', [
                'menu' => $menu,
            ]);
        }
    }
}
