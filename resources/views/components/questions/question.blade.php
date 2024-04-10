@props([
    'question'
])

<div class="flex items-center justify-between p-3 rounded shadow-lg shadow-pink-500/50">
    <span>{{ $question->question }}</span>
    
    <div>
        <x-questions.form :action="route('votes.like', $question->uuid)">
            <button class="flex items-start space-x-2 text-green-500 cursor-pointer">
                <x-icons.thumbs-up class="w-5 h-5 hover:text-green-300" id="thumbs-up"/>
                <span>{{ $question->likes}}</span>
            </button>    
        </x-questions.form>
        <x-questions.form :action="route('votes.dislike', $question->uuid)">
            <button class="flex items-start space-x-2 text-red-500">
                <x-icons.thumbs-down class="w-5 h-5 cursor-pointer hover:text-red-300" id="thumbs-down"/>
                <span>{{ $question->dislikes}}</span>
            </button>    
        </x-questions.form> 
    </div>
</div>
