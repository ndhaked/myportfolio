<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="@yield('meta_description', 'Nirbhay Dhaked is a Senior Laravel Developer with 12+ years of experience building scalable SaaS, REST APIs and enterprise web applications.')" />
        <meta name="keywords" content="@yield('meta_keywords', 'Laravel Expert, Laravel Developer, PHP Developer, Senior Developer, REST API, SaaS, Web Application, Nirbhay Dhaked')" />
        <meta name="author" content="Nirbhay Dhaked" />
        <meta name="robots" content="index, follow" />
        <title>@yield('title', 'Nirbhay Dhaked – Senior Laravel Developer')</title>

        <link rel="canonical" href="@yield('canonical', url('/'))" />

        <meta property="og:title" content="@yield('title', 'Nirbhay Dhaked – Senior Laravel Developer')" />
        <meta property="og:description" content="@yield('meta_description', 'Senior Laravel Developer with 12+ years experience in SaaS, API development and backend architecture.')" />
        <meta property="og:url" content="@yield('canonical', url('/'))" />
        <meta property="og:image" content="@yield('og_image', asset('images/mydphome.png'))" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="Nirbhay Dhaked – Laravel Expert" />
        <meta property="og:locale" content="en_US" />

        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="@yield('title', 'Nirbhay Dhaked – Senior Laravel Developer')" />
        <meta name="twitter:description" content="@yield('meta_description', 'Senior Laravel Developer with 12+ years experience.')" />
        <meta name="twitter:image" content="@yield('og_image', asset('images/mydphome.png'))" />

        @hasSection('structured_data')
            @yield('structured_data')
        @else
        <script type="application/ld+json">
        {
          "@@context": "https://schema.org",
          "@@type": "ProfessionalService",
          "name": "Nirbhay Dhaked – Laravel Expert",
          "url": "{{ url('/') }}",
          "description": "Senior Laravel Developer with 12+ years experience in SaaS, APIs and scalable web applications.",
          "founder": {
            "@@type": "Person",
            "name": "Nirbhay Dhaked",
            "jobTitle": "Senior Laravel Developer & Tech Lead",
            "sameAs": [
              "https://www.linkedin.com/in/dhaked/",
              "https://www.facebook.com/dnirbhay",
              "https://twitter.com/ndhaked"
            ]
          }
        }
        </script>
        @endif

        <link href="{{ asset('portfolio/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('portfolio/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
        <link href="{{ asset('portfolio/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('portfolio/fonts/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('portfolio/css/owl.carousel.css') }}" rel="stylesheet">
        <link href="{{ asset('portfolio/css/owl.theme.default.css') }}" rel="stylesheet">
        <link href="{{ asset('portfolio/css/style.css') }}?v={{ filemtime(public_path('portfolio/css/style.css')) }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('portfolio/css/cubeportfolio.min.css') }}">
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        @livewireStyles
    </head>
    <body>
        @yield('content')

        <script src="{{ asset('portfolio/js/jquery-1.11.2.min.js') }}"></script>
        <script src="{{ asset('portfolio/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('portfolio/js/jquery.inview.min.js') }}"></script>
        <script src="{{ asset('portfolio/js/smoothscroll.js') }}"></script>
        <script src="{{ asset('portfolio/js/jquery.knob.min.js') }}"></script>
        <script src="{{ asset('portfolio/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('portfolio/js/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('portfolio/js/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('portfolio/js/scripts.js') }}?v={{ filemtime(public_path('portfolio/js/scripts.js')) }}"></script>
        <script type="text/javascript" src="{{ asset('portfolio/js/jquery-latest.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('portfolio/js/jquery.cubeportfolio.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('portfolio/js/main.js') }}"></script>
        @yield('uniquePageScript')
        <livewire:chatbot-widget wire:key="chatbot-widget" />
        @livewireScripts
    </body>
</html>
