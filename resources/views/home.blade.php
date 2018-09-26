@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Channel</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('slack.channel') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="channel" class="col-sm-4 col-form-label text-md-right">{{ __('Channel Name') }}</label>
                            <div class="col-md-6">
                                <input id="channel" type="channel" class="form-control{{ $errors->has('channel') ? ' is-invalid' : '' }}" name="channel" value="{{ old('channel') }}" required autofocus>
                                @if ($errors->has('channel'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('channel') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Channels</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Invite</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($channels as $channel)
                            <tr>
                                <td>{{$channel->id}}</td>
                                <td>{{$channel->name}}</td>
                                <td>
                                    <form method="POST" action="{{route('slack.invite.channel')}}">
                                        @csrf
                                        <input type="hidden" name="channel" value="{{$channel->id}}">
                                        <div class="form-group row">
                                            
                                            <div class="col-md-6">
                                                <input placeholder='User' id="user" type="text" class="form-control{{ $errors->has('user') ? ' is-invalid' : '' }}" name="user" value="{{ old('user') }}" required autofocus>
                                                @if ($errors->has('user'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('user') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <button type="submit" class="btn btn-success">
                                            {{ __('Invite') }}
                                            </button>
                                        </div>
                                        
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection