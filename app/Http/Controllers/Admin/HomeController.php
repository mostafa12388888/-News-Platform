<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;


class HomeController extends Controller
{
    public function index()
    {
        $chart_options = [
            'chart_title' => 'Posts by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Post',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_days' => 3600, // show only last 30 days
        ];
        $postsChart = new LaravelChart($chart_options);
        $chart_options2 = [
            'chart_title' => 'Users by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'pie',
            'filter_field' => 'created_at',
            'filter_days' => 360, // show only last 30 days
        ];
        $usersChart = new LaravelChart($chart_options2);
        return view('admin.index', compact('postsChart','usersChart'));
    }
}
