@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Employees</div>

                <div class="card-body">
                    <a class="btn btn-primary" href="{{ route('employees.create') }}">Add</a>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
