<x-authentication-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-50 dark:bg-gray-900">
        <!-- Welcome Text -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('auth.welcome_back') }}</h1>
            <p class="text-gray-600 dark:text-gray-400">{{ __('auth.sign_in_to_account') }}</p>
        </div>

        <!-- Status Message -->
        @if (session('status'))
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                <p class="text-sm text-green-700 dark:text-green-400">{{ session('status') }}</p>
            </div>
        @endif

        <!-- Login Form -->
        <div class="w-full max-w-md">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
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
                        autofocus
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
                        autocomplete="current-password"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-transparent dark:bg-gray-800 dark:text-white transition-colors"
                        placeholder="{{ __('auth.enter_your_password') }}"
                    />
                </div>

                <!-- Forgot Password Link -->
                @if (Route::has('password.request'))
                    <div class="text-right">
                        <a 
                            href="{{ route('password.request') }}" 
                            class="text-sm text-violet-600 dark:text-violet-400 hover:text-violet-700 dark:hover:text-violet-300 transition-colors"
                        >
                            {{ __('auth.forgot_your_password') }}
                        </a>
                    </div>
                @endif

                <!-- Sign In Button -->
                <button 
                    type="submit"
                    class="w-full bg-violet-600 hover:bg-violet-700 text-white font-medium py-3 px-4 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    {{ __('auth.sign_in') }}
                </button>
            </form>

            <!-- Validation Errors -->
            <x-validation-errors class="mt-4" />

            <!-- Sign Up Link -->
            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('auth.dont_have_account') }}
                    <a 
                        href="{{ route('register') }}" 
                        class="font-medium text-violet-600 dark:text-violet-400 hover:text-violet-700 dark:hover:text-violet-300 transition-colors"
                    >
                        {{ __('auth.sign_up') }}
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-authentication-layout>
