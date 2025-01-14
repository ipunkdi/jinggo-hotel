<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalDataRevenue = Dashboard::Revenue();
        $totalDataNewCustomer = Dashboard::NewCustomer();
        $totalDataNewOrder = Dashboard::NewOrder();
        $totalDataOrder = Dashboard::OrderPermont();
        $totalDataCustomer = Dashboard::TotalDataCustomer();
        $dataBulan = Dashboard::DataBulan();


        return view('dashboard', [
            'title' => 'Dashboard',
            'dataBulan' => $dataBulan,
            'totalDataRevenue' => $totalDataRevenue,
            'totalDataNewCustomer' => $totalDataNewCustomer,
            'totalDataNewOrder' => $totalDataNewOrder,
            'totalDataCustomer' => $totalDataCustomer,
            'totalDataOrder' => $totalDataOrder
        ]);
    }
}
