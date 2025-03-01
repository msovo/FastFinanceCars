<?php

namespace App\Helpers;

if (!function_exists('getResponseTimeClass')) {
    function getResponseTimeClass($minutes)
    {
        if ($minutes <= 30) return 'bg-success';
        if ($minutes <= 60) return 'bg-info';
        if ($minutes <= 120) return 'bg-warning';
        return 'bg-danger';
    }
}

if (!function_exists('getTurnoverClass')) {
    function getTurnoverClass($rate)
    {
        if ($rate >= 4) return 'bg-success';
        if ($rate >= 2) return 'bg-info';
        if ($rate >= 1) return 'bg-warning';
        return 'bg-danger';
    }
}

if (!function_exists('getTurnoverPercentage')) {
    function getTurnoverPercentage($rate)
    {
        return min(100, $rate * 25); // 4x turnover = 100%
    }
}

if (!function_exists('getResponseTimePercentage')) {
    function getResponseTimePercentage($minutes)
    {
        return min(100, ($minutes / 120) * 100); // 120 minutes = 100%
    }
}

if (!function_exists('formatDuration')) {
    function formatDuration($minutes)
    {
        if ($minutes < 60) {
            return $minutes . ' mins';
        }
        
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;
        
        if ($hours < 24) {
            return $hours . 'h ' . $remainingMinutes . 'm';
        }
        
        $days = floor($hours / 24);
        $remainingHours = $hours % 24;
        
        return $days . 'd ' . $remainingHours . 'h';
    }
}

if (!function_exists('getAgeClass')) {
    function getAgeClass($days)
    {
        if ($days <= 30) return 'text-success';
        if ($days <= 60) return 'text-warning';
        if ($days <= 90) return 'text-info';
        return 'text-danger';
    }
}

if (!function_exists('calculateInventoryHealth')) {
    function calculateInventoryHealth($aging, $turnover)
    {
        $score = 0;
        
        // Score based on aging
        if ($aging <= 30) $score += 50;
        elseif ($aging <= 60) $score += 35;
        elseif ($aging <= 90) $score += 20;
        else $score += 5;
        
        // Score based on turnover
        if ($turnover >= 4) $score += 50;
        elseif ($turnover >= 2) $score += 35;
        elseif ($turnover >= 1) $score += 20;
        else $score += 5;
        
        return [
            'score' => $score,
            'status' => getHealthStatus($score),
            'color' => getHealthColor($score)
        ];
    }
}

if (!function_exists('getHealthStatus')) {
    function getHealthStatus($score)
    {
        if ($score >= 80) return 'Excellent';
        if ($score >= 60) return 'Good';
        if ($score >= 40) return 'Fair';
        return 'Poor';
    }
}

if (!function_exists('getHealthColor')) {
    function getHealthColor($score)
    {
        if ($score >= 80) return 'success';
        if ($score >= 60) return 'info';
        if ($score >= 40) return 'warning';
        return 'danger';
    }
}

if (!function_exists('getPerformanceColor')) {
    function getPerformanceColor($score)
    {
        if ($score >= 80) return 'success';
        if ($score >= 60) return 'info';
        if ($score >= 40) return 'warning';
        return 'danger';
    }
}