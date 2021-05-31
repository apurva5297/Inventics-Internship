@extends('layouts.master_common')
@section('content')
<div class="page-content">
      @include('Contact.content')
      @include('Contact.get_in_touch')
      @include('Common.newsletter')
</div>

    
@endsection