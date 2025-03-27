<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        // Penghasilan harian
        $dailyIncome = Order::whereDate('created_at', Carbon::today())
            ->where('status', 'done')
            ->sum('total_price');

        // Penghasilan mingguan
        $weeklyIncome = Order::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
        ])
            ->where('status', 'done')
            ->sum('total_price');

        // Penghasilan bulanan
        $monthlyIncome = Order::whereMonth('created_at', Carbon::now()->month)
            ->where('status', 'done')
            ->sum('total_price');

        // Kirim data ke view
        return view('report.index', compact('dailyIncome', 'weeklyIncome', 'monthlyIncome'));
    }
}
