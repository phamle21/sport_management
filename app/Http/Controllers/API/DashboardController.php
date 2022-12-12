<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BookingGround;
use App\Models\Ground;
use App\Models\League;
use App\Models\Sponsorship;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tourList = League::all()->sortByDesc('create_at');
        foreach ($tourList as $tour) {
            $tour->datetime = date('d/m/Y H:i:s', strtotime($tour->created_at));
        }
        $sponsorship = Sponsorship::all();
        $bookingground = BookingGround::all();

        $grounds = Ground::all();



        $dashboard = [
            'listTour' => $tourList,
            'totalTour' => count($tourList),
            'totalSponsorAmount' => $sponsorship->sum('sponsor_payment_amount') + $bookingground->sum('price'),
            'grounds' => $grounds,
        ];

        return response()->json([
            'data' => $dashboard
        ]);
    }
}
