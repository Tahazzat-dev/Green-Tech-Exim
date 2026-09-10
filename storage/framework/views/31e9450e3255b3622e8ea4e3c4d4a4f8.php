<?php $__env->startSection('title', 'Categories'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="custom-container flex-1 flex flex-col mx-auto p-4 py-7 md:px-6 lg:p-8 xl:p-10">

    <!-- title -->
    <div class="flex items-center justify-between mb-6">

        <h1 class="font-semibold">
            Categories
        </h1>

        <a
            href="<?php echo e(route('admin.categories.create')); ?>"
            class="btn-primary px-4 py-2 rounded-lg"
        >
            Add Category
        </a>

    </div>

    <!-- categories -->
    <div class="grid grid-cols-2 sm:grid-cols-[repeat(auto-fill,minmax(230px,1fr))] gap-5">

        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

            <div class="rounded-xl border border-border bg-background overflow-hidden shadow-sm">

                <div class="aspect-square bg-bg-body p-4">

                    <img
                        src="<?php echo e($category->image ? asset('storage/' . $category->image) : asset('images/trophy-big.png')); ?>"
                        class="w-full h-full object-contain"
                    >

                </div>

                <div class="p-4">

                    <h3 class="font-semibold">
                        <?php echo e($category->name); ?>

                    </h3>

                    <div class="flex gap-2 mt-4">

                        <a
                            href="<?php echo e(route('admin.categories.show', $category)); ?>"
                            class="px-3 py-2 rounded bg-slate-700 text-white text-sm"
                        >
                            View
                        </a>

                        <a
                            href="<?php echo e(route('admin.categories.edit', $category)); ?>"
                            class="px-3 py-2 rounded bg-blue-500 text-white text-sm"
                        >
                            Edit
                        </a>

                        <form
                            action="<?php echo e(route('admin.categories.destroy', $category)); ?>"
                            method="POST"
                        >

                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>

                            <button
                                onclick="return confirm('Delete category?')"
                                class="px-3 py-2 rounded bg-red-500 text-white text-sm"
                            >
                                Delete
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

            <div class="col-span-full text-center py-10">
                No categories found.
            </div>

        <?php endif; ?>

    </div>

    <div class="mt-6">
        <?php echo e($categories->links()); ?>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /data/projects/personal-projects/trophy-app/trophy-app-web/resources/views/admin/categories/index.blade.php ENDPATH**/ ?>