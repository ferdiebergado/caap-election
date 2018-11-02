@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="container">
            <div class="row">            
                <div class="col-6">
                    <h5 class="card-title mt-2 mb-1"><i class="s7 s7-pen"></i> Reports</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="container">                        
                        <div class="row mb-10">
                            @foreach ($positionchart as $chart)                        
                            <div class="col-12">
                                {!! $chart->container() !!}
                            </div>                        
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script src="{{ asset('js/Chart.min.js') }}"></script>

@foreach ($positionchart as $chart)

{!! $chart->script() !!}

@endforeach

@endpush
