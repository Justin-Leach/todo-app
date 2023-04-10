<button {{ $attributes->merge(['class' => 'relative ml-3 inline-block text-lg group disabled:opacity-25']) }}>
    <span class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-red-800 transition-colors duration-300 ease-out border-2 border-red-900 rounded-lg group-hover:text-white">
    <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-red-50"></span>
    <span class="absolute left-0 w-80 h-80 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-red-900 group-hover:-rotate-180 ease"></span>
    <span class="relative">{{ $title }}</span>
    </span>
    <span class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-red-900 rounded-lg group-hover:mb-0 group-hover:mr-0" data-rounded="rounded-lg"></span>
</button>