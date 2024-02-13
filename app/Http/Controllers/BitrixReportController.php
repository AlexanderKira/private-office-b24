<?php

namespace App\Http\Controllers;

use App\Helpers\BitrixReportHelpers;
use App\Http\Requests\BitrixReportRequest;
use App\Models\BitrixReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Inertia\Inertia;

class BitrixReportController extends controller
{
    public function index(Request $request, BitrixReport $report): \Inertia\Response
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        if (!$endDate) {
            $endDate = Date::today()->format('Y-m-d');
        }

        $search = $request->query('search');
        $query = $report->where('channel_name', 'LIKE', "%$search%");

        if ($startDate && $endDate) {
            $startDateFormatted = Carbon::parse($startDate)->startOfDay();
            $endDateFormatted = Carbon::parse($endDate)->endOfDay();

            $query->whereBetween('created_at', [$startDateFormatted, $endDateFormatted]);
        }

        $reports = $query->get();

        $totalReport = BitrixReportHelpers::totalReport($reports);

        return Inertia::render('Dashboard', compact('reports', 'totalReport'));
    }

}
