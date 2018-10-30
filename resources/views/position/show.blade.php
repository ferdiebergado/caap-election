@extends('layouts.app')

@section('content')

@php
    $model = 'position';
    $plural = str_plural($model);
@endphp

<div class="card">
    <div class="card-header">
        <div class="container">
            <div class="row">            
                <div class="col-6">
                    <h5 class="card-title mt-2 mb-1">{{ ucfirst($model) }}</h5>
                </div>
                <div class="col-6">
                    <span class="float-right"><a name="add" id="add" class="btn btn-primary" href="{{ route("$plural.edit", ['position' => $position->id]) }}" role="button"><i class="fa fa-edit"></i> Edit</a></span>
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
                            <label for="staticEmail" class="col-sm-2 col-form-label">ID</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $position->id }}">
                            </div>
                        </div>    
                        <div class="form-group row">
                            <label for="staticName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticName" value="{{ $position->name }}">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Candidate(s)</label>
                            <div class="col-sm-10">
                                @isset(optional($position)->candidates)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Office</th>
                                            <th>Position</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($position->candidates as $Candidate)
                                        <tr>
                                            <td scope="row">{{ $candidate->voter->fullname }}</td>
                                            <td scope="row">{{ $candidate->voter->office->name }}</td>
                                            <td scope="row">{{ $candidate->position->name }}</td>
                                        </tr>                                          
                                        @empty
                                        <tr>
                                            <td>No candidate(s).</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>                                
                                @endisset                                
                            </div>
                        </div>                                                                                                                
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
