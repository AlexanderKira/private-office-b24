<?php

namespace Database\Factories;

use App\Helpers\BitrixReportHelpers;
use Illuminate\Database\Eloquent\Factories\Factory;

class BitrixReportFactory extends Factory
{

    public function definition(): array
    {

        $basicRepresentation = $this->basicRepresentation();

        return [
            'channel_name' => $this->channelName(),
            'application' => $basicRepresentation['application'],
            'conversion_to_sales' => BitrixReportHelpers::conversionToSales($basicRepresentation['quality_lead'], $basicRepresentation['application']),
            'sales' => $basicRepresentation['quality_lead'],
            'revenue' => $basicRepresentation['revenue'],
            'average_check' => BitrixReportHelpers::averageCheck($basicRepresentation['revenue'], $basicRepresentation['quality_lead']),
            'profit' => BitrixReportHelpers::profit($basicRepresentation['revenue'], $basicRepresentation['costs']),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeThisYear
        ];
    }

    public function basicRepresentation(): array
    {

        $application = $this->application();

        $qualityLead = $this->faker->numberBetween(1, $application);

        $revenue = BitrixReportHelpers::revenue($qualityLead, $this->orderAmount());

        return [
            'application' => $application,
            'costs' => $this->costs(),
            'quality_lead' => $qualityLead,
            'revenue' => $revenue
        ];
    }

    public function channelName(): ?string
    {
        $channels = ['новый сайт', 'звонки', 'созданные в ручную'];
        return $this->faker->randomElement($channels);
    }

    public function application(): int
    {
        return $this->faker->numberBetween(1, 1000);
    }

    public function orderAmount(): float
    {
        return $this->faker->randomFloat(2, 0, 10000);
    }

    public function costs(): float
    {
        return $this->faker->randomFloat(2, 0, 100000);
    }

}
