<?php

namespace App\Components\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index() {
        return view('admin.template.index', [
            'meta_title' => 'Панель управления'
        ]);
    }
}