<div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 shadow sm:px-6 sm:pt-6">
    <dt>
        <div class="absolute rounded-md bg-indigo-500 p-3">
            {{ $slot }}
        </div>
        <p class="ml-16 truncate text-sm font-medium text-gray-500">{{ $title }}</p>
    </dt>
    <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
        <p class="text-2xl font-semibold text-gray-900">{{ $count }}</p>
    </dd>
</div>
