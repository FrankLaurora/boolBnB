<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index($id) {
        return view('admin.statistics.index', compact('id'));
    }
}
