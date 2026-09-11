<?php $__env->startSection('title', 'Contacts'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="custom-container flex-1 flex flex-col mx-auto p-4 py-7 md:px-6 lg:p-8 xl:p-10">

    <div class="flex items-center justify-between mb-6">

        <h1 class="font-semibold">
            Contacts
        </h1>

        <a
            href="<?php echo e(route('admin.contacts.create')); ?>"
            class="btn-primary px-4 py-2 rounded-lg"
        >
            Add Contact
        </a>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

        <?php $__empty_1 = true; $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

            <div class="bg-background border border-border rounded-xl p-5">

                <div class="flex flex-col items-center text-center">

                    <img
                        src="<?php echo e($contact->profile ? asset('storage/' . $contact->profile) : 'https://placehold.co/120x120'); ?>"
                        class="size-24 rounded-full object-cover border border-border"
                    >

                    <h3 class="font-semibold mt-4">
                        <?php echo e($contact->name); ?>

                    </h3>

                    <p class="text-text-body text-sm mt-1">
                        <?php echo e($contact->designation); ?>

                    </p>

                    <p class="mt-2">
                        <?php echo e($contact->phone); ?>

                    </p>

                    <div class="mt-3">

                        <span class="px-3 py-1 rounded text-sm
                            <?php echo e($contact->status
                                ? 'bg-green-500 text-white'
                                : 'bg-red-500 text-white'); ?>"
                        >
                            <?php echo e($contact->status ? 'Active' : 'Inactive'); ?>

                        </span>

                    </div>

                </div>

                <div class="flex gap-2 mt-5">

                    <a
                        href="<?php echo e(route('admin.contacts.show', $contact)); ?>"
                        class="flex-1 text-center px-3 py-2 rounded bg-slate-700 text-white text-sm"
                    >
                        View
                    </a>

                    <a
                        href="<?php echo e(route('admin.contacts.edit', $contact)); ?>"
                        class="flex-1 text-center px-3 py-2 rounded bg-blue-500 text-white text-sm"
                    >
                        Edit
                    </a>

                    <form
                        action="<?php echo e(route('admin.contacts.destroy', $contact)); ?>"
                        method="POST"
                    >

                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>

                        <button
                            onclick="return confirm('Delete contact?')"
                            class="px-3 py-2 rounded bg-red-500 text-white text-sm"
                        >
                            Delete
                        </button>

                    </form>

                </div>

            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

            <div class="col-span-full text-center py-10">
                No contacts found.
            </div>

        <?php endif; ?>

    </div>

    <div class="mt-6">
        <?php echo e($contacts->links()); ?>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/tahazzat/works/projects/personal-projects/trophy-app/trophy-app-web/resources/views/admin/contacts/index.blade.php ENDPATH**/ ?>