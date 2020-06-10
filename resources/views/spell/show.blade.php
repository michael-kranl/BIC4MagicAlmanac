@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="container">
            <show-spell-element :show-spell="{{$spell}}" title="Show spell"/>
        </div>
    </section>
@endsection
