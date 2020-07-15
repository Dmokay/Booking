<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Helpers\Helper;
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
    public function index(Request $request)
    {
        $bookings = Booking::select(DB::raw('count(*) as count'), 'names', 'phone', 'status', 'created_at', 'id', 'service_id');
        //search
        if ($request->filled('phone') && $request->phone != "")
            $bookings = $bookings->where('phone', Helper::formatNumber($request->phone));
        if ($request->filled('names') && $request->names != "")
            $bookings = $bookings->where('names', 'like', '%'.$request->names.'%');
        if ($request->filled('service_id') && $request->service_id != "")
            $bookings = $bookings->where('service_id', $request->service_id);
        if ($request->filled('status') && $request->status != "")
            $bookings = $bookings->where('status', $request->status);
        $bookings = $bookings->with('service')->groupBy('request_id')->orderBy('created_at', 'desc')->paginate(100);
        $services = Service::latest()->get();
        return view('Request.index', compact('bookings', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::where('status', true)->orderBy('when')->get();
        return view('Request.request-attendance', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->filled('service_id'))
            return redirect()->back()->withError("Please select a service!");
        if (!$request->filled('attendees'))
            return redirect()->back()->withError("Please select number of attendees!");
        $request_id = Str::uuid()->toString();
        foreach ($request->names as $index => $attendee) {
            Booking::create([
                'request_id' => $request_id,
                'names' => $attendee,
                'phone' => Helper::formatNumber($request->phone[$index]),
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
        $related_bookings = Booking::where('request_id', $booking->request_id)->get();
        if (($approved + count($related_bookings)) > $booking->service->count && $request->status == 1) {
            return redirect()->back()->withError("Maximum Approval limit can't be exceeded!");
        }
        foreach ($related_bookings as $attendee) {
            if ($request->status == 1) {
                $attendee->update(['status' => Booking::STATUS_APPROVED]);
            } elseif ($request->status == -1) {
                $attendee->update(['status' => Booking::STATUS_REJECTED]);
            }
        }
        return redirect()->back()->withStatus("Request updated!");
    }

    public function validate_attendance(Request $request)
    {
        $phone = Helper::formatNumber($request->phone);
        $bookings = Booking::where('phone', $phone)->latest()->get();
        $phone = $request->phone;
        return view('Request.validate-attendance', compact('bookings', 'phone'));
    }
}
