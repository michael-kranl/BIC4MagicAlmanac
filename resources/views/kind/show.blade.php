@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="container">
            <show-kind-element :show-kind="{{$kind}}" title="Show kind"/>
        </div>
    </section>
@endsection
