<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">

 
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Protest+Guerrilla&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

  
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Protest+Guerrilla&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton+SC&family=Bebas+Neue&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Anton&family=Anton+SC&family=Bebas+Neue&family=Sevillana&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">



    <title>@yield('title')</title>
</head>
<body>
    
    @yield('content')

    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/jquery-3.7.0.js')}}"></script>

    @yield('script')

</body>
</html>