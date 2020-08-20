@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if($party)
            <rsvp :user="{{\Auth::user()}}" :party="{{$party}}"></rsvp>
        @else
            <v-alert type="info" style="background-color: #2196f3 !important;">
                Please Contact Parker or Katie to set up an RSVP for you!
            </v-alert>
        @endif
    </div>

</div>

@endsection
