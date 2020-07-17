<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Helpers\Helper;
use App\Service;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use SebastianBergmann\Comparator\Book;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $requests_today = Booking::whereDate('created_at', Carbon::now()->toDateString())->count();
        $approved_today = Booking::whereDate('updated_at', Carbon::now()->toDateString())
            ->where('status', Booking::STATUS_APPROVED)->count();
        $rejected_today = Booking::whereDate('updated_at', Carbon::now()->toDateString())
            ->where('status', Booking::STATUS_REJECTED)
            ->count();
        $services = Service::where('status', true)->count();
        return view('welcome', compact('requests_today', 'approved_today', 'rejected_today', 'services'));
    }

    public function test(){
        $response = Helper::getNextSeat(5, 1, 42);
        dd($response);
    }
}
