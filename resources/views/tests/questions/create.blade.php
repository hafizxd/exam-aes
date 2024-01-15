<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-primary leading-tight">
                {{ __('Tambah Soal Test') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-800">
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <form method="POST" action="{{ route('test.question.store', request()->route('id')) }}">
                                        @csrf

                                        <div class="mb-4">
                                            <x-input-label :value="__('Soal')" />
                                            <textarea name="question" rows="10" class="block mt-1 w-full border-gray-300 focus:border-primaryLight rounded-md shadow-sm">{{ old('question') }}</textarea>
                                            <x-input-error :messages="$errors->get('question')" class="mt-2" />
                                        </div>

                                        <x-primary-button class="">
                                            {{ __('Tambah') }}
                                        </x-primary-button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
