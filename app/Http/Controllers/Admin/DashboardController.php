<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Diglactic\Breadcrumbs\Breadcrumbs;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.index',[
            'title' => 'Dashboard',
            'active' => true,
            'breadcrump' => Breadcrumbs::render('Dashboard'),
        ]);
    }
}
