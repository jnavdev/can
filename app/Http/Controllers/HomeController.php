<?php

namespace App\Http\Controllers;

use App\Deal;
use App\Client;
use Carbon\Carbon;
use App\Quotation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $today = Carbon::now();

        $dealsLast30Days = Deal::whereBetween('created_at', [Carbon::now()->subDays(30)->toDateTimeString(), Carbon::now()->toDateTimeString()])->get();
    	$totalDeals = Deal::whereYear('created_at', Carbon::now()->year)->count();
        $rankingClients = Client::withCount('deals')->orderBy('deals_count', 'DESC')->get()->take(10);

        $allQuotations = Quotation::where('state', 'Vigente')->get();

        foreach ($allQuotations as $quotation) {
            if ($today->toDateString() >= $quotation->expiration_date) {
                $quotation->state = 'Caducada';
                $quotation->save();
            }
        }

        return view('frontEnd.home', compact('totalDeals', 'dealsLast30Days', 'rankingClients'));
    }
}
