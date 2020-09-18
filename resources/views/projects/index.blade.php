<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <ul>
                @forelse($projects as $project)
                    <li>
                        <a href="{{ $project->path() }}"> {{ $project->title }} </a>
                    </li>
                @empty
                    <li>No projects yet.</li>
                @endforelse
            </ul>
        </div>
    </div>
</x-app-layout>
