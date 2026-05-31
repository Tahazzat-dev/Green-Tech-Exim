<!DOCTYPE html>
<html
x-data="{theme: localStorage.theme || 'light'}"
x-init="$watch('theme', value => {
    localStorage.theme = value;
})"
    :class="theme"lang="en"
>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} | Green Tech Exim</title>
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])


    <!-- font awesome starter kit -->
     <script src="https://kit.fontawesome.com/7a263e28c3.js" crossorigin="anonymous"></script>
</head>
<body x-data="{ mobileMenuOpen: true, profileDropdownOpen: false }" class="relative bg-bg-body text-text-body w-full h-full overflow-y-auto  min-h-screen flex flex-col" >
  @yield('content')
</body>
</html>

