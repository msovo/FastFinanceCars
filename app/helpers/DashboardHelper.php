<?php

namespace App\Helpers;

class DashboardHelper
{
    public static function getMetricIcon($key)
    {
        $icons = [
            'dealers' => 'users',
            'active_listings' => 'list',
            'total_sales' => 'shopping-cart',
            'total_revenue' => 'dollar-sign',
            'total_inquiries' => 'envelope',
            'conversion_rate' => 'chart-line',
            'average_response_time' => 'clock',
            // Add more icons as needed
            'views' => 'eye',
            'leads' => 'funnel',
            'performance' => 'tachometer-alt',
            'inventory' => 'warehouse',
            'market_share' => 'chart-pie',
            'trends' => 'chart-line',
            'predictions' => 'crystal-ball'
        ];
        
        return $icons[$key] ?? 'chart-bar';
    }

    public static function formatCurrency($amount)
    {
        return 'R' . number_format($amount, 2);
    }

    public static function formatPercentage($value)
    {
        return number_format($value, 1) . '%';
    }

    public static function formatNumber($number)
    {
        return number_format($number);
    }

    public static function getMetricColor($value, $type)
    {
        switch ($type) {
            case 'growth':
                return $value > 0 ? 'text-success' : ($value < 0 ? 'text-danger' : 'text-warning');
            case 'performance':
                return $value >= 80 ? 'text-success' : ($value >= 50 ? 'text-warning' : 'text-danger');
            default:
                return 'text-primary';
        }
    }
}