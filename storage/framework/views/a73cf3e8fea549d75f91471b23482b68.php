<?php $__env->startSection('title', 'Edit User'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="custom-container flex-1 flex flex-col mx-auto p-4 py-7 md:px-6 lg:p-8 xl:p-10">

    <div class="w-full flex justify-between items-center mb-6">

        <h1 class="font-semibold">
            Edit User
        </h1>

        <a
            href="<?php echo e(route('admin.users.index')); ?>"
            class="px-4 py-2 rounded-lg border border-border"
        >
            Back
        </a>

    </div>

    <form
        action="<?php echo e(route('admin.users.update', $user)); ?>"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-5 bg-background border border-border rounded-xl p-5"
    >

        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div>
                <label class="block mb-2">
                    Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="<?php echo e(old('name', $user->name)); ?>"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
                >
            </div>

            <div>
                <label class="block mb-2">
                    Phone
                </label>

                <input
                    type="text"
                    name="phone"
                    value="<?php echo e(old('phone', $user->phone)); ?>"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
                >
            </div>

            <div>
                <label class="block mb-2">
                    Shop Name
                </label>

                <input
                    type="text"
                    name="shop_name"
                    value="<?php echo e(old('shop_name', $user->shop_name)); ?>"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
                >
            </div>

               <div>
                <label class="block mb-2">
                    Photo
                </label>

                <input
                    type="file"
                    name="photo"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
                >
            </div>

            <div>
                <label class="block mb-2">
                    City / Area
                </label>

                <input
                    type="text"
                    name="city_area"
                    value="<?php echo e(old('city_area', $user->city_area)); ?>"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
                >
            </div>

            <!-- <div>
                <label class="block mb-2">
                    Role
                </label>

                <select
                    name="role"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
                >
                    <option
                        value="user"
                        <?php if($user->role === 'user'): echo 'selected'; endif; ?>
                    >
                        User
                    </option>

                    <option
                        value="admin"
                        <?php if($user->role === 'admin'): echo 'selected'; endif; ?>
                    >
                        Admin
                    </option>
                </select>
            </div> -->

             <div>
                <label class="block mb-2">
                    Discount %
                </label>

                <input
                    type="number"
                    name="discount"
                    value="<?php echo e(old('discount', $user->discount)); ?>"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
                >
            </div>

            <div>
                <label class="block mb-2">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
                >
                    <option value="pending" <?php if($user->status === 'pending'): echo 'selected'; endif; ?>>
                        Pending
                    </option>

                    <option value="approved" <?php if($user->status === 'approved'): echo 'selected'; endif; ?>>
                        Approved
                    </option>

                    <option value="blocked" <?php if($user->status === 'blocked'): echo 'selected'; endif; ?>>
                        Blocked
                    </option>

                    <option value="rejected" <?php if($user->status === 'rejected'): echo 'selected'; endif; ?>>
                        Rejected
                    </option>
                </select>
            </div>

            <div>
                <label class="block mb-2">
                    New PIN
                    <?php if($user->plain_pin): ?>
                        <span class="text-sm text-text-body">(Current pin: <?php echo e($user->plain_pin); ?>)</span>
                    <?php endif; ?>
                </label>

                <input
                    type="text"
                    name="pin"
                    class="w-full rounded-lg border border-border bg-bg-body px-4 py-3"
                >
            </div>

            <div class="md:col-span-2 rounded-lg border border-border bg-bg-body p-4">
                <label class="flex items-start gap-3">
                    <input
                        type="checkbox"
                        name="device_change_allowed"
                        value="1"
                        <?php if(old('device_change_allowed', $user->device_change_allowed)): echo 'checked'; endif; ?>
                        class="mt-1"
                    >
                    <span>
                        <span class="block font-semibold">
                            Allow new device login
                        </span>
                        <span class="block text-sm text-text-body">
                            The next correct mobile login will replace the current device and disable this permission.
                        </span>
                    </span>
                </label>
            </div>
        </div>

        <button
            type="submit"
            class="btn-primary px-6 py-3 rounded-lg"
        >
            Update User
        </button>

    </form>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/tahazzat/works/projects/personal-projects/trophy-app/trophy-app-web/resources/views/admin/users/edit.blade.php ENDPATH**/ ?>