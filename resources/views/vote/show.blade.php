@extends('layouts.app')

@section('content')

@php
    $model = 'vote';
    $plural = str_plural($model);
@endphp

<div class="card">
    <div class="card-header">
        <div class="container">
            <div class="row">            
                <div class="col-6">
                    <h5 class="card-title mt-2 mb-1"><i class="s7 s7-pen"></i> {{ ucfirst($model) }}</h5>
                </div>
                <div class="col-6">
                    <span class="float-right"><a name="add" id="add" class="btn btn-secondary mr-2" href="{{ route("$plural.index") }}" role="button"><i class="fa fa-list"></i> List</a></span> 
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form>
                        <div class="form-group row">
                            <label for="staticId" class="col-sm-2 col-form-label">ID</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticId" value="{{ $vote->id }}">
                            </div>
                        </div>    
                        <div class="form-group row">
                            <label for="staticVoter" class="col-sm-2 col-form-label">Voter</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticVoter" value="{{ $vote->voter->fullname }}">
                            </div>
                        </div>  

                        <div class="form-group row">
                            <label for="staticPosition" class="col-sm-2 col-form-label">Position</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticPosition" value="{{ $vote->position->name }}">
                            </div>
                        </div>                         
                        <div class="form-group row">
                            <label for="staticCandidate" class="col-sm-2 col-form-label">Candidate</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticCandidate" value="{{ $vote->candidate->voter->fullname }}">
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="staticElection" class="col-sm-2 col-form-label">Election</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticElection" value="{{ $vote->election->title . ', ' . $vote->election->date  }}">
                            </div>
                        </div>                                              
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
