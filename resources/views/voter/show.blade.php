@extends('layouts.app')

@section('content')

@php
    $model = 'voter';
    $plural = str_plural($model);
@endphp

<div class="card">
    <div class="card-header">
        <div class="container">
            <div class="row">            
                <div class="col-6">
                    <h5 class="card-title mt-2 mb-1">{{ ucfirst($model) }} Profile</h5>
                </div>
                <div class="col-6">
                    <span class="float-right"><a name="add" id="add" class="btn btn-primary" href="{{ route("$plural.edit", ['voter' => $voter->id]) }}" role="button"><i class="fa fa-edit"></i> Edit</a></span>
                    @include('listbutton')
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
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $voter->id }}">
                            </div>
                        </div>    
                        <div class="form-group row">
                            <label for="staticFullname" class="col-sm-2 col-form-label">Full Name</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticFullname" value="{{ $voter->fullname }}">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="staticOffice" class="col-sm-2 col-form-label">Office</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticOffice" value="{{ ucfirst(optional($voter->office)->name) }}">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Vote(s)</label>
                            <div class="col-sm-10">
                                @isset(optional($voter)->votes)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Election</th>
                                            <th>Date</th>
                                            <th>Position</th>
                                            <th>Candidate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($voter->votes as $vote)
                                        <tr>
                                            <td scope="row">{{ $vote->election->title }}</td>
                                            <td scope="row">{{ $vote->election->date }}</td>
                                            <td>{{ $vote->position }}</td>
                                            <td>{{ $vote->candidate }}</td>
                                        </tr>                                          
                                        @empty
                                        <tr>
                                            <td>No vote(s) yet.</td>
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
