@extends('layouts/user')

@section('title')
    {{ $user_data->full_name }} | RailPicture.id
@endsection

@section('content')
    @if(Session::has('error'))
        <div class="alert alert-{{Session::get('error')}}" role="alert">
            <strong>{{Session::get('title')}}</strong><br/>
            <h5>{!! Session::get('message') !!}</h5>
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="timeline-text">
                        <div class="account-info">
                            <img src="{{url('avatars/'.$user_data->avatar)}}" class="img-thumbnail image-info"/>
                            <div class="identity-info">
                                <h4 class="name-info">{{$user_data->full_name}}</h4>
                                <h5 class="id-info">{{'@'.$user_data->username}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="timeline-text">
                        {{$user_data->status_message}}
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 12px">
                <div class="col-md-3 col-xs-3">
                    <a role="button" class="btn btn-primary btn-follow btn-block">{{ $post_count }} Posts</a>
                </div>
                <div class="col-md-3 col-xs-3">
                    <a role="button" id="button-following" class="btn btn-primary btn-follow btn-block">{{ $following_count }} Following</a>
                </div>
                <div class="col-md-3 col-xs-3">
                    <a role="button" id="button-follower" class="btn btn-primary btn-follow btn-block">{{ $follower_count }} Follower</a>
                </div>
                @if(!$is_followed)
                    <div class="col-md-3 col-xs-3">
                        <a role="button" id="button-foll-unfoll" data-idUser="{{ $user_data->id }}" class="btn btn-primary btn-follow btn-block" onclick="followUnfollowUser()">Follow</a>
                    </div>
                @else
                    <div class="col-md-3 col-xs-3">
                        <a role="button" id="button-foll-unfoll" data-idUser="{{ $user_data->id }}" class="btn btn-primary btn-follow btn-block" onclick="followUnfollowUser()">Unfollow</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('footer-additional')
    <script>

        function followUnfollowUser() {
            var inc = 0;
            if ($("#button-foll-unfoll").text() == "Follow") {
                $.ajax({
                    method: 'POST',
                    url: "{{ route('api-user-follow') }}",
                    data: "friend_id="+$("#button-foll-unfoll").attr("data-idUser")
                })
                .done(function (msg) {
                    var res = msg;
                    if (!res.error) {
                        $("#button-foll-unfoll").text("Unfollow");
                    }
                });

                inc = 1;
            } else {
                $.ajax({
                    method: 'POST',
                    url: "{{ route('api-user-unfollow') }}",
                    data: "friend_id="+$("#button-foll-unfoll").attr("data-idUser")
                })
                .done(function (msg) {
                    var res = msg;
                    if (!res.error) {
                        $("#button-foll-unfoll").text("Follow");
                    }
                });

                inc = -1;
            }

            var btn_val = $("#button-follower").text();
            var arr = btn_val.split(" ");

            $("#button-follower").text( (parseInt(arr[0]) + inc) + " Follower" );
        }

        $(document).ready(function(){

        });
    </script>
@endsection