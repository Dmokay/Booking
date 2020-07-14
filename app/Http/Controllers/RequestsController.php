<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::select(DB::raw('count(*) as count'), 'names', 'phone', 'status', 'created_at', 'id', 'service_id')
            ->groupBy('request_id')->paginate(100);
        return view('Request.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Request.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request_id = Str::uuid()->toString();
        foreach ($request->names as $index => $attendee) {
            Booking::create([
                'request_id' => $request_id,
                'names' => $attendee,
                'phone' => $request->phone[$index],
                'service_id' => $request->service_id
            ]);
        }
        return redirect()->back()->withStatus("Request Successfully Received");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function approve_request($id, Request $request)
    {
        $booking = Booking::with('service')->findOrFail($id);
        $approved = $booking->service->approved->count();
        if ($approved >= 100) {
            return redirect()->back()->withError("Maximum Approval limit reached!");
        }

        $related_bookings = Booking::where('request_id', $booking->request_id)->get();
        foreach ($related_bookings as $attendee) {
            if ($request->status == 1) {
                $attendee->update(['status' => Booking::STATUS_APPROVED]);
            } elseif ($request->status == -1) {
                $attendee->update(['status' => Booking::STATUS_REJECTED]);
            }
        }
        return redirect()->back()->withStatus("Successfully approved!");
    }
}
