<?php

namespace App\Http\Controllers;

use App\Models\TransOrderDetails;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function report(){
        $title = 'Report';
        $details = TransOrderDetails::with(['order.customer', 'service'])->get();
        return view('report.index', compact('details', 'title'));
    }

    public function reportFilter(Request $request)
    {
        $title = 'Report';

        if ($request->date_start && $request->date_end) {
            $startDate = $request->date_start;
            $endDate = $request->date_end;

            $details = TransOrderDetails::with(['order.customer', 'service'])
                ->whereHas('order', function ($query) use ($startDate, $endDate) {
                    $query->whereDate('order_date', '>=', $startDate)
                        ->whereDate('order_date', '<=', $endDate);
                })
                ->get();

            return view('report.index', compact('title', 'details'));
        }

        $details = TransOrderDetails::with(['order.customer', 'service'])->get();
        return view('report.index', compact('details', 'title'));
    }
}
