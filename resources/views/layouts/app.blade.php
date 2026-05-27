<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} | Green Tech Exim</title>
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>
<body class="bg-bg-body text-text-body w-full h-full min-h-screen" >

 @include('partials.header')
 <main>
    @yield('content')
  </main>
</div>



    


</body>
</html>

