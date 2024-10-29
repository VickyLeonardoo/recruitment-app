<?php

namespace App\Http\Controllers\Admin;

use App\Models\JobVacancy;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        $jobCount = JobVacancy::where('status', 'Active')->count();
    
        // Hitung aplikasi hari ini
        $aplCountToday = Application::whereDate('created_at', Carbon::today())->count();
    
        // Hitung aplikasi minggu ini (Senin - Minggu)
        $startOfWeek = Carbon::now()->startOfWeek(); // Senin
        $endOfWeek = Carbon::now()->endOfWeek();     // Minggu
        $aplCountThisWeek = Application::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
    
        return view('admin.index', [
            'title' => 'Dashboard',
            'active' => true,
            'jobCount' => $jobCount,
            'aplToday' => $aplCountToday,
            'aplThisWeek' => $aplCountThisWeek,
            'breadcrump' => Breadcrumbs::render('Dashboard'),
        ]);
    }
}
