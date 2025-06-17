<x-authentication-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-50 dark:bg-gray-900">

        <!-- Welcome Text -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('Create your account') }}</h1>
            <p class="text-gray-600 dark:text-gray-400">{{ __('auth.get_started_free') }}</p>
        </div>

        <!-- Registration Form -->
        <div class="w-full max-w-md">
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('auth.full_name') }}
                    </label>
                    <input 
                        id="name" 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        autofocus 
                        autocomplete="name"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-transparent dark:bg-gray-800 dark:text-white transition-colors"
                        placeholder="{{ __('auth.enter_your_full_name') }}"
                    />
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('auth.email_address') }}
                    </label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-transparent dark:bg-gray-800 dark:text-white transition-colors"
                        placeholder="{{ __('auth.enter_your_email') }}"
                    />
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Password') }}
                    </label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="new-password"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-transparent dark:bg-gray-800 dark:text-white transition-colors"
                        placeholder="{{ __('auth.create_password') }}"
                    />
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('auth.confirm_password') }}
                    </label>
                    <input 
                        id="password_confirmation" 
                        type="password" 
                        name="password_confirmation" 
                        required 
                        autocomplete="new-password"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-transparent dark:bg-gray-800 dark:text-white transition-colors"
                        placeholder="{{ __('auth.confirm_your_password') }}"
                    />
                </div>

                <!-- Terms and Privacy Policy -->
                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="flex items-start">
                        <input 
                            id="terms" 
                            type="checkbox" 
                            name="terms"
                            required
                            class="h-4 w-4 text-violet-600 focus:ring-violet-500 border-gray-300 rounded mt-1"
                        />
                        <label for="terms" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-violet-600 dark:text-violet-400 hover:text-violet-700 dark:hover:text-violet-300">'.__('Terms of Service').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-violet-600 dark:text-violet-400 hover:text-violet-700 dark:hover:text-violet-300">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </label>
                    </div>
                @endif

                <!-- Sign Up Button -->
                <button 
                    type="submit"
                    class="w-full bg-violet-600 hover:bg-violet-700 text-white font-medium py-3 px-4 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    {{ __('auth.create_account') }}
                </button>
            </form>

            <!-- Validation Errors -->
            <x-validation-errors class="mt-4" />

            <!-- Sign In Link -->
            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('auth.already_have_account') }}
                    <a 
                        href="{{ route('login') }}" 
                        class="font-medium text-violet-600 dark:text-violet-400 hover:text-violet-700 dark:hover:text-violet-300 transition-colors"
                    >
                        {{ __('auth.sign_in') }}
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-authentication-layout>
