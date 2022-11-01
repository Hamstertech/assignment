@extends('welcome')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-white">Tasks</h1>
        <a href="{{ route('tasks.create') }}" class="flex flex-nowrap py-1 px-2 text-white bg-emerald-500 rounded-md">
            <div class="items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 -mt-1 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </div>
            <span class="hidden md:flex">Add new Assignment</span>
        </a>
    </div>

    @if(!empty($tasks) && $tasks->count())
        <h3 class="text-xl font-bold text-white">To do:</h3>
        <table class=" w-full text-white mt-3">
            <thead class="">
                <tr>
                    <th class="justify-center">#</th>
                    <th class="justify-center">Status</th>
                    <th class="text-left">Title</th>
                    <th class="text-left">Description</th>
                    <th class="text-left">Deadline</th>
                    <th class="float-right mr-3">Actions</th>
                </tr>
            </thead>
            @foreach ($tasks as $task)
                <tr class="h-16 border animate-fade-in-down">
                    <td class="">
                        <div class="flex justify-center">
                            <p class="text-base leading-none mr-2">{{ $task->id }}</p>
                        </div>
                    </td>
                    <td class="">
                        <div class="flex justify-center">
                            @if ($task->deadline < Carbon\Carbon::now()->format('Y-m-d'))
                                <label class="py-1 px-2 text-white bg-rose-600 rounded-md">
                                    <p class="text-base leading-none mr-2">Overdue</p>
                                </label>
                            @else
                                <label class=" py-1 px-2 text-white {{ App\Enums\EnumStatus::tryFrom($task->status)->toColor() }} rounded-md">
                                    <p class="text-base leading-none mr-2">{{ App\Enums\EnumStatus::tryFrom($task->status)->toString() }}</p>
                                </label>
                            @endif
                        </div>
                    </td>
                    <td class="">
                        <div class="">
                            <p class="text-base leading-none mr-2">{{ $task->name }}</p>
                        </div>
                    </td>
                    <td class="">
                        <div class="">
                            <p class="text-base leading-none mr-2">{{ $task->description }}</p>
                        </div>
                    </td>
                    <td class="">
                        <div class="">
                            <p class="text-base leading-none mr-2">{{ $task->deadline }}</p>
                        </div>
                    </td>
                    <td class="">
                        <div class="flex float-right flex-nowrap">

                            <a href="{{ route('tasks.show', $task->id) }}" title="Edit" class="text-amber-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                            </a>
                            <a href="{{ route('tasks.edit', $task->id) }}" title="Edit" class="text-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('tasks.completed', $task->id)}}">
                                @csrf
                                <button title="Mark Completed" class="text-emerald-600" onclick="markCompleted()">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                            </form>
                            <form method="POST" action="{{ route('tasks.destroy', $task->id)}}">
                                @method('DELETE')
                                @csrf
                                <button title="Delete" type="submit" class="text-rose-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <span class="text-white">Please add tasks</span>
    @endif
    
    @if(!empty($completed) && $completed->count())
        <h3 class="text-xl font-bold text-white">Completed:</h3>
        <table class=" w-full text-white mt-3">
            <thead class="">
                <tr>
                    <th class="justify-center">#</th>
                    <th class="justify-center">Status</th>
                    <th class="text-left">Title</th>
                    <th class="text-left">Description</th>
                    <th class="text-left">Deadline</th>
                    <th class="float-right mr-3">Actions</th>
                </tr>
            </thead>
            @foreach ($completed as $task)
                <tr class="h-16 border animate-fade-in-down">
                    <td class="">
                        <div class="flex justify-center">
                            <p class="text-base leading-none mr-2">{{ $task->id }}</p>
                        </div>
                    </td>
                    <td class="">
                        <div class="flex justify-center">
                            <label class=" py-1 px-2 text-white {{ App\Enums\EnumStatus::tryFrom($task->status)->toColor() }} rounded-md">
                                <p class="text-base leading-none mr-2">{{ App\Enums\EnumStatus::tryFrom($task->status)->toString() }}</p>
                            </label>
                        </div>
                    </td>
                    <td class="">
                        <div class="">
                            <p class="text-base leading-none mr-2">{{ $task->name }}</p>
                        </div>
                    </td>
                    <td class="">
                        <div class="">
                            <p class="text-base leading-none mr-2">{{ $task->description }}</p>
                        </div>
                    </td>
                    <td class="">
                        <div class="">
                            <p class="text-base leading-none mr-2">{{ $task->deadline }}</p>
                        </div>
                    </td>
                    <td class="">
                        <div class="flex float-right flex-nowrap">

                            <a href="{{ route('tasks.show', $task->id) }}" title="Edit" class="text-amber-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('tasks.destroy', $task->id)}}">
                                @method('DELETE')
                                @csrf
                                <button title="Delete" type="submit" class="text-rose-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
    
@endsection