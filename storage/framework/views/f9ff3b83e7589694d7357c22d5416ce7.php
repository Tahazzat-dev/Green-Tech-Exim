<?php $__env->startSection('title', 'Categories'); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make("partials.header", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="custom-container flex-1 flex flex-col  mx-auto p-4 py-7 md:px-6 lg:p-8 xl:p-10">
    <!-- page title -->
   <div class="w-full flex lg:justify-center">
    <h1 class="font-semibold" >Categories</h1>
   </div>

   <!-- page content -->
    <div class="w-full pt-5 md:pt-7 gap-4 md:gap-5 grid grid-cols-2 sm:grid-cols-[repeat(auto-fill,minmax(230px,1fr))]">
        <a href="<?php echo e(route('new-arrivals')); ?>" class="flex flex-col items-center rounded-lg shadow border bg-linear-to-br from-slate-50 to-slate-100/40 dark:from-slate-900/70 dark:to-slate-900 border-border">
            <div class="relative rounded-b-xl bg-slate-200 dark:bg-slate-800 p-3 sm:p-4 aspect-square w-full">
                <img
                    src="<?php echo e(asset('images/trophy-big.png')); ?>"
                    alt="New Arrival"
                    class="h-full w-full object-contain drop-shadow-lg"
                    referrerPolicy="no-referrer"
                />
            </div>

            <div class="p-1 py-3 sm:py-4 w-full flex items-center justify-center gap-3">
                <h4 class="font-semibold">New Arrival</h4>
            </div>
        </a>

        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <!-- Trophy card -->
            <a  href="<?php echo e(route('trophies.all', $category->id)); ?>" class="flex flex-col items-center rounded-lg shadow border bg-linear-to-br from-slate-50 to-slate-100/40 dark:from-slate-900/70 dark:to-slate-900 border-border">
            <div class="relative rounded-b-xl bg-slate-200 dark:bg-slate-800 p-3 sm:p-4 aspect-square w-full">
                <img
                src="<?php echo e($category->image
                        ? asset('storage/' . $category->image)
                        : asset('images/trophy-big.png')); ?>"
                alt="<?php echo e($category->name); ?>"
                class="h-full w-full object-contain drop-shadow-lg"
                referrerPolicy="no-referrer"
                />
            </div>
            
            <div class="p-1 py-3 sm:py-4 w-full flex items-center justify-center gap-3">
                <h4 class="font-semibold"><?php echo e($category->name); ?></h4>
            </div>  
          </a>
        <!-- Trophy card -->
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
           <div class="col-span-full min-h-40 text-center py-10">

            <p class="text-center">
                No categories found.
            </p>

        </div>    
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/tahazzat/works/projects/personal-projects/trophy-app/trophy-app-web/resources/views/categories/categories.blade.php ENDPATH**/ ?>