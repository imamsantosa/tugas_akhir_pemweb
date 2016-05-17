@extends('layouts.user')

@section('title') RailPicture.com @endsection

@section('content')
    @if(count($posts) != 0)
        @foreach($posts as $post)
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row" data-postId="{{$post['post_id']}}">
                        <div class="col-md-12 col-xs-12 text-center" id="image-post">
                            <img src="{{url('images/'.$post['post_id'].'.jpg')}}" class="img-thumbnail">

                        </div>
                        <div class="col-md-12 col-xs-12 action">
                            <div class="row text-center interaction">
                                <div class="col-md-3 col-xs-3" id="star-button">
                                    <a role="button" style="{{ ($post['isLiked'])? 'display: none;' : '' }}" class="like-button"> <span class="glyphicon glyphicon-star-empty"></span> <span id="count-like">{{ $post['likeCount'] }} {{ ($post['likeCount'] <= 1)? 'Star' : 'Stars' }}</span></a>
                                    <a role="button" style="{{ ($post['isLiked'])? '' : 'display: none;' }}" class="unlike-button"> <span class="glyphicon glyphicon-star"></span> <span id="count-unlike">{{ $post['likeCount']  }} {{  ($post['likeCount'] <= 1)? 'Star' : 'Stars' }}</span></a>
                                </div>
                                <div class="col-md-3 col-xs-3">
                                    <a role="button"><span class="glyphicon glyphicon-exclamation-sign"></span> Report</a>
                                </div>
                                <div class="col-md-3 col-xs-3">
                                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <span class="glyphicon glyphicon-option-horizontal"> Options</span>
                                        <ul class="dropdown-menu">
                                            @if(auth()->user()->username == $post['username'])
                                            <li><a href="#"><span class="glyphicon glyphicon-remove"></span> Delete</a></li>
                                            @endif
                                            <li><a href="#"><span class="glyphicon glyphicon-download-alt"></span> Download</a></li>
                                        </ul>
                                    </a>
                                </div>
                                <div class="col-md-3 col-xs-3">
                                    <div class="time-creates">
                                        {{$post['created_at']}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <hr>
                            <div class="timeline-text">
                                <div class="account-info">
                                    <img src="{{url('avatars/'.$post['avatar'])}}" class="img-thumbnail image-info"/>
                                    <div class="identity-info">
                                        <h4 class="name-info"><a href="{{$post['username']}}" role="button">{{$post['full_name']}}</a></h4>
                                        <h5 class="id-info"><a href="{{$post['username']}}" role="button"> {{'@'.$post['username']}} </a></h5>
                                    </div>
                                </div>
                                <div class="status">
                                    <p>
                                        {{$post['caption']}}
                                    </p>
                                </div>
                                <hr>
                                <div class="comment">
                                    @if(count($post['comments']) != 0)
                                    @foreach($post['comments'] as $comment)
                                    <div class="comment-list">
                                        <div class="comment-name"><a>@imams</a> : </div>
                                        <div class="comment-content">blah blah blah vsaafassfasfasfsaf sadaafafas asgasfsadas safsad safa asfsad wea </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <div class="comment-form">
                                <form>
                                    <div class="form-group" style="margin-bottom: 0px">
                                        <input type="Comment" class="form-control" id="inputComment" placeholder="Comment">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="alert alert-warning text-center">Your Timeline is empty.</div>
    @endif
@endsection

@section('footer-additional')
    <script>
        $(document).ready(function(){
            $('.like-button').on('click', function(event){
                var element = event.target.parentNode.parentNode.parentNode.parentNode.parentNode;
                var post_id = element.dataset['postid'];
                console.log(post_id);
                $.ajax({
                    method: 'POST',
                    url: "{{route('api-user-like')}}",
                    data: 'post_id='+post_id,
                })
                .done(function (msg) {
                    var res = msg;
                    if(!res.error){
                        $(element).find('.action').find('.interaction').find('.like-button').hide();
                        $(element).find('.action').find('.interaction').find('.unlike-button').show();
                        $(element).find('.action').find('.interaction').find('.unlike-button').find('#count-unlike').html(res.count_like);
                    }
                });
            });

            $('.unlike-button').on('click', function(event){
                var element = event.target.parentNode.parentNode.parentNode.parentNode.parentNode;
                var post_id = element.dataset['postid'];
                console.log(element);
                $.ajax({
                    method: 'POST',
                    url: "{{route('api-user-unlike')}}",
                    data: 'post_id='+post_id,
                })
                .done(function (msg) {
                    var res = msg;
                    if(!res.error){
                        $(element).find('.action').find('.interaction').find('.unlike-button').hide();
                        $(element).find('.action').find('.interaction').find('.like-button').show();
                        $(element).find('.action').find('.interaction').find('.like-button').find('#count-like').html(res.count_like);
                    }
                });
            });

        });
    </script>
@endsection