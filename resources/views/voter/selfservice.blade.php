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
                    <h5 class="card-title mt-2 mb-1">{{ ucfirst($model) }} Self Service</h5>
                </div>
                <div class="col-6">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center">Coming soon...</h1>                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
