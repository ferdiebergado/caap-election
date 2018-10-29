@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="container">
            <div class="row">            
                <div class="col-6">
                    <h5 class="card-title mt-2 mb-1">Employee Profile</h5>
                </div>
                <div class="col-6">
                    <span class="float-right"><a name="add" id="add" class="btn btn-success" href="{{ route('employees.edit', ['employee' => $employee->id]) }}" role="button"><i class="fa fa-plus-circle"></i> Edit</a></span>
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
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $employee->id }}">
                            </div>
                        </div>    
                        <div class="form-group row">
                            <label for="staticFullname" class="col-sm-2 col-form-label">Full Name</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticFullname" value="{{ ucfirst($employee->lastname) . ', ' . ucfirst($employee->firstname) . ' ' . ucfirst($employee->middlename) }}">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="staticOffice" class="col-sm-2 col-form-label">Office</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticOffice" value="{{ ucfirst(optional($employee->office)->name) }}">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Vote(s)</label>
                            <div class="col-sm-10">
                                @isset(optional($employee)->votes)
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
                                        @forelse ($employee->votes as $vote)
                                        <tr>
                                            <td scope="row">{{ $vote->election->title }}</td>
                                            <td scope="row">{{ $vote->election->date }}</td>
                                            <td>{{ $vote->position }}</td>
                                            <td>{{ $vote->candidate }}</td>
                                        </tr>                                          
                                        @empty
                                        <tr>
                                            <td>No votes yet.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>                                
                                @endisset                                
                            </div>
                        </div>                                                  
                        <div class="form-group row mb-0">
                            <div class="col-12">
                                <a class="btn float-right" href="javascript:void();" onclick="window.history.back();"><i class="fa fa-arrow-left"></i> Back</a>                                
                            </div>
                        </div>                                           
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
