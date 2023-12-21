<?php

namespace App\Http\Controllers\Website\Report;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    public function index()
    {
        $data = $this->report->getData();
        return view('website.report.report', compact('data'));
    }
}
