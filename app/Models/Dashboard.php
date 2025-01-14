<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Guest;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    public static function Revenue()
    {
        $tahun = date('Y');
        $bulan = date('m');

        for ($i = 1; $i <= $bulan; $i++) {
            $totalRevenue = Reservation::whereYear('arrival_date', $tahun)
                ->whereMonth('arrival_date', $i)
                ->with(['booking.payments'])
                ->get()
                ->sum(function ($reservation) {
                    return $reservation->booking->sum(function ($booking) {
                        return $booking->payments->sum('amount');
                    });
                });

            $totalDataRevenue[] = $totalRevenue;
        }

        return $totalDataRevenue;
    }

    public static function NewCustomer()
    {
        $tahun = date('Y');
        $bulan = date('m');
        for ($i = 1; $i <= $bulan; $i++) {
            $newCustomer = Guest::whereYear('created_at', $tahun)
                ->whereMonth('created_at', $i)
                ->count();

            $totalDataNewCustomer[] = $newCustomer;
        }
        return $totalDataNewCustomer;
    }

    public static function NewOrder()
    {
        $tahun = date('Y');
        $bulan = date('m');
        for ($i = 1; $i <= $bulan; $i++) {
            $newOrders = Reservation::whereYear('arrival_date', $tahun)
                ->whereMonth('arrival_date', $i)
                ->count();

            $totalDataNewOrder[] = $newOrders;
        }
        return $totalDataNewOrder;
    }

    public static function OrderPermont()
    {
        $tahun = date('Y');
        $bulan = date('m');
        for ($i = 1; $i <= $bulan; $i++) {
            $orderPerbulan = Reservation::whereYear('arrival_date', $tahun)
                ->whereMonth('arrival_date', $i)
                ->count();

            $totalDataOrder[] = $orderPerbulan;
        }
        return $totalDataOrder;
    }

    public static function TotalDataCustomer()
    {
        $tahun = date('Y');
        $bulan = date('m');
        for ($i = 1; $i <= $bulan; $i++) {
            $totalCustomer = Guest::whereYear('created_at', $tahun)
                ->whereMonth('created_at', $i)
                ->count();

            $totalDataCustomer[] = $totalCustomer;
        }
        return $totalDataCustomer;
    }

    public static function DataBulan()
    {
        $bulan = date('m');
        $dataBulan = [];
        for ($i = 1; $i <= $bulan; $i++) {
            $dataBulan[] = Carbon::create()->month($i)->format('F');
        }
        return $dataBulan;
    }
}
