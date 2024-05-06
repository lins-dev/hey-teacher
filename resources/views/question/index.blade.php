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

        <div class="py-3 mb-1 font-bold uppercase dark:text-gray-300"> Drafts</div>
        <div class="space-y-4 dark:text-gray-400">
            <x-table.default>
                <x-table.thead>
                    <tr>
                        <x-table.th> Questions </x-table.th>
                        <x-table.th> Actions </x-table.th>
                    </tr>
                </x-table.thead>
                <tbody>
                    @foreach ($questions->where('is_draft', '=', true) as $q)
                        <x-table.tr>
                            <x-table.td>
                                {{$q->question}}
                            </x-table.td>
                            <x-table.td>
                                <x-questions.form :action="route('questions.publish', $q->uuid)" put>
                                    <x-questions.submit-button type="submit">Publish</x-questions.submit-button>
                                </x-questions.form>
                                <x-questions.form :action="route('questions.destroy', $q->uuid)" delete>
                                    <x-questions.delete-button>Delete</x-questions.delete-button>
                                </x-questions.form>
                            </x-table.td>
                        </x-table.tr>
                    @endforeach
                    
                </tbody>
                
            </x-table.default>
            
        </div>

        <div class="py-3 mb-1 font-bold uppercase dark:text-gray-300"> My Questions</div>
        <div class="space-y-4 dark:text-gray-400">
            <x-table.default>
                <x-table.thead>
                    <tr>
                        <x-table.th> Questions </x-table.th>
                        <x-table.th> Actions </x-table.th>
                    </tr>
                </x-table.thead>
                <tbody>
                    @foreach ($questions->where('is_draft', '=', false) as $q)
                        <x-table.tr>
                            <x-table.td>
                                {{$q->question}}
                            </x-table.td>
                            <x-table.td>
                                <x-questions.form :action="route('questions.destroy', $q->uuid)" delete>
                                    <x-questions.delete-button>Delete</x-questions.delete-button>
                                </x-questions.form>
                            </x-table.td>
                        </x-table.tr>
                    @endforeach
                    
                </tbody>
                
            </x-table.default>
            
        </div>
        
    </x-questions.container>
    
</x-app-layout>
