<?php $__env->startSection('title', 'Products'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="custom-container flex-1 flex flex-col mx-auto p-4 py-7 md:px-6 lg:p-8 xl:p-10">
<!-- Header -->
<div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-6">

    <div class="flex justify-between items-center">
        <h1 class="font-semibold">
        Products
    </h1>
    <a
            href="<?php echo e(route('admin.products.create')); ?>"
            class="sm:hidden btn-primary px-4 py-2 rounded-lg whitespace-nowrap text-center"
        >
            Add Product
        </a>
    </div>
    <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">

        <!-- Search Form -->
        <form
            action="<?php echo e(route('admin.products.index')); ?>"
            method="GET"
            class="flex items-center w-full pr-1.5 md:w-[320px] rounded-lg overflow-hidden border border-border bg-bg-body"
        >
            <input
                type="text"
                name="search"
                value="<?php echo e(request('search')); ?>"
                placeholder="Search products..."
                class="w-full bg-transparent px-4 py-1.5 outline-none text-text-body"
            >
            <button
                type="submit"
                class="rounded-full btn btn-primary p-1 shrink-0"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="size-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 21l-4.35-4.35M16 10.5A5.5 5.5 0 1 1 5 10.5a5.5 5.5 0 0 1 11 0Z"
                    />
                </svg>
            </button>

        </form>

        <!-- Add Product -->
        <a
            href="<?php echo e(route('admin.products.create')); ?>"
            class="hidden sm:block btn-primary px-4 py-2 rounded-lg whitespace-nowrap text-center"
        >
            Add Product
        </a>

    </div>

</div>

<!-- Search Result -->
<?php if(request('search')): ?>

    <div class="mb-5">

        <p class="text-sm text-text-body">

            Search result for:

            <span class="font-semibold">
                "<?php echo e(request('search')); ?>"
            </span>

        </p>

    </div>

<?php endif; ?>

<!-- Products Grid -->
<div class="grid grid-cols-2 sm:grid-cols-[repeat(auto-fill,minmax(230px,1fr))] gap-5">

    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
            $statusClasses = match ($product->status) {
                'in_stock' => 'text-green-500',
                'limited' => 'text-yellow-500',
                default => 'text-red-500',
            };

            $statusLabel = match ($product->status) {
                'in_stock' => 'In Stock',
                'limited' => 'Limited',
                default => 'Stock Out',
            };
        ?>

        <div class="rounded-xl border border-border bg-background overflow-hidden shadow-sm">

            <!-- Product Image -->
            <!-- <div class="aspect-square relative bg-bg-body w-full p-4 max-h-56"> -->

                <img
                    src="<?php echo e($product->image ? asset('storage/' . $product->image) : asset('images/trophy-small.jpeg')); ?>"
                    class="rounded-lg"
                    alt="<?php echo e($product->name); ?>"
                >


                <?php if($product->is_top_product): ?>

                        <span class="absolute top-2.5 right-2.5 text-xs px-2 py-1 rounded bg-yellow-500 text-white shrink-0">
                            Top
                        </span>

                    <?php endif; ?>

                <?php if($product->is_new_arrival): ?>
                    <span class="absolute top-2.5 left-2.5 text-xs px-2 py-1 rounded bg-blue-500 text-white shrink-0">
                        New
                    </span>
                <?php endif; ?>
            <!-- </div> -->

            <!-- Product Info -->
            <div class="p-4">

                <div class="flex items-start justify-between gap-2">

                    <h6 class="font-semibold line-clamp-2">
                        <?php echo e($product->name); ?>

                    </h6>
                </div>
                <!-- Status -->
                <div class="flex justify-between">
                    <p class="text-sm text-text-body mt-1">
                    <?php echo e($product->category?->name); ?>

                </p>
                    <span
                        class="text-sm rounded <?php echo e($statusClasses); ?>"
                    >
                        <?php echo e($statusLabel); ?>


                    </span>
                </div>

                <!-- Actions -->
                <div class="flex flex-wrap gap-2 mt-3">

                    <a
                        href="<?php echo e(route('admin.products.show', $product)); ?>"
                        class="px-3 py-1 rounded bg-slate-700 text-white text-sm"
                    >
                        View
                    </a>

                    <a
                        href="<?php echo e(route('admin.products.edit', $product)); ?>"
                        class="px-3 py-1 rounded bg-blue-500 text-white text-sm"
                    >
                        Edit
                    </a>

                    <form
                        action="<?php echo e(route('admin.products.destroy', $product)); ?>"
                        method="POST"
                    >

                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>

                        <button
                            type="submit"
                            onclick="return confirm('Delete product?')"
                            class="px-3 py-1 rounded bg-red-500 text-white text-sm"
                        >
                            Delete
                        </button>

                    </form>

                </div>

            </div>

        </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

        <div class="col-span-full text-center py-14">

            <h3 class="font-semibold text-lg">
                No products found
            </h3>

            <?php if(request('search')): ?>

                <p class="text-text-body mt-2">
                    Try searching with another keyword.
                </p>

            <?php endif; ?>

        </div>

    <?php endif; ?>

</div>

<!-- Pagination -->
<div class="mt-8">

    <?php echo e($products->withQueryString()->links()); ?>


</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /data/projects/personal-projects/trophy-app/trophy-app-web/resources/views/admin/products/index.blade.php ENDPATH**/ ?>