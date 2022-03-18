<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $dpto = Departamento::count();
        $user = User::count();
        $post = Post::count();
        return view('admin.home',[
            'dpto'=> $dpto,
            'user' =>$user,
            'doc' => $post
        ]);
    }
}
