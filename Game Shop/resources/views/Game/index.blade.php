@extends('layouts.master')
@section('content')
<div class="page-content">
    @include('Game.youtubevideo') 
    @include('Game.holder')
    @include('Game.topworldgames')   
    @include('Game.gameoftheyear')
    @include('Game.game_news')  
    @include('Game.subscribe')


</div>
    
@endsection
