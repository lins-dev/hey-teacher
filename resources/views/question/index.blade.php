<x-app-layout>
    
    <x-slot name="header">
        <x-header>
            {{ __('My Questions') }}
        </x-header>
    </x-slot>
    
    <x-questions.container>
        <x-questions.form post :action="route('questions.store')">
            <x-questions.text-area label="Question" name="question"></x-questions>
            <x-questions.submit-button>Save</x-questions>
            <x-questions.reset-button>Cancel</x-questions>
        </x-questions.form>

        <hr class="my-4 border-gray-700 border-dashed">

        <div class="mb-1 font-bold uppercase dark:text-gray-300"> Questions List</div>
        <div class="space-y-4 dark:text-gray-400">
            @foreach ($questions as $q)
            <x-questions.question :question="$q"></x-questions>
            @endforeach
        </div>
        
    </x-questions.container>
    
</x-app-layout>
