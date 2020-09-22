<div>
    <h4>{{__('Create Project')}}</h4>

    <form wire:submit.prevent="createProject" class="w-full max-w-sm">
        <input type="text" wire:model="project.title">
        @error('project.title') <span class="error">{{ $message }}</span> @enderror

        <input type="text" wire:model="project.description">
        @error('project.description') <span class="error">{{ $message }}</span> @enderror

        <button type="submit">{{__('Create Project')}}</button>
    </form>
</div>
