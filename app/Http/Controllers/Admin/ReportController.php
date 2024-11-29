<?php
// app/Http/Controllers/Admin/ReportController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function analytics()
    {
        return view('admin.reports.analytics');
    }
}
