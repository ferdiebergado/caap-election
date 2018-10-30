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
                    <h5 class="card-title mt-2 mb-1"><i class="fa fa-users"></i> {{ ucfirst($plural) }}</h5>
                </div>
                <div class="col-6">
                    <span class="float-right"><a name="add" id="add" class="btn btn-success" href="{{ route("$plural.create") }}" role="button"><i class="fa fa-plus-circle"></i> Add</a></span>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="{{ $plural }}-table" class="table table-hover table-striped table-condensed dataTable js-exportable"></table>

@endsection

@push('scripts')

@php
$url = route($route, $params ?? array())
@endphp

@component('datatablejs')

@slot('datatableid')
{{ $plural }}-table
@endslot

@slot('datatableroute')
{!! $url !!}
@endslot

@slot('datatablewith')
{{-- jobtitle,region,division --}}
@endslot

@slot('ellipsiscol')
[4]
@endslot

@slot('columns')
{ name: 'id', title: 'ID', data: 'id', width: '5%' },
{ name: 'lastname', title: 'Lastname', data: 'lastname', width: '15%' },
{ name: 'firstname', title: 'Firstname', data: 'firstname', width: '20%' },
{ name: 'middlename', title: 'Middlename', data: 'middlename', width: '15%' },
{ name: 'office.name', title: 'Office', data: 'office.name', width: '30%' },
{ title: 'Task(s)', data: 'id', searchable: false, orderable: false, width: '15%' }
@endslot

{ targets: 0,
    render: function (data, type, row) {
        return `<span class=\"badge badge-success\">${data}</span>`;
    }
},

{ targets: 5,
    render: function(data, type, row) {
        const btnclass = "btn btn-sm btn-flat";
        const baseurl = "/{{ $plural }}";
        let viewurl = `<a class="${btnclass} btn-info text-white" href="${baseurl}/${data}" title="View"><i class="fa fa-eye"></i></a> `;
        let editurl = `<a class="${btnclass} btn-primary" href="${baseurl}/${data}/edit" title="Edit"><i class="fa fa-edit"></i></a> `;
        let delurl = `<form id="del-form-${data}" method="POST" action="${baseurl}/${data}" style="display: inline;">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <a href="#" class="${btnclass} btn-danger" title="Delete" onclick="if (confirm('Are your sure?')) { document.querySelector('#del-form-${data}').submit(); }"><i class="fa fa-trash-alt"></i></a>
        </form>`;
        return viewurl + editurl + delurl;
    },
    className: "text-center"
}

@slot('toolbar')
@endslot

@endcomponent

@endpush
