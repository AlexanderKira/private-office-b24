<?php

namespace App\Console\Commands;

use App\Bitrix24\Bitrix24API;
use App\Bitrix24\Bitrix24APIException;
use App\Helpers\BitrixReportHelpers;
use App\Models\BitrixReport;
use Exception;
use Illuminate\Console\Command;


class UpBitrixReportOnceADay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:up-bitrix-report-once-a-day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws Bitrix24APIException
     */
    public function handle(): void
    {

        $leadList = $this->webhook()->fetchLeadList();

        foreach ($leadList as $leads) {
            $filteredArray = $this->filteredLeads($leads);
        }

        $qualityLeads = array_filter($filteredArray, function($item) {
            return $item["STATUS_ID"] === "CONVERTED";
        });

        $qualitySourceIds = array_column($qualityLeads, 'SOURCE_ID');
        $qualityCounts = array_count_values($qualitySourceIds);

        $allSourceIds = array_column($filteredArray, 'SOURCE_ID');
        $allCounts = array_count_values($allSourceIds);

        $sumArray = [];
        $salesArray = [];

        foreach ($filteredArray as $item) {
            $sourceId = $item["SOURCE_ID"];
            $opportunity = floatval($item["OPPORTUNITY"]);

            if (isset($sumArray[$sourceId])) {
                $sumArray[$sourceId] += $opportunity;
                $salesArray[$sourceId] += 1;
            } else {
                $sumArray[$sourceId] = $opportunity;
                $salesArray[$sourceId] = 1;
            }
        }

        foreach ($sumArray as $sourceId => $opportunity) {

            foreach ($allCounts as $key => $value){
                if($key === $sourceId){
                    $application = $value;
                }
            }

            foreach ($qualityCounts as $key => $value){
                if($key === $sourceId){
                    $sales = $value;
                }
            }

            //убытки 1000р

            BitrixReport::create([
                'channel_name' => $sourceId,
                'application' => $application,
                'revenue' => $opportunity,
                'sales' => $sales,
                'conversion_to_sales' => BitrixReportHelpers::conversionToSales($sales, $application),
                'average_check' => BitrixReportHelpers::averageCheck($opportunity, $salesArray[$sourceId]),
                'profit' => BitrixReportHelpers::profit($opportunity, 1000),
            ]);
        }

    }

    public function webhook(): Bitrix24API
    {
        $webhookURL = 'https://b24-c99rni.bitrix24.ru/rest/1/sxcik2swtvxpivik/';

        return new Bitrix24API($webhookURL);
    }

    public function filteredLeads($leads): array
    {
        return array_map(function($item) {
            if ($item["SOURCE_ID"] === null) {
                $item["SOURCE_ID"] = 'UNKNOWN CHANNEL';
            }
            return [
                "SOURCE_ID" => $item["SOURCE_ID"],
                "OPPORTUNITY" => $item["OPPORTUNITY"],
                "STATUS_ID" => $item["STATUS_ID"]
            ];
        }, $leads);
    }

}




