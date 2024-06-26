<div class="rounded-md bg-{{ $alert['color'] }}-50 p-4 my-2 {{ $customClass }}" x-data="{ show: true }" x-show="show"
    x-transition>
    <div class="flex">
        <div class="flex-shrink-0">
            {!! $alert['icon'] !!}
        </div>
        <div class="ml-3">
            <p class="text-sm font-medium text-{{ $alert['color'] }}-800">{{ $message }}</p>
        </div>
        <div class="ml-auto pl-3">
            <div class="-mx-1.5 -my-1.5">
                <button type="button" @click="show = false"
                    class="inline-flex rounded-md bg-{{ $alert['color'] }}-50 p-1.5 text-{{ $alert['color'] }}-500 hover:bg-{{ $alert['color'] }}-100 focus:outline-none focus:ring-2 focus:ring-{{ $alert['color'] }}-600 focus:ring-offset-2 focus:ring-offset-{{ $alert['color'] }}-50">
                    <span class="sr-only">Dismiss</span>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        aria-hidden="true">
                        <path
                            d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
