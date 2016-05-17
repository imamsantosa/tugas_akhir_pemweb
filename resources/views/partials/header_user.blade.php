<header>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('home')}}">RailPicture.com</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <form class="navbar-form navbar-left" role="search" action="" method="GET">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search" name="query">
                    </div>
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li ><a href="{{route('home')}}">Home <span class="sr-only"></span></a></li>
                    <li ><a href="{{route('upload_image')}}">upload <span class="sr-only"></span></a></li>
                    <li ><a href="">Message <span class="sr-only"></span></a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 12px"> <img src="assets/arno.jpg" class="img-rounded" style="width: 36px; height:26px;"> Kevin Charlie <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href=""><span class="glyphicon glyphicon-user"></span>  Profile</a></li>
                            <li><a href=""><span class="glyphicon glyphicon-cog"></span>  Setting Account</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{route('auth_logout')}}"><span class="glyphicon glyphicon-off"></span>  Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
