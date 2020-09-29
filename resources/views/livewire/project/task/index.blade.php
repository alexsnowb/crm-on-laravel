<div>
    <div class="bg-white px-4 py-3 sm:px-6">
        <form class="my-4 flex" wire:submit.prevent="addNewTask">
            <input type="text" class="w-full rounded border shadow p-2 mr-2 my-2"
                   placeholder="New task"
                   wire:model="newTaskTitle">
            <div class="py-2">
                <button type="submit" class="items-center p-2 my-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150  justify-end">
                    Add
                </button>
            </div>
        </form>
        @if (session()->has('message'))
            <div class="p-3 bg-green-300 text-green-800 rounded shadow-sm">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm leading-5 font-medium text-gray-500">
            Task list
        </dt>
        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
            @forelse($tasks as $task)
                <div class="card mb-3">{{ $task->title }}</div>
            @empty
                No tasks yet
            @endforelse
            {{ $tasks->links() }}
        </dd>
    </div>
</div>
