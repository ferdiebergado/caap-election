<?php

namespace App\Http\Controllers;

use App\Office;
use Illuminate\Http\Request;
use App\Helpers\DataTableHelper;
use App\Helpers\RequestCriteria;
use App\Helpers\RequestParser;

class OfficeController extends Controller
{
    use RequestParser;
    use RequestCriteria;
    use DataTableHelper;

    protected $indexroute = 'offices.index';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offices = $this->datatablePaginate('App\Office');

        if (request()->wantsJson()) {
            return response()->json([
                'draw' => $offices['draw'],
                'data' => $offices['model'],
            ]);
        }
        $route = $this->indexroute;
        $offices = $offices['model'];
        return view('office.index', compact('offices', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function edit(Office $office)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Office $office)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office $office)
    {
        //
    }
}
