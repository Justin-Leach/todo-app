<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">

        <div class="flex flex-row">


            <div class="w-3/12">
                <!-- Profile Photo -->
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div x-data="{ photoName: null, photoPreview: null }" class="flex flex-col">

                        <!-- Profile Photo File Input -->
                        <input type="file" class="hidden" wire:model="photo" x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                        <x-jet-label for="photo" value="{{ __('Photo') }}" />

                        <!-- Current Profile Photo -->
                        <div class="mt-2 flex justify-center" x-show="! photoPreview">
                            <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                                class="rounded-full h-36 w-36 object-cover">
                        </div>

                        <!-- New Profile Photo Preview -->
                        <div class="mt-2 flex justify-center" x-show="photoPreview" style="display: none;">
                            <span class="block rounded-full w-36 h-36 bg-cover bg-no-repeat bg-center"
                                x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                            </span>
                        </div>

                        <div class="flex flex-row space-x-4">
                            <button class="relative h-8 inline-block text-sm group mt-2" x-on:click.prevent="$refs.photo.click()">
                                <span class="relative h-8 z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-gray-800 transition-colors duration-300 ease-out border-2 border-gray-900 rounded-lg group-hover:text-white">
                                    <span class="absolute inset-0 w-full h-8 px-5 py-3 rounded-lg bg-gray-50"></span>
                                    <span class="absolute left-0 w-48 h-48 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-gray-900 group-hover:-rotate-180 ease"></span>
                                    <span class="relative bottom-1.5 left-0"><p>{{ __('New Photo') }}</p></span>
                                </span>
                                <span class="absolute bottom-0 right-0 w-full h-8 -mb-0.5 -mr-0.5 transition-all duration-200 ease-linear bg-gray-900 rounded-lg group-hover:mb-0 group-hover:mr-0" data-rounded="rounded-lg"></span>
                            </button>

                            <button class="relative h-8 inline-block text-sm group mt-2 disabled:opacity-25" wire:click="deleteProfilePhoto" :disabled={{is_null($this->user->profile_photo_path)}}>
                                <span class="relative h-8 z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-gray-800 transition-colors duration-300 ease-out border-2 border-gray-900 rounded-lg group-hover:text-white">
                                    <span class="absolute inset-0 w-full h-8 px-5 py-3 rounded-lg bg-gray-50"></span>
                                    <span class="absolute left-0 w-48 h-48 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-gray-900 group-hover:-rotate-180 ease"></span>
                                    <span class="relative bottom-1.5 left-0"><p>{{ __('Remove Photo') }}</p></span>
                                </span>
                                <span class="absolute bottom-0 right-0 w-full h-8 -mb-0.5 -mr-0.5 transition-all duration-200 ease-linear bg-gray-900 rounded-lg group-hover:mb-0 group-hover:mr-0" data-rounded="rounded-lg"></span>
                            </button>
                        </div>

                        <x-jet-input-error for="photo" class="mt-2" />
                    </div>
                @endif
            </div>

            <div class="w-9/12 pl-4">
                <!-- Name -->
                <div class="mt-4 w-full">
                    <label class="block font-medium text-sm text-gray-700" for="name">{{ __('Name') }}</label>
                    <input
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm"
                        id="name" type="text" wire:model.defer="state.name" autocomplete="name">
                    <x-jet-input-error for="name" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mt-4 w-full">
                    <label class="block font-medium text-sm text-gray-700" for="email">{{ __('Email') }}</label>
                    <input
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm"
                        id="email" type="email" wire:model.defer="state.email">
                    <x-jet-input-error for="email" class="mt-2" />

                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                            !$this->user->hasVerifiedEmail())
                        <p class="text-sm mt-2">
                            {{ __('Your email address is unverified.') }}

                            <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900"
                                wire:click.prevent="sendEmailVerification">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if ($this->verificationLinkSent)
                            <p v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    @endif
                </div>
            </div>
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <button class="relative w-32 inline-block text-lg group disabled:opacity-25" wire:loading.attr="disabled" wire:target="photo">
            <span class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-gray-800 transition-colors duration-300 ease-out border-2 border-gray-900 rounded-lg group-hover:text-white">
            <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-gray-50"></span>
            <span class="absolute left-0 w-48 h-48 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-gray-900 group-hover:-rotate-180 ease"></span>
            <span class="relative">{{ __('Save') }}</span>
            </span>
            <span class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-gray-900 rounded-lg group-hover:mb-0 group-hover:mr-0" data-rounded="rounded-lg"></span>
        </button>
    </x-slot>
</x-form-section>
