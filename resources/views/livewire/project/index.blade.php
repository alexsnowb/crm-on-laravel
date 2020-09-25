<div class="container">
    <input type="text"  class="appearance-none block w-full bg-white text-gray-900 font-medium border border-gray-400 rounded-lg py-3 px-3 leading-tight focus:outline-none" placeholder="Search" wire:model="searchTerm" />

    @forelse($projects as $project)
        @if($loop->first)
            <table class="min-w-full">
                <thead>
                <tr>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Owner</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                </tr>
                </thead>

                <tbody class="bg-white">
                @endif
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                        {{ $project->id }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                        {{ $project->title }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                        {{ $project->description }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ $project->owner->name }}&color=7F9CF5&background=EBF4FF" alt="" />
                            </div>
                            <div class="ml-4">
                                <div class="text-sm leading-5 font-medium text-gray-900">{{ $project->owner->name }}</div>
                                <div class="text-sm leading-5 text-gray-500">{{ $project->owner->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                        <a href="{{$project->path()}}" class="text-indigo-600 hover:text-indigo-900">{{__('View')}}</a>
                    </td>
                </tr>
                @if($loop->last)
                </tbody>
            </table>
            {{ $projects->links() }}
        @endif
    @empty
        <h3>No projects yet.</h3>
    @endforelse
</div>

