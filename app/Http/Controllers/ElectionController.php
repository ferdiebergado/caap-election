<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\RequestParser;
use App\Helpers\RequestCriteria;
use App\Helpers\DataTableHelper;
use App\Election;
use Illuminate\Support\Facades\DB;

class ElectionController extends Controller
{
    use RequestParser;
    use RequestCriteria;
    use DataTableHelper;

    protected $indexroute = 'elections.index';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Election::latest()->get();
        if (request()->has('length')) {
            $offices = $this->datatablePaginate('App\Election', ['candidates']);
            $draw = $offices['draw'];
            $data = $offices['data'];
        }

        if (request()->wantsJson()) {
            return response()->json([
                'draw' => $draw ?? null,
                'data' => $data,
            ]);
        }
        $route = $this->indexroute;
        return view('election.index', compact('data', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $election = new Election();
        $route = route('elections.store');
        return view('election.partial', compact('election', 'route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'date' => 'required|date'
        ]);

        DB::beginTransaction();

        try {
            if ($request->active === "on") {
                Election::where('active', true)->update(['active' => false]);
                $request->merge(['active' => true]);
            }
            $election = Election::create($request->all());
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        DB::commit();
        $route = $this->indexroute;
        session()->flash('status', 'New Election successfully recorded in the system.');
        return redirect()->route($route)->with(compact('route'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function show(Election $election)
    {
        return view('election.show', compact('election'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function edit(Election $election)
    {
        $route = route('elections.update', compact('election'));
        return view('election.partial', compact('election', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Election $election)
    {
        $this->validate($request, [
            'title' => 'required',
            'date' => 'required|date'
        ]);

        DB::beginTransaction();

        try {
            $active = false;
            if ($request->filled('active')) {
                Election::where('active', true)->update(compact('active'));
                $active = true;
            }
            $request->merge(compact('active'));
            $election->update($request->all());
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        DB::commit();
        $route = $this->indexroute;
        session()->flash('status', 'Election information successfully updated.');
        return redirect()->route($route)->with(compact('route'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function destroy(Election $election)
    {
        $election->delete();
        session()->flash('status', 'Election information successfully deleted.');
        return redirect()->back();
    }

    /**
     * Activate the election.
     *
     * @param  \App\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function activate(Election $election)
    {
        Election::where('active', true)->update(['active' => false]);
        $election->update(['active' => true]);
        session()->flash('status', 'Election successfully activated.');
        $route = $this->indexroute;
        return redirect()->route($route)->with(compact('route'));
    }
}
