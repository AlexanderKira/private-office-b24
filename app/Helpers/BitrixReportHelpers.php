<?php

namespace App\Helpers;

class BitrixReportHelpers
{
    public static function conversionToSales($qualityLead, $application): float|int
    {
        return round($qualityLead / $application * 100,2);
    }

    public static function revenue($qualityLead, $orderAmount): float|int
    {
        return round($orderAmount * $qualityLead,2);
    }

    public static function averageCheck($revenue, $qualityLead): float|int
    {
        return round($revenue / $qualityLead,2);
    }

    public static function profit($revenue, $costs): float
    {
        return round($revenue - $costs,2);
    }

    public static function totalReport($reports): array
    {
        $totalReport = [];
        $totalApplications = 0;
        $totalSales = 0;
        $totalRevenue = 0;
        $totalProfit = 0;

        foreach ($reports as $report) {
            $totalReport = [
                'totalApplication' => $totalApplications += $report['application'],
                'totalSales' => $totalSales += $report['sales'],
                'totalRevenue' => round($totalRevenue += $report['revenue'],2),
                'totalProfit' => round($totalProfit += $report['profit'],2),
                'costs' => round($totalRevenue - $totalProfit, 2),
                'average_check' => round($totalRevenue / $totalSales, 2),
                'conversion_to_sales' => round(($totalSales / $totalApplications) * 100, 2),
                'roi' => round(($totalRevenue - ($totalRevenue - $totalProfit)) / ($totalRevenue - $totalProfit) * 100, 2)
            ];
        }

        return $totalReport;
    }


}
