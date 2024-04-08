<x-app-layout>
    
    <x-slot name="header">
        <x-header>
            {{ __('Dashboard') }}
        </x-header>
    </x-slot>
    
    <x-questions.container>
        <x-questions.form post :action="route('question.store')">
            <x-questions.text-area label="Question" name="question"></x-questions>
            <x-questions.submit-button>Save</x-questions>
            <x-questions.reset-button>Cancel</x-questions>
        </x-questions.form>

        <hr class="my-4 border-gray-700 border-dashed">

        <div> Questions List</div>
    </x-questions.container>
    
</x-app-layout>
