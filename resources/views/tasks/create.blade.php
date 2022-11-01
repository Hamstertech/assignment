@extends('welcome')

@section('content')
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-white">
            {{ !empty($task->name) ? 'Update Task' : 'Create Task' }}
        </h1>
    
        @if (!empty($task))
            <button type="button" class="py-2 px-3 text-white bg-red-500 rounded-md hover:bg-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 -mt-1 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Delete Task
            </button>
        @endif
    </div>
    
    @if (!empty($task))
        <form method="POST" action="{{ route('tasks.update', $task->id) }}" class="animate-fade-in-down">
            @method('PATCH')
    @else
        <form method="POST" action="{{ route('tasks.store') }}" class="animate-fade-in-down">
    @endif
        @csrf
        <div class="">
            <div>
                <label for="name" class="block text-white">
                    Title
                </label>
                <input name="name" required id="name" type="text" placeholder="Title" value="{{ old('name') ?? $task->name ?? ''}}" class="mt-1 focus:ring-indigo-500 block w-full rounded-md">
            </div>
            <div>
                <label for="description" class="block text-white">
                    Description
                </label>
                <div class="mt-1">
                    <textarea name="description" id="description" rows="3" placeholder="Describe your assignment" class="mt-1 block w-full border rounded-md">{{ old('description') ?? $task->description ?? ''}}</textarea>
                </div>
            </div>
            <div>
                <label for="deadline" class="block text-white">
                    Deadline
                </label>
                <div class="mt-1">
                    <input name="deadline" id="deadline" type="date" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ old('deadline') ?? $task->deadline ?? ''}}" class="mt-1 block w-full rounded-md">
                </div>
            </div>
        </div>
    
        <button type="submit" class="py-2 px-4 border rounded-md text-white">
            Save
        </button>
    </form>
@endsection