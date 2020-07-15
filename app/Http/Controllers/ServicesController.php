<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Helpers\Helper;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::latest()->get();
        return view('Services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $service = Service::create($request->all());
        return redirect()->route('services.index')->withStatus("Service Successfully Added!");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        if (isset($request->tab) && $request->tab == "requested"){
            $data = Booking::select(DB::raw('count(*) as count'), 'names', 'phone', 'status', 'created_at', 'id')
                ->where('service_id', $id)->whereNotIn('status', [Booking::STATUS_APPROVED])->latest()
                ->groupBy('request_id')->paginate(100);
            return view('Services.requests', compact('service', 'data'));
        } else {
            $data = Booking::where('service_id', $id)->where('status', Booking::STATUS_APPROVED)
                ->orderBy('updated_at', 'desc');
            if (isset($request->export)){
                $file =  Helper::exportResponses($data);
                return response()->download(storage_path("app/public/excel/$file"));
            }
            $data = $data->paginate(100);
            return view('Services.view', compact('service', 'data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('Services.edit', compact('service'));
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
        $service = Service::findOrFail($id);
        $service->update($request->all());
        return redirect()->route('services.show', $service->id)->withStatus("Service Successfully Updated!");
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

    public function toggle($id){
        $service = Service::findOrFail($id);
        $service->update(['status'=>!$service->status]);
        return redirect()->back()->withStatus("Service Updated!");
    }
}
