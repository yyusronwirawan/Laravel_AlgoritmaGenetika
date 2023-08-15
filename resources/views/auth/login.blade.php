<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'E-Voting') }}</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('auth') }}/fonts/icomoon/style.css">
    <link rel="stylesheet" href="{{ asset('auth') }}/css/owl.carousel.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('auth') }}/css/bootstrap.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('auth') }}/css/style.css">

</head>

<body>

    <div class="d-lg-flex half">
        <div class="bg order-2 order-md-1" style="background-image: url('{{ asset('auth') }}/images/login.png');background-size:contain !important;"></div>
        <div class="contents order-1 order-md-2">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <h3 class="text-center mb-5">Login to <strong>{{ config('app.name', 'E-Voting') }}</strong></h3>
                        {{-- <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p> --}}
                        <form action="{{ route('login') }}" method="post" autocomplete="off">
                            @csrf

                            <div class="form-group first">
                                <label for="email">Email</label>
                                <input name="email" type="email" class="form-control" placeholder="your-email@gmail.com" id="email" autofocus>
                            </div>

                            <div class="form-group last mb-5">
                                <label for="password">Password</label>
                                <input name="password" type="password" class="form-control" placeholder="Your Password" id="password">
                            </div>

                            <input type="submit" value="Log In" class="btn btn-block btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('auth') }}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('auth') }}/js/popper.min.js"></script>
    <script src="{{ asset('auth') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('auth') }}/js/main.js"></script>
    <!-- Code injected by live-server -->
    <script>
        // <![CDATA[  <-- For SVG support
        if ('WebSocket' in window) {
            (function() {
                function refreshCSS() {
                    var sheets = [].slice.call(document.getElementsByTagName("link"));
                    var head = document.getElementsByTagName("head")[0];
                    for (var i = 0; i < sheets.length; ++i) {
                        var elem = sheets[i];
                        var parent = elem.parentElement || head;
                        parent.removeChild(elem);
                        var rel = elem.rel;
                        if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() ==
                            "stylesheet") {
                            var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                            elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date()
                                .valueOf());
                        }
                        parent.appendChild(elem);
                    }
                }
                var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
                var address = protocol + window.location.host + window.location.pathname + '/ws';
                var socket = new WebSocket(address);
                socket.onmessage = function(msg) {
                    if (msg.data == 'reload') window.location.reload();
                    else if (msg.data == 'refreshcss') refreshCSS();
                };
                if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                    console.log('Live reload enabled.');
                    sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
                }
            })();
        } else {
            console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
        }
        // ]]>
    </script>

</body>

</html>
