@extends('layouts.app')
@section('content')
<div class="container">
  <h3>Add Client</h3>
  <form method="POST" action="{{ route('clients.store') }}">
    @include('clients.form')
  </form>
</div>
@endsection
