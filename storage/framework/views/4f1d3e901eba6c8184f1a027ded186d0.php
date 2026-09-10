<?php $__env->startSection('title', 'Edit Category'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="custom-container max-w-3xl mx-auto p-4 py-7">

    <form
        action="<?php echo e(route('admin.categories.update', $category)); ?>"
        method="POST"
        enctype="multipart/form-data"
        class="bg-background border border-border rounded-xl p-5 space-y-5"
    >

        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <h1 class="font-semibold">
            Edit Category
        </h1>

        <div>

            <label class="block mb-2">
                Category Name
            </label>

            <input
                type="text"
                name="name"
                value="<?php echo e(old('name', $category->name)); ?>"
                class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
            >

        </div>

        <div>

            <label class="block mb-2">
                Category Image
            </label>

            <input
                type="file"
                name="image"
                class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
            >

        </div>

        <?php if($category->image): ?>

            <img
                src="<?php echo e(asset('storage/' . $category->image)); ?>"
                class="size-32 object-cover rounded-lg"
            >

        <?php endif; ?>

        <button
            type="submit"
            class="btn-primary px-6 py-3 rounded-lg"
        >
            Update Category
        </button>

    </form>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /data/projects/personal-projects/trophy-app/trophy-app-web/resources/views/admin/categories/edit.blade.php ENDPATH**/ ?>