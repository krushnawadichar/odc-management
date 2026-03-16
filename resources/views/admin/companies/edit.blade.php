@extends('admin.layouts.main')

@section('title', 'Edit Company - ODC Management')

@section('content')
@include('admin.companies.form', ['company' => $company])
@endsection