<x-authentication-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-50 dark:bg-gray-900">
        <!-- Welcome Text -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('auth.reset_password') }}</h1>
            <p class="text-gray-600 dark:text-gray-400">{{ __('auth.enter_email_reset_link') }}</p>
        </div>

        <!-- Status Message -->
        @if (session('status'))
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                <p class="text-sm text-green-700 dark:text-green-400">{{ session('status') }}</p>
            </div>
        @endif

        <!-- Reset Form -->
        <div class="w-full max-w-md">
            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
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

                <!-- Send Reset Link Button -->
                <button 
                    type="submit"
                    class="w-full bg-violet-600 hover:bg-violet-700 text-white font-medium py-3 px-4 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    {{ __('auth.send_reset_link') }}
                </button>
            </form>

            <!-- Validation Errors -->
            <x-validation-errors class="mt-4" />

            <!-- Back to Login Link -->
            <div class="mt-8 text-center">
                <a 
                    href="{{ route('login') }}" 
                    class="text-sm text-violet-600 dark:text-violet-400 hover:text-violet-700 dark:hover:text-violet-300 transition-colors"
                >
                    {{ __('auth.back_to_login') }}
                </a>
            </div>
        </div>
    </div>
</x-authentication-layout>
