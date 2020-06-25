@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="container">
            <list-spell-element :all-spells = "{{ $spells }}" title="List spell"/>
        </div>
    </section>
@endsection
