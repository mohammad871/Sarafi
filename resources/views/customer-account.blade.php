@extends('layouts.master')
@php
    $msg = session()->get('message');
    Session::forget('message');
@endphp
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <livewire:customer-account />
    </div>
@endsection
