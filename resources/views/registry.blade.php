@extends('layouts.app')

@section('content')
    <div class="container">
        <registry :user="{{\Auth::user()}}"></registry>
    </div>

@endsection
