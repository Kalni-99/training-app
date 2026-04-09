<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Two Factor Authentication') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    @if (auth()->user()->two_factor_secret)
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900">2FA is Enabled</h3>
                            <p class="mt-1 text-sm text-gray-600">Two factor authentication is currently active.</p>
                            
                            <form method="POST" action="{{ url('/user/two-factor-authentication') }}" class="mt-4">
                                @csrf
                                @method('DELETE')
                                <flux:button variant="danger" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" type="submit">Disable 2FA</flux:button>
                            </form>
                        </div>

                        <div class="mt-6">
                            <h4 class="font-medium text-gray-900">Recovery Codes</h4>
                            <p class="text-sm text-gray-600 mb-2">Store these codes in a safe place. Each code can only be used once.</p>
                            <div class="bg-gray-100 p-4 rounded-lg font-mono text-sm">
                                @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes, true)) as $code)
                                    <div>{{ $code }}</div>
                                @endforeach
                            </div>
                            <form method="POST" action="{{ url('/user/two-factor-recovery-codes') }}" class="mt-4">
                                @csrf
                                <flux:button variant="ghost" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded" type="submit">Regenerate Recovery Codes</flux:button>
                            </form>
                        </div>
                    @else
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Enable 2FA</h3>
                            <p class="mt-1 text-sm text-gray-600">Add an extra layer of security to your account.</p>
                            
                            <form method="POST" action="{{ url('/user/two-factor-authentication') }}" class="mt-4">
                                @csrf
                                <flux:button variant="primary" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" type="submit">Enable 2FA</flux:button>
                            </form>
                        </div>
                    @endif

                    @if (session('status') == 'two-factor-authentication-enabled')
                        <div class="mt-6 p-4 bg-green-50 border-l-4 border-green-400">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-700">Two factor authentication enabled! Scan the QR code with your authenticator app.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <h4 class="font-medium text-gray-900">QR Code</h4>
                            <div class="mt-2">
                                {!! auth()->user()->twoFactorQrCodeSvg() !!}
                            </div>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>