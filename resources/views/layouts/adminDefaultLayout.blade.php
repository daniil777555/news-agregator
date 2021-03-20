<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
  <script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/ckeditor.js"></script>
  <title>Administration</title>
</head>
<body>
    <div class="adm-container">

        <header class="header">
            <div class="logo"><a href="/" class="logo-text">NewsBlog</a></div>
        </header>

        <div class="wrapper">
            @if(session()->has('login'))
                <div class="logout-wrapper">
                    <a href="{{ route('administration.logout') }}" class="adm-form-btn btn-logout">Logout</a>
                </div>
            @endif
            
            @if(session()->has('success'))
                <h3 class="success">{{ session()->get('success') }}</h3>
            @endif

            <h3 class="adm-title">@yield('title')</h3>

            @if ($errors->any())
                <div class="errors-block">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="error-item">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield("content")
        </div>
        
    </div>

    @stack('js')
</body>
</html>