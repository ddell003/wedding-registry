@extends('layouts.app')

@section('content')
    <div class="container">
        <party-list :user="{{\Auth::user()}}"></party-list>
    </div>

@endsection



