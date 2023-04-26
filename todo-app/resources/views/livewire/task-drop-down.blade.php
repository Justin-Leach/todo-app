<div x-data="{ isOpen: false }" class="relative" x-cloak>
    <div>
        <span @click="isOpen = !isOpen" class="rounded-md shadow-sm">
            <button type="button"
                class="inline-flex justify-center items-center w-full h-6 border border-gray-300 pl-2 pr-1 py-0.5 bg-white text-xs font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                id="options-menu" aria-haspopup="true" aria-expanded="true">
                {{ $selectedOptionValue }}
                <svg role="presentation" width="10" height="10" viewBox="5 5 13 13">
                    <path
                        d="M8.292 10.293a1.009 1.009 0 0 0 0 1.419l2.939 2.965c.218.215.5.322.779.322s.556-.107.769-.322l2.93-2.955a1.01 1.01 0 0 0 0-1.419.987.987 0 0 0-1.406 0l-2.298 2.317-2.307-2.327a.99.99 0 0 0-1.406 0z"
                        fill="currentColor" fill-rule="evenodd"></path>
                </svg>
            </button>
        </span>
    </div>

    <div x-show="isOpen" @click.away="isOpen = false"
        class="origin-top-right absolute right-0 z-20 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
        role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
        <div class="py-1" role="none">
            @foreach ($options as $option)
                @if ($option->name !== $selectedOptionValue)
                    <a wire:click="selectOption('{{ $option->id }}', '{{ $option->name }}')" @click="isOpen = false" href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"role="menuitem">
                        {{ $option->name }}
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</div>
