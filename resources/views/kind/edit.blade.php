@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="container">
            <edit-kind-element :current-kind="{{$kind}}" title="Edit kind"/>
        </div>
    </section>
@endsection
