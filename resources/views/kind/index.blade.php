@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="container">
            <list-kind-element :all-kinds = "{{ $kinds }}" title="List kind"/>
        </div>
    </section>
@endsection
