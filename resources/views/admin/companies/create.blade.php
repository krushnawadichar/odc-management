@extends('admin.layouts.main')

@section('title', 'Add New Company - ODC Management')

@section('content')
@include('admin.companies.form', ['company' => null])
@endsection