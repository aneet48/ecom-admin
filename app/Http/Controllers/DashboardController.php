<?php

namespace App\Http\Controllers;

use App\Event;
use App\Product;
use App\University;
use App\User;
use App\UserVisits;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class DashboardController extends Controller
{
    public function getBlockData()
    {
        $data = [];

        // first block
        $colleges_count = University::count();
        $colleges_having_user_count = University::whereHas('students')->count();
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
            'id' => 2,
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
        $percent = $repeated_users / $students * 100;
        $data[] = [
            'id' => 3,
            'title' => "Repeated Users ",
            'amount' => $repeated_users,
            'subtitle' => round($percent, 2) . ' %',
            'bgFirstColor' => '#f56527',
            'bgSecondColor' => '#fdba35',
        ];

        return response()->json($data);
    }

    public function getstudents_new_uni(Request $request)
    {
        $students_new_uni = University::withCount('newStudents')->whereHas(
            'newStudents')->orderBy('new_students_count', 'desc')->paginate(15);

        return response()->json($students_new_uni);

    }
    public function getfeatures_chart(Request $request)
    {
        $repeated_users = UserVisits::whereDate('created_at', Carbon::today())
            ->withCount('users')
            ->select(DB::raw('count(*) as total'), 'feature')
            ->groupBy('feature')
            ->get();
        $total = $repeated_users->pluck('total');
        $feature = $repeated_users->pluck('feature');
        $data = [
            'total' => $total,
            'feature' => $feature,
        ];
        return response()->json($data);

    }
    public function getproducts_today(Request $request)
    {
        $repeated_users = Product::whereDate('created_at', Carbon::today())
            ->with('category')
            ->select(DB::raw('count(*) as total'), 'category_id')
            ->groupBy('category_id')
            ->get();
            
        $total = $repeated_users->pluck('total');
        $category = $repeated_users->pluck('category.name');
        $data = [
            'total' => $total,
            'category' => $category,
        ];
        return response()->json($data);

    }
    public function getevents_today(Request $request)
    {
        $repeated_users = Event::whereDate('created_at', Carbon::today())
            ->with('category')
            ->select(DB::raw('count(*) as total'), 'category_id')
            ->groupBy('category_id')
            ->get();
            
        $total = $repeated_users->pluck('total');
        $category = $repeated_users->pluck('category.name');
        $data = [
            'total' => $total,
            'category' => $category,
        ];
        return response()->json($data);

    }
}
