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
<body class="relative bg-bg-body text-text-body w-full h-full min-h-screen flex flex-col" >
  <div class="absolute top-4 right-4">
       <button @click="theme = theme === 'dark' ? 'light' : 'dark'"

        class="px-4 py-2 rounded-xl bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 transition"
    >

        <span x-show="theme=='dark'">
            🌙
        </span>

        <span x-show="theme=='light'">
            ☀️
        </span>

    </button>
  </div>
  @yield('content')
</body>
</html>

