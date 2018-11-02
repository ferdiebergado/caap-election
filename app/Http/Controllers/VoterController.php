<?php

namespace App\Http\Controllers;

use App\Voter;
use Illuminate\Http\Request;
use App\Helpers\RequestParser;
use App\Helpers\RequestCriteria;
use App\Helpers\DataTableHelper;
use App\Vote;

class VoterController extends Controller
{
    use RequestParser;
    use RequestCriteria;
    use DataTableHelper;

    protected $indexroute = 'voters.index';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Voter::orderBy('lastname')->orderBy('firstname')->get();
        if (request()->has('length')) {
            $voters = $this->datatablePaginate('App\Voter', ['office']);
            $draw = $voters['draw'];
            $data = $voters['data'];
        }

        if (request()->wantsJson()) {
            return response()->json([
                'draw' => $draw ?? null,
                'data' => $data,
            ]);
        }
        $route = $this->indexroute;
        return view('voter.index', compact('voters', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $voter = new Voter();
        $route = route('voters.store');
        return view('voter.partial', compact('voter', 'route'));
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
            'lastname' => 'required',
            'firstname' => 'required'
        ]);

        $voter = Voter::create($request->all());
        $route = $this->indexroute;
        session()->flash('status', 'New voter information was successfully recorded in the system.');
        return redirect()->route($route)->with(compact('route'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Voter  $voter
     * @return \Illuminate\Http\Response
     */
    public function show(Voter $voter)
    {
        return view('voter.show', compact('voter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Voter  $voter
     * @return \Illuminate\Http\Response
     */
    public function edit(Voter $voter)
    {
        $route = route('voters.update', ['voter' => $voter]);
        return view('voter.partial', compact('voter', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Voter  $voter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voter $voter)
    {
        $this->validate($request, [
            'lastname' => 'required',
            'firstname' => 'required'
        ]);

        $voter->update($request->all());
        $route = $this->indexroute;
        session()->flash('status', 'Voter information was successfully updated.');
        return redirect()->route($route)->with(compact('route'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Voter  $voter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voter $voter)
    {
        $voter->delete();
        session()->flash('status', 'Voter information was successfully deleted.');
        return redirect()->back();
    }

    /**
     * Show the form for voting.
     *
     * @param  \App\Voter  $voter
     * @return \Illuminate\Http\Response
     */
    public function vote(Voter $voter)
    {
        $vote = new Vote();
        $vote->voter_id = $voter->id;
        $route = route('votes.store');
        return view('vote.partial', compact('vote', 'route'));
    }

    public function selfservice()
    {
        return view('voter.selfservice');
    }
}
