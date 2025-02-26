<div class="w-full">
    <div {{ $attributes->merge(['class' => 'max-w-7xl mx-auto sm:px-6 lg:px-8 my-12']) }} class="">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white text-slate-900 dark:text-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">


                {{ $slot }}


            </div>
        </div>
    </div>
</div>