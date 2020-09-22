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

                @forelse($projects as $project)
                    @if($loop->first)
                        <table class="table-auto w-auto">
                            <thead>
                            <tr>
                                <th class="px-4 py-2">Id</th>
                                <th class="px-4 py-2">Title</th>
                                <th class="px-4 py-2">Author</th>
                            </tr>
                            </thead>
                            <tbody>
                    @endif
                    <tr>
                        <td class="border px-4 py-2">{{ $project->id }}</td>
                        <td class="border px-4 py-2"><a href="{{ $project->path() }}"> {{ $project->title }} </a></td>
                        <td class="border px-4 py-2">{{ $project->owner->name }}</td>
                    </tr>
                    @if($loop->last)
                            </tbody>
                        </table>
                    @endif

                @empty
                    <h3>No projects yet.</h3>
                @endforelse

        </div>
    </div>
</x-app-layout>
