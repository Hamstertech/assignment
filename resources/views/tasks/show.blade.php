@extends('welcome')

@section('content')
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-white">
            {{ $task->name }}
        </h1>
    
        <button type="button" class="py-2 px-3 text-white bg-red-500 rounded-md hover:bg-red-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 -mt-1 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
            Delete Task
        </button>
    </div>
    
    <div class="animate-fade-in-down text-white">
        <div>
            <label for="deadline" class="block underline">
                Deadline
            </label>
            <span class="mt-1 focus:ring-indigo-500 block w-full rounded-md">{{ $task->deadline }}</span>
        </div>
        <div class="mt-4">
            <label for="description" class="block underline">
                Description:
            </label>
            <span class="mt-1 focus:ring-indigo-500 block w-full rounded-md">{{ $task->description }}</span>
        </div>
    </div>
    <div class="mt-5">
        <a href="{{ route('tasks.index') }}" class="py-2 px-3 text-white bg-indigo-500 rounded-md hover:bg-indigo-600">
            Return
        </a>
    </div>
    
@endsection