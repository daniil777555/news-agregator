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
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <title>NewsBlog</title>
</head>
<body>
    <div class="container">

        <header class="header">
            <div class="logo"><a href="/" class="logo-text">NewsBlog</a></div>
        </header>

        <div class="wrapper">
        <main class="main-block">
            <div class="filter">
                <select class="select-sort"> 
                    <option value="date=newest" class="select-sort-option newest">Newest</option>
                    <option value="date=oldest" class="select-sort-option oldest">Oldest</option>
                </select>
                <form action="" class="search-form" method="get">
                    <input type="text" name="hashtag" class="input-hashtag" placeholder="Enter hashtag or title" >
                    <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="news-block">
                @yield('content')
            </div>
        </main>
            
            <div class="hello">
                <h3 class="hello-text">Hey BRUH <i class="far fa-smile"></i></h3>
            </div>
        </div>
        
    </div>
<script src="/js/app.js"></script>
</body>
</html>