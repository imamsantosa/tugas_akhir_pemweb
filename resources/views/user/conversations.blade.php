@extends('layouts/user')

@section('title')
    Conversations | RailPicture.id
@endsection

@section('content')
    <div class="container">
        <div class="row" style="margin-top: 15px">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body" style="overflow-y: scroll; max-height: 450px;">
                        <div class="message">
                            @if(count($messages) != 0)
                                @foreach($messages as $message)
                                    @if($message['sender_id'] == auth()->user()->id)
                                        <div class="well" style="max-width: 80%">
                                            <div class="message-list">
                                                <div class="account-info">
                                                    <div class="identity-info">
                                                        <h4 class="name-info" style="margin-bottom: 1%"><a > {{ $message['sender_name'] }} </a></h4>
                                                    </div>
                                                </div>
                                                <div class="message-content">{{ $message['message'] }} </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="well" style="max-width: 80%; margin-left: 20%;">
                                            <div class="message-list">
                                                <div class="account-info">
                                                    <div class="identity-info">
                                                        <h4 class="name-info" style="margin-bottom: 1%"><a > {{ $message['sender_name'] }} </a></h4>
                                                    </div>
                                                </div>
                                                <div class="message-content">{{ $message['message'] }} </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <p style="text-align: center;">Start chatting!</p>
                            @endif
                        </div>
                    </div>
                    <!--tempat message-->
                    <div class="panel-footer">
                        <div class="row" style=" margin-top: -8px;">
                            <div class="col-md-12">
                                <div class="comment-form">
                                    <div class="form-group" style="margin-bottom: 0px">
                                        <input type="text" class="form-control" id="input_comment" placeholder="write here ..." >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-additional')
    <script type="application/javascript">
        $(document).ready(function () {
            $("#input_comment").keyup(function (event) {
                var message = $("#input_comment").val();

                if (event.keyCode == 13) {
                    if (message != '') {
                        $("#input_comment").val("");
                        $.ajax({
                            url: "{{ route('api-send-message') }}",
                            method: 'post',
                            data: "recipient_id=" + "{{ $recipient_id }}" + "&message=" + message
                        })
                        .done(function (msg) {
                            if (!msg.error) {
                                var ballon = "<div class=\"well\" style=\"max-width: 80%\">";
                                ballon += "<div class=\"message-list\">";
                                ballon += "<div class=\"account-info\">";
                                ballon += "<div class=\"identity-info\">";
                                ballon += "<h4 class=\"name-info\" style=\"margin-bottom: 1%\"><a >" + "{{ auth()->user()->full_name }}" + "</a></h4>";
                                ballon += "<div><div>";
                                ballon += "<div class=\"message-content\">" + message + "</div>";
                                ballon += "<div><div>";

                                $('.message').append(ballon);
                            }
                        });
                    }
                }
            });
        });
    </script>
@endsection