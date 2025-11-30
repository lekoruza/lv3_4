<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Novi projekt
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('projects.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Naziv projekta
                        </label>
                        <input type="text" name="naziv" value="{{ old('naziv') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        @error('naziv')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Opis
                        </label>
                        <textarea name="opis" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('opis') }}</textarea>
                        @error('opis')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Cijena
                        </label>
                        <input type="number" step="0.01" name="cijena" value="{{ old('cijena') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        @error('cijena')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Obavljeni poslovi (opcijski)
                        </label>
                        <textarea name="obavljeni_poslovi" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('obavljeni_poslovi') }}</textarea>
                        @error('obavljeni_poslovi')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Datum početka
                        </label>
                        <input type="date" name="datum_pocetka" value="{{ old('datum_pocetka') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        @error('datum_pocetka')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">
                            Datum završetka
                        </label>
                        <input type="date" name="datum_zavrsetka" value="{{ old('datum_zavrsetka') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        @error('datum_zavrsetka')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">
                            Članovi projektnog tima
                        </label>

                        @if($users->isEmpty())
                            <p class="mt-1 text-sm text-gray-600">
                                Trenutno nema drugih registriranih korisnika koje biste mogli dodati kao članove.
                            </p>
                        @else
                            <div class="mt-2 space-y-1">
                                @foreach($users as $user)
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="clanovi[]" value="{{ $user->id }}"
                                               class="rounded border-gray-300">
                                        <span class="ml-2 text-sm text-gray-700">
                                            {{ $user->name }} ({{ $user->email }})
                                        </span>
                                    </label><br>
                                @endforeach
                            </div>
                        @endif

                        @error('clanovi')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <x-primary-button>
                        Kreiraj projekt
                    </x-primary-button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
