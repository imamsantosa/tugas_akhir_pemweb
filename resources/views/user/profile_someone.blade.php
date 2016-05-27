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
                    <a role="button" class="btn btn-primary btn-grey btn-block">{{ $post_count }} Posts</a>
                </div>
                <div class="col-md-3 col-xs-3">
                    <a role="button" id="button-following" class="btn btn-primary btn-grey btn-block">{{ $following_count }} Following</a>
                </div>
                <div class="col-md-3 col-xs-3">
                    <a role="button" id="button-follower" class="btn btn-primary btn-grey btn-block">{{ $follower_count }} Follower</a>
                </div>
                <div class="col-md-3 col-xs-3">
                    <a role="button" id="button-follower" href="{{route('user-conversation', ['id' => $user_data -> id])}}" class="btn btn-primary btn-grey btn-block">Send Message</a>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col-md-12 col-xs-12 follow" style="{{ (!$is_followed) ? '' : 'display: none;' }}">
                    <a role="button" id="button-follow"  data-idUser="{{ $user_data->id }}" class="btn btn-primary btn-grey btn-follow btn-block">Follow</a>
                </div>
                <div class="col-md-12 col-xs-12 unfollow" style="{{ ($is_followed) ? '' : 'display: none;' }}">
                    <a role="button" id="button-unfollow"  data-idUser="{{ $user_data->id }}" class="btn btn-primary btn-grey btn-unfollow btn-block">Unfollow</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer-additional')
    <script>
        $(document).ready(function(){
            $('.btn-follow').on('click', function(e){
                e.preventDefault();
                $.ajax({
                    method: 'POST',
                    url: "{{ route('api-user-follow') }}",
                    data: "friend_id=" + $("#button-follow").attr("data-idUser")
                })
                .done(function (msg) {
                    var resp = msg;
                    if (!resp.error) {
                        $(".follow").hide();
                        $(".unfollow").show();
                        updateCount(resp);
                    }
                });
            });

            $('.btn-unfollow').on('click', function (e) {
                $.ajax({
                    method: 'POST',
                    url: "{{ route('api-user-unfollow') }}",
                    data: "friend_id=" + $("#button-follow").attr("data-idUser")
                })
                .done(function (msg) {
                    var resp = msg;
                    if (!resp.error) {
                        $(".unfollow").hide();
                        $(".follow").show();
                        updateCount(resp);
                    }
                });
            });

            function updateCount(resp){
                $("#button-follower").text(resp.follower_count);
                $("#button-following").text(resp.following_count);
            }
        });
    </script>
@endsection