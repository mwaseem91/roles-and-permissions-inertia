<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>

     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style> 
            .navbar-collapse .dropdown-menu .dropdown-item:active,
            .navbar-collapse .dropdown-menu .dropdown-item:hover,
            .navbar-collapse .nav-item .nav-link:hover {
                background-color: #4249e1 !important;
            }

            @media (min-width: 992px) {
                .navbar-vertical.navbar-expand-lg .navbar-collapse .dropdown-menu .dropdown-item.active, .navbar-vertical.navbar-expand-lg .navbar-collapse .dropdown-menu .dropdown-item:active {
                    background-color: #4249e1 !important;
                }
            }
        </style>

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js'])
        @inertiaHead
    </head>
    <body class="font-sans antialiased dark-mode">
        @inertia

    </body>
    
    <script src="https://cdn.jsdelivr.net/gh/silvia-odwyer/pixels.js@0.8.1/dist/Pixels.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>