@extends('layout')
@section('content')
    <div class="m-b-md">
        <form method="post" action="{{ route('send.post') }}">
            @csrf
            <div class="form-group">
                <label for="inMessage">Send Message</label>
                <textarea class="form-control @error('message') is-invalid @enderror" id="inMessage"
                          placeholder="Enter your message" name="message"></textarea>
                @error('message')
                <small class="form-text invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            @include('flash::message')
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </form>
    </div>
@endsection
