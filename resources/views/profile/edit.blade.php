<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <hr class="my-6">

    <h2 class="text-lg font-medium text-gray-900">
        Projekti koje vodim
    </h2>

    @if($mojiProjekti->isEmpty())
        <p class="mt-2 text-sm text-gray-600">
            Trenutno ne vodite nijedan projekt.
        </p>
    @else
        <ul class="mt-2 list-disc list-inside text-sm text-gray-700">
            @foreach($mojiProjekti as $project)
                <li>
                    <strong>{{ $project->naziv }}</strong>
                    – od {{ $project->datum_pocetka }} do {{ $project->datum_zavrsetka }}
                </li>
            @endforeach
        </ul>
    @endif

    <hr class="my-6">

    <h2 class="text-lg font-medium text-gray-900">
        Projekti na kojima sam član
    </h2>

    @if($projektiClanstvo->isEmpty())
        <p class="mt-2 text-sm text-gray-600">
            Trenutno niste član nijednog projektnog tima.
        </p>
    @else
        <ul class="mt-2 list-disc list-inside text-sm text-gray-700">
            @foreach($projektiClanstvo as $project)
                <li>
                    <strong>{{ $project->naziv }}</strong>
                    – voditelj: {{ $project->voditelj?->name ?? 'N/A' }}
                </li>
            @endforeach
        </ul>
    @endif

</x-app-layout>
