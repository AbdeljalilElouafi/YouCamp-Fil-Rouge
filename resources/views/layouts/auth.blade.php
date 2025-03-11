<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - YouCamp</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cabin+Sketch:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1a2a3a 0%, #0f172a 100%);
            background-image: url("{{ asset('images/background.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
        }
        .logo-font {
            font-family: 'Cabin Sketch', cursive;
        }
        .auth-container {
            background: linear-gradient(to right, #557C93, #e3e3e3);
            backdrop-filter: blur(5px);
        }
        .auth-card {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: fadeIn 0.5s ease-out forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .form-input {
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
        }
        .form-input:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 103, 0, 0.5);
            box-shadow: 0 0 0 2px rgba(255, 103, 0, 0.25);
        }
        .fire-icon {
            position: relative;
            display: inline-block;
        }
        .fire-icon::after {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            background: radial-gradient(circle, rgba(255, 103, 0, 0.6) 0%, transparent 70%);
            border-radius: 50%;
            z-index: -1;
            animation: flicker 3s infinite alternate;
        }
        @keyframes flicker {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div id="app">
        @yield('content')
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        // Add animation to form elements
        document.addEventListener('DOMContentLoaded', function() {
            const formElements = document.querySelectorAll('form > div');
            
            formElements.forEach((element, index) => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    element.style.transition = 'all 0.4s ease';
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, 100 * (index + 1));
            });
        });
    </script>
    @stack('scripts')
</body>
</html>