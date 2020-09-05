<?php

namespace App\Http\Controllers;

use App\University;
use App\User;
use App\UserVisits;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getBlockData()
    {
        $data = [];

        // first block
        $colleges_count = University::count();
        $colleges_having_user_count = University::whereHas('products')->count();
        $data[] = [
            'id' => 1,
            'title' => "Total Colleges",
            'amount' => $colleges_count,
            'subtitle' => $colleges_having_user_count . ' with users',
            'bgFirstColor' => '#365db2',
            'bgSecondColor' => '#3ab6cb',
        ];

        // second block
        $students = User::count();
        $students_new = User::whereDate('created_at', Carbon::today())->count();
        $data[] = [
            'id' => 1,
            'title' => "Total Users",
            'amount' => $students,
            'subtitle' => $students_new . ' new today',
            'bgFirstColor' => '#54b249',
            'bgSecondColor' => '#c6d65f',
        ];

        // third block
        $repeated_users = UserVisits::whereDate('created_at', Carbon::today())
            ->select(DB::raw('count(*) as total'))
            ->groupBy('user_id')->get()->count();
        $percent = $repeated_users/$students*100;
        $data[] = [
            'id' => 1,
            'title' => "Repeated Users ",
            'amount' => $repeated_users,
            'subtitle' =>  round($percent,2) . ' %',
            'bgFirstColor' => '#54b249',
            'bgSecondColor' => '#c6d65f',
        ];

        // dd($repeated_users);
        return response()->json($data);
    }
}
