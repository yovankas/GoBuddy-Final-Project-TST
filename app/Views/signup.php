<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-md">
        <div>
            <h2 class="text-center text-3xl font-extrabold text-gray-900">Create your account</h2>
        </div>

        <?php if(isset($validation)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <form class="mt-8 space-y-6" action="<?php echo base_url(); ?>/SignupController/store" method="post">
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <input type="text" name="name" required
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                        placeholder="Full name" value="<?= set_value('name') ?>">
                </div>
                <div>
                    <input type="email" name="email" required
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                        placeholder="Email address" value="<?= set_value('email') ?>">
                </div>
                <div>
                    <input type="password" name="password" required
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                        placeholder="Password">
                </div>
                <div>
                    <input type="password" name="confirmpassword" required
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                        placeholder="Confirm password">
                </div>
            </div>

            <div>
                <button type="submit"
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Create Account
                </button>
            </div>

            <div class="text-center">
                <a href="/signin" class="text-sm text-blue-600 hover:text-blue-800">Already have an account? Sign in</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>