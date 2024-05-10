<x-app-layout>
    
    <x-slot name="header">
        <x-header>
            {{ __('Edit Question') }}
        </x-header>
    </x-slot>
    
    <x-questions.container>
        <x-questions.form post :action="route('questions.update', $question->uuid)" put>
            <x-questions.text-area label="Question" name="question" :value="$question->question"></x-questions>
            <x-questions.submit-button>Save</x-questions>
            <x-questions.reset-button>Cancel</x-questions>
        </x-questions.form>
    </x-questions.container>
    
</x-app-layout>
