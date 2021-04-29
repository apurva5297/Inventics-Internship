@extends('layouts.master')
@section('content')
<div class="page-content">
    @include('Home.youtubevideo') 
    @include('Home.holder')
    @include('Home.topworldgames')   
    @include('Home.gameoftheyear')
    @include('Home.game_news')  
    @include('Home.subscribe')


</div>
    
@endsection
