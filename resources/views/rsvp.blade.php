@extends('layouts.app')

@section('content')
    <div class="container">

        <?php //dd($party->toArray())/**/ ?>
        <rsvp :user="{{\Auth::user()}}" :party="{{$party}}"></rsvp>
    </div>

@endsection
