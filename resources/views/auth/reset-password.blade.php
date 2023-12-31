<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
           <h2 class="text-3xl">設定新密碼</h2>
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input  id="email" readonly class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="新密碼 (最少 8 個字元) " />
                <x-input minlength="8" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="確認新密碼 (最少 8 個字元) " />
                <x-input minlength="8" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                   提交
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
