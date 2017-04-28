@extends('layouts.app')

@section('content')
    <div class="row columns">
        <h2>{{ Setting::get('system.title.' . App::getLocale()) }}</h2>
        {{ __('system.welcome', ['title' => Setting::get('system.title.' . App::getLocale())]) }}
        <div class="button-group stacked-for-small hollow large">
            @if (Setting::get('system.registration.method.oauth.active'))
                <a class="button" href="{{ route('oauth') }}">
                    {{ Setting::get('system.registration.method.oauth.name.' . App::getLocale()) }}
                </a>
            @endif
            @if (Setting::get('system.registration.method.generic.active'))
                <a class="button" href="{{ route('login') }}">
                    {{ Setting::get('system.registration.method.generic.name.' . App::getLocale()) }}
                </a>
            @endif
        </div>
    </div>
@endsection