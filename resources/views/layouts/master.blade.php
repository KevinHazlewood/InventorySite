<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Inventory System</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
        <!--<script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=019Qxhv51afNyMK2r3z5jyGEepvu36IUOpxSc17O37BzyWp_PvFfI0u4o4bsiiQff8iFpjwyDXsxGPwYk1YoGpqNyMjiJ6dHQN7T3aIApa7YOUt2COrNQWej5H76PwZxjc0xfcybocKGUxRFoekWxA" charset="UTF-8"></script><script src="./js/core.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <style type="text/css">
            div.credentials{
                display: inline-block;
                text-align: center;
                top: 50%;
                left: 50%;
                background-color: #ededed;
                border: 5px solid #fff;
                padding: .5em 3em;
                z-index: 2;
            }
            div.owner{
                display: inline-block;
                text-align: center;
                top: 50%;
                left: 50%;
                
                border: 5px solid #fff;
                padding: .5em 0em;
                z-index: 2;
            }
            div.admin{
                display: inline-block;
                text-align: center;
                top: 50%;
                left: 50%;
                border: 5px solid #fff;
                padding: .5em 0em;
                z-index: 2;
            }
            .background{
                background: linear-gradient(45deg, rgba(94, 183, 183, 0.8) 0%, rgba(94, 183, 183, 0.3) 100%);
                background-position: center center;
                background-repeat: no-repeat;
                background-size:cover;
            }
            html, body {
                height: auto;
            }
        </style>
    </head>
    <body>
        <nav class="navbar is-primary">
            <div class="navbar-brand">
                
                <div id="nav-toggle" class="navbar-burger" data-target="nav-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div id="nav-menu" class="navbar-menu">
                <div class="navbar-start">
                    <h3 class="navbar-item">
                    	
                    </h3>
                    <img src="/img/logo2.jpg" class="navbar-item" width="10%">
                    <a class="navbar-item" href="/">
                        Home
                    </a>
                    @if(Auth::check())
                        <a class="navbar-item" href="/user">
                            User page
                        </a>
                        @if(Auth::user()->storeId != 0)
                            <?php 
                                $user = Auth::user();
                                $store = DB::table('stores')->find($user->storeId);
                            ?>
                            @if($store->storeStatus == true)
                            <a class="navbar-item" href="/inventory">
                                Store Inventory
                            </a>
                            @endif
                        @endif
                        
                    @endif
                    </div>
                    <div class="navbar-end">
                    @if(!Auth::check())
                        <a class="navbar-item" href="/login" >
                            Log In
                        </a>
                        <a class="navbar-item" href="/signup">
                            Sign Up
                        </a>
                    @else
                        <a class="navbar-item" href="/logout">
                            Log Out
                        </a>
                    @endif
                    </div>
                
            </div>
        </nav>

        
        @yield('content')
        <br/>
        <br/>
		<script>


		</script>
        <nav class="navbar is-fixed-bottom">
            <div class="navbar-end">
                <div class="navbar-item">
                    <p>
                        Copyright &copy; KH 2020.
                    </p>    
                </div>
            </div>
        </nav>
    </body>
</html>