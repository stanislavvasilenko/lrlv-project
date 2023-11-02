@extends('layouts.main')
@section('content')
<div class="">
   <div class="">
      <a href="{{ route('ticket.create') }}" class="btn btn-primary mb-3">Add ticket</a>
   </div>
   @foreach($tickets as $ticket)
      <div class=""><a href="{{ route('ticket.show',$ticket->id) }}">{{ $ticket->id }}. {{ $ticket->ticket_number }}</a></div>
   @endforeach
</div>
@endsection