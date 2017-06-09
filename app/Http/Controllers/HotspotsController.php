<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HotspotService;
use App\Http\Requests\HotspotCreateRequest;
use App\Http\Requests\HotspotUpdateRequest;

class HotspotsController extends Controller
{
    public function __construct(HotspotService $hotspot_service)
    {
        $this->service = $hotspot_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hotspots = $this->service->paginated();
        return view('hotspots.index')->with('hotspots', $hotspots);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $hotspots = $this->service->search($request->search);
        return view('hotspots.index')->with('hotspots', $hotspots);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hotspots.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\HotspotCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HotspotCreateRequest $request)
    {
        $result = $this->service->create($request->except('_token'));

        if ($result) {
            return redirect(route('hotspots.edit', ['id' => $result->id]))->with('message', 'Successfully created');
        }

        return redirect(route('hotspots.index'))->with('message', 'Failed to create');
    }

    /**
     * Display the hotspot.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hotspot = $this->service->find($id);
        return view('hotspots.show')->with('hotspot', $hotspot);
    }

    /**
     * Show the form for editing the hotspot.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hotspot = $this->service->find($id);
        return view('hotspots.edit')->with('hotspot', $hotspot);
    }

    /**
     * Update the hotspots in storage.
     *
     * @param  \Illuminate\Http\HotspotUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HotspotUpdateRequest $request, $id)
    {
        $result = $this->service->update($id, $request->except('_token'));

        if ($result) {
            return back()->with('message', 'Successfully updated');
        }

        return back()->with('message', 'Failed to update');
    }

    /**
     * Remove the hotspots from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->service->destroy($id);

        if ($result) {
            return redirect(route('hotspots.index'))->with('message', 'Successfully deleted');
        }

        return redirect(route('hotspots.index'))->with('message', 'Failed to delete');
    }
}
