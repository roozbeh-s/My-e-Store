<header id="header"><!--header-->
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    
                    
                        <div class="col-sm-4 logo">
                            <a href="{{ route('home') }}"><img src="{{asset('images/home/logo.png')}}" alt="" /></a>
                        </div>
                      


                        <div class="col-sm-4 search_box">

                        {!! Form::open(['method' => 'GET', 'route' =>'productsearch']) !!}
                        {{ Form::text('q', null, ['placeholder'=>'Search for products']) }}
                        {{ Form::button('',['class' => 'search_btn','type'=>'submit' ]) }}
                        {!! Form::close() !!}

                        </div>
                    
                    
                        <div class="shop-menu">
                            <ul class="nav navbar-nav">
                                <li><a href={{ route('cart') }}><i class="fa fa-shopping-cart"></i> Cart
                                <span class="badge">{{ Cart::count() > 0 ? Cart::count() : ''  }}</span>

                                </a></li>
                                @if(Auth::check())
                                
                                <li>
                                
                                <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Hello {{ Auth::user()->name }}
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                <li><a href={{ route('account') }}><i class="fa fa-user"></i> Your Account</a></li>
                                <li><a href={{ route('orders') }}><i class="fa fa-file-text-o"></i> Your Orders</a></li>
                                <li class="divider"></li>
                                <li><a href={{ route('logout')}}><i class="fa fa-sign-out"></i> Logout</a></li>
                                </ul>
                                </div>
                                
                                </li>
                                
                                @else
                                <li><a href={{ route('login') }}><i class="fa fa-lock"></i> Login</a></li>
                                <li><a href={{ route('register') }}><i class="fa fa-user-plus"></i> Register</a></li>
                                @endif

                            </ul>
                        </div>
                            

                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                @foreach($categories as $category)
                                <li><a href={{ route('getproductbycategory',['category'=>$category->name])  }} class="">{{ $category->name }}</a></li>

                                @endforeach
                            </ul>

                        </div>
                    </div>

                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->