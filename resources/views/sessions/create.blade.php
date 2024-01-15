<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-primary leading-tight">
                {{ __('Tambah Sesi Tes') }}
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
                                    <form method="POST" action="{{ route('session.store') }}">
                                        @csrf

                                        <div class="mb-4">
                                            <x-input-label :value="__('Test')" />
                                            <select name="testId">
                                                @foreach ($tests as $value)
                                                    <option value="{{ $value->id }}">{{ $value->subject }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('testId')" class="mt-2" />
                                        </div>

                                        <div class="mb-4">
                                            <x-input-label :value="__('Kelas')" />
                                            <x-text-input class="block mt-1 w-full" type="text" name="class" :value="old('class')" required autofocus />
                                            <x-input-error :messages="$errors->get('class')" class="mt-2" />
                                        </div>

                                        <div class="mb-4">
                                            <x-input-label :value="__('Guru')" />
                                            <x-text-input class="block mt-1 w-full" type="text" name="teacher" :value="old('teacher')" required autofocus />
                                            <x-input-error :messages="$errors->get('teacher')" class="mt-2" />
                                        </div>

                                        <div class="mb-4">
                                            <x-input-label :value="__('Tanggal (Y-M-D)')" />
                                            <x-text-input class="block mt-1 w-full" type="text" name="dateStart" :value="old('dateStart')" required autofocus />
                                            <x-input-error :messages="$errors->get('dateStart')" class="mt-2" />
                                        </div>

                                        <div class="mb-4">
                                            <x-input-label :value="__('Waktu Mulai (H:i)')" />
                                            <x-text-input class="block mt-1 w-full" type="text" name="timeStart" :value="old('timeStart')" required autofocus />
                                            <x-input-error :messages="$errors->get('timeStart')" class="mt-2" />
                                        </div>

                                        <div class="mb-4">
                                            <x-input-label :value="__('Waktu Berakhir (H:i)')" />
                                            <x-text-input class="block mt-1 w-full" type="text" name="timeEnd" :value="old('timeEnd')" required autofocus />
                                            <x-input-error :messages="$errors->get('timeEnd')" class="mt-2" />
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
