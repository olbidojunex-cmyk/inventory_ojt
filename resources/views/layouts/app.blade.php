<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <style>
            #global-loader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background-color: #0d324d; /* Note: Change this to #111827 if you prefer it to match the dark mode gray-900 background perfectly */
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
                transition: transform 0.6s cubic-bezier(0.86, 0, 0.07, 1);
            }

            /* This class triggers the slide up animation */
            #global-loader.slide-up {
                transform: translateY(-100%);
            }

            .loader-spinner {
                width: 48px;
                height: 48px;
                border: 4px solid rgba(255, 255, 255, 0.1);
                border-top: 4px solid #ffffff;
                border-radius: 50%;
                animation: loaderSpin 1s linear infinite;
            }

            @keyframes loaderSpin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div id="global-loader">
            <div class="loader-spinner"></div>
        </div>

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>

        <script>
            // Wait for the page to fully load
            window.addEventListener('load', () => {
                const loader = document.getElementById('global-loader');
                if (loader) {
                    // Small delay makes sure the user sees the loader before it slides up
                    setTimeout(() => {
                        loader.classList.add('slide-up');
                    }, 400); 
                }
            });
        </script>
    </body>
</html>