<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <h2 class="text-3xl">重設密碼</h2>        
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
           請輸入您的電郵地址，系統將發送重設密碼的連結到您的郵箱，請按下連結重新設定新密碼。 
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                   提交
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
