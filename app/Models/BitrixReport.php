<?php

namespace App\Models;

use Database\Factories\BitrixReportFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class BitrixReport extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $table = 'bitrix_reports';

    protected $fillable = [
        'id',
        'channel_name',
        'application',
        'conversion_to_sales',
        'sales',
        'revenue',
        'average_check',
        'profit',
        'roi',
        'created_at',
    ];

    protected static function newFactory(): Factory
    {
        return BitrixReportFactory::new();
    }

}
