<x-app-layout>

    <div class="p-4   border-dashed rounded-lg dark:border-gray-700">
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div class="flex items-center justify-center h-24 rounded ">

            </div>
            <div class="flex items-center justify-center h-24 rounded ">

            </div>
            <div class="flex items-center justify-center h-24 rounded ">

            </div>
        </div>
        <div class="flex items-center justify-center h-auto mb-6 rounded bg-gray-50 dark:bg-gray-800">

            <div class="w-5/6 lg:w-2/4 xl:w-2/4 ">

                <form method="POST" action="{{ url('users') }}/{{ $rowuser->id }}">
                    @csrf
                    {{ method_field('PUT') }}
                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="$rowuser->name" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="$rowuser->email" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- roles  -->
                    <div class="mt-4">
                        <x-input-label for="role" :value="__('Role')" />
                        <x-selected id="role" name="role" :items="$roles" :select="$selectrole" required />
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="active" :value="__('Status')" />
                        <input id="active" name="active" type="checkbox" {{ $rowuser->active ? 'checked' : '' }} />

                        <x-input-error :messages="$errors->get('active')" class="mt-2" />
                    </div>


                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('New Password')" />

                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                            autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">

                        <x-primary-button class="ml-4">
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>


        </div>

        <div class="grid grid-cols-3 gap-4 mb-4 h-full">
            <div class="flex items-center justify-center h-24 rounded ">

            </div>
            <div class="flex items-center justify-center h-24 rounded ">

            </div>
            <div class="flex items-center justify-center h-24 rounded ">

            </div>
        </div>

    </div>


</x-app-layout>
