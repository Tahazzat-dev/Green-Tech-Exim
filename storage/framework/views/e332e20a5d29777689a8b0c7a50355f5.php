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
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> | Green Tech</title>
    <?php echo $__env->yieldContent('head'); ?>
    <?php echo app('Illuminate\Foundation\Vite')([
        'resources/css/app.css',
        'resources/js/app.js'
    ]); ?>


    <!-- font awesome starter kit -->
     <script src="https://kit.fontawesome.com/7a263e28c3.js" crossorigin="anonymous"></script>
</head>
<body x-data="{ mobileMenuOpen: false, profileDropdownOpen: false, deleteAccountModalOpen: false, guestProductModalOpen: false }" class="relative bg-bg-body text-text-body w-full h-auto  min-h-screen flex flex-col" >
  <?php echo $__env->yieldContent('content'); ?>
</body>
</html>
<?php /**PATH /home/tahazzat/works/projects/personal-projects/trophy-app/trophy-app-web/resources/views/layouts/app.blade.php ENDPATH**/ ?>