<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
        <div>
            <a href="/dashboard/projects/create" class="text-blue-500 hover:text-blue-800" >
                {{ __('Create') }}
            </a>
        </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            @livewire('project.index')

        </div>
    </div>
</x-app-layout>
