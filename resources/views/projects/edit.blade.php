<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Uređivanje projekta: {{ $project->naziv }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('status'))
                    <div class="mb-4 text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- Voditelj vidi sva polja --}}
                @if ($isVoditelj)
                    <form method="POST" action="{{ route('projects.update', $project) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">
                                Naziv projekta
                            </label>
                            <input type="text" name="naziv" value="{{ old('naziv', $project->naziv) }}"
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
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('opis', $project->opis) }}</textarea>
                            @error('opis')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">
                                Cijena
                            </label>
                            <input type="number" step="0.01" name="cijena" value="{{ old('cijena', $project->cijena) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                            @error('cijena')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">
                                Obavljeni poslovi
                            </label>
                            <textarea name="obavljeni_poslovi" rows="3"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('obavljeni_poslovi', $project->obavljeni_poslovi) }}</textarea>
                            @error('obavljeni_poslovi')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">
                                Datum početka
                            </label>
                            <input type="date" name="datum_pocetka" value="{{ old('datum_pocetka', $project->datum_pocetka) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                            @error('datum_pocetka')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700">
                                Datum završetka
                            </label>
                            <input type="date" name="datum_zavrsetka" value="{{ old('datum_zavrsetka', $project->datum_zavrsetka) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                            @error('datum_zavrsetka')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <x-primary-button>
                            Spremi sve promjene
                        </x-primary-button>
                    </form>
                @elseif ($isClan)
                    {{-- Član tima vidi samo obavljene poslove --}}
                    <form method="POST" action="{{ route('projects.update', $project) }}">
                        @csrf
                        @method('PUT')

                        <p class="mb-4 text-sm text-gray-700">
                            Kao član projektnog tima možete uređivati samo polje <strong>Obavljeni poslovi</strong>.
                        </p>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700">
                                Obavljeni poslovi
                            </label>
                            <textarea name="obavljeni_poslovi" rows="4"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('obavljeni_poslovi', $project->obavljeni_poslovi) }}</textarea>
                            @error('obavljeni_poslovi')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <x-primary-button>
                            Spremi obavljene poslove
                        </x-primary-button>
                    </form>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
