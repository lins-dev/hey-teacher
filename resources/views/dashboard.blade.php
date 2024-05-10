<x-app-layout>
    
    <x-slot name="header">
        <x-header>
            {{ __('Vote for a question') }}
        </x-header>
    </x-slot>
    
    <x-questions.container>

        <hr class="my-4 border-gray-700 border-dashed">

        <div class="mb-1 font-bold uppercase dark:text-gray-300"> Questions List</div>
        <div class="space-y-4 dark:text-gray-400">
            @foreach ($questions as $q)
            <x-questions.question :question="$q"></x-questions>
            @endforeach

            {{$questions->links()}}
        </div>
        
    </x-questions.container>
    
</x-app-layout>
