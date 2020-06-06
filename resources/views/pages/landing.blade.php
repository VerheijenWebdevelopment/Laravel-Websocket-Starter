@extends("layouts.app")

@section("content")
    
    <div id="echo">
        <echo-test
            :user="{{ auth()->user()->toJson() }}"
            api-endpoint="{{ route('send-test-message.post') }}">
        </echo-test>
    </div>

@stop