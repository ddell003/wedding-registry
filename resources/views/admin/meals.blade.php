@extends('layouts.app')

@section('content')
    <div class="container">
        <meal-list :user="{{\Auth::user()}}"></meal-list>
    </div>

@endsection



