@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Home</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-3">Welcome!</h1>
                            <p class="lead">{{ config('app.name') }}</p>
                            <hr class="my-2">
                            <p>{{ config('app.company') }}</p>
                            <p class="lead">
                                <a class="btn btn-primary btn-lg" href="{{ route('votes.create') }}" role="button">Vote</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
