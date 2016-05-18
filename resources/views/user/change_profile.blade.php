@extends('layouts/user')

@section('title')
    Upload Image | RailPicture.id
@endsection

@section('content')
    @if(Session::has('status'))
        <div class="alert alert-{{Session::get('status')}}" role="alert">
            <strong>{{Session::get('title')}}</strong><br/>
            <h5>{!! Session::get('message') !!}</h5>
        </div>
    @endif

    <div class="panel panel-default">
        <div class="panel-body">
            <h2 style="margin-top: -3px"><span class="glyphicon glyphicon-cog"></span> Setting</h2>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <form class="form-horizontal" style="margin-bottom: 0px;" method="POST" action="{{route('auth_register')}}">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Username" name="username" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="password" class="form-control" placeholder="Password" name="password" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="BirthDate" name="birthdate" id="birthdate" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="email" class="form-control" placeholder="Email" name="email" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Full Name" name="full_name" required="required">
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 0px;">
                            <div class="col-md-12 ">
                                <input type="submit" class="form-control btn" value="Register" style="background-color: green;color: white;">
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-md-12 col-xs-12">
                    <div class="col-md-4">
                        <form name="changepassword" action="changepass.html">
                            <input type="submit"  class="form-control" value="Change Password" style="margin-top: 10px;width: 150px;background-color: #5D5C5C;color: white;margin-left: auto;margin-right: auto">
                        </form>
                    </div>
                    <div class="col-md-4">
                        <form>
                            <input type="submit" class="form-control" value="Save Change" style="margin-top: 10px;width: 150px;background-color: #5D5C5C;color: white;margin-left: auto;margin-right: auto">
                        </form>
                    </div>
                    <div class="col-md-4">
                        <form>

                            <input type="submit" class="form-control" value="Cancel" style="margin-top: 10px;width: 150px;background-color: #5D5C5C;color: white;margin-left: auto;margin-right: auto">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer-additional')
    <script>
        $(document).ready(function(){
            function readImage(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#image-preview').show();
                        $('#image-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#image").on('change', function(){
                readImage(this);
            });
        });
    </script>
@endsection