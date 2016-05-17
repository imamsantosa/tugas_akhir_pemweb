@extends('layouts.user')

@section('title') RailPicture.com @endsection

@section('content')
    @if(count($posts) != 0)
        @foreach($posts as $post)
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <img src="{{url('images/'.$post['post_id'].'.jpg')}}" class="img-thumbnail">

                        </div>
                        <div class="col-md-12 col-xs-12">
                            <div class="row text-center interaction">
                                <div class="col-md-4 col-xs-4">
                                    <a role="button"><span class="glyphicon glyphicon-star{{(!$post['isLiked'])? '-empty' : ''}}"></span> {{ $post['likeCount'] . ($post['likeCount'] <= 1)? 'Star' : 'Stars' }}</a>
                                </div>
                                <div class="col-md-4 col-xs-4">
                                    <a role="button"><span class="glyphicon glyphicon-exclamation-sign"></span> Report</a>
                                </div>
                                <div class="col-md-4 col-xs-4">
                                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <span class="glyphicon glyphicon-option-horizontal"> Options</span>
                                        <ul class="dropdown-menu">
                                            <li><a href="#"><span class="glyphicon glyphicon-remove"></span> Delete</a></li>
                                            <li><a href="#"><span class="glyphicon glyphicon-download-alt"></span> Download</a></li>
                                        </ul>
                                    </a>
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
                                    <div class="comment-list">
                                        <div class="comment-name"><a>@imams</a> : </div>
                                        <div class="comment-content">blah blah blah vsaafassfasfasfsaf sadaafafas asgasfsadas safsad safa asfsad wea </div>
                                    </div>
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