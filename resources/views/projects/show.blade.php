<x-app-layout>
    <x-slot name="header">
        @livewire('project.header')
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Project Information
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                        Project details
                    </p>
                </div>
                <div>
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">
                                Title
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $project->title }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">
                                Description
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $project->description }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">
                                Owner
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $project->owner->name }}
                            </dd>
                        </div>
                        @livewire('project.task.index', ['project' => $project])

                    </dl>
                </div>
                <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
                    <a href="{{ $project->path() }}/edit/" class="items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150  justify-end">
                        {{__('Edit Project')}}
                    </a>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>
