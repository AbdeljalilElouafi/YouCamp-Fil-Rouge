<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YouCamp - Home</title>

    
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cabin+Sketch:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
</head>
<body class="bg-[#FDFDFC] ">

    
    @include('landing-page.components.header')
    
   
    
    @include('landing-page.components.hero-section')
    
   
    
    @include('landing-page.components.features-section')
    
    
    
    @include('landing-page.components.footer')

</body>
</html>
