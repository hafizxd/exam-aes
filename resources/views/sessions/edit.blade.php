@php
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-primary leading-tight">
                {{ __('Edit Sesi Tes') }}
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
                                    <form method="POST" action="{{ route('session.store') }}" class="mb-5">
                                        @csrf

                                        <div class="mb-4">
                                            <x-input-label :value="__('Test')" />
                                            <select name="testId">
                                                @foreach ($tests as $value)
                                                    <option @if ($session->test_id == $value->id) selected @endif value="{{ $value->id }}">{{ $value->subject }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('testId')" class="mt-2" />
                                        </div>

                                        <div class="mb-4">
                                            <x-input-label :value="__('Kelas')" />
                                            <x-text-input class="block mt-1 w-full" type="text" name="class" :value="$session->class" required autofocus />
                                            <x-input-error :messages="$errors->get('class')" class="mt-2" />
                                        </div>

                                        <div class="mb-4">
                                            <x-input-label :value="__('Guru')" />
                                            <x-text-input class="block mt-1 w-full" type="text" name="teacher" :value="$session->teacher" required autofocus />
                                            <x-input-error :messages="$errors->get('teacher')" class="mt-2" />
                                        </div>

                                        <div class="mb-4">
                                            <x-input-label :value="__('Tanggal (Y-M-D)')" />
                                            <x-text-input class="block mt-1 w-full" type="text" name="dateStart" :value="$session->date_start" required autofocus />
                                            <x-input-error :messages="$errors->get('dateStart')" class="mt-2" />
                                        </div>

                                        <div class="mb-4">
                                            <x-input-label :value="__('Waktu Mulai (H:i)')" />
                                            <x-text-input class="block mt-1 w-full" type="text" name="timeStart" :value="$session->time_start" required autofocus />
                                            <x-input-error :messages="$errors->get('timeStart')" class="mt-2" />
                                        </div>

                                        <div class="mb-4">
                                            <x-input-label :value="__('Waktu Berakhir (H:i)')" />
                                            <x-text-input class="block mt-1 w-full" type="text" name="timeEnd" :value="$session->time_end" required autofocus />
                                            <x-input-error :messages="$errors->get('timeEnd')" class="mt-2" />
                                        </div>

                                        <x-primary-button class="">
                                            {{ __('Edit') }}
                                        </x-primary-button>

                                    </form>

                                    <div class="visible-print: text-center; margin-top: 100px;">
                                        {!! QrCode::size(500)->generate($session->code_encrypted) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="my-5"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-5">
                <div class="p-6 text-gray-800">

                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    @php $count = 1; @endphp

                                    <table class="min-w-full text-left text-sm font-light">
                                        <thead class="border-b font-medium dark:border-neutral-500">
                                            <tr>
                                                <th scope="col" class="px-6 py-4">#</th>
                                                <th scope="col" class="px-6 py-4">Siswa</th>
                                                <th scope="col" class="px-6 py-4">Tanggal</th>
                                                <th scope="col" class="px-6 py-4">Waktu</th>
                                                <th scope="col" class="px-6 py-4">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($session->attendants as $key => $value)
                                                <tr class="border-b transition duration-300 ease-in-out hover:bg-neutral-100">
                                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $count++ }}</td>
                                                    <td class="whitespace-nowrap px-6 py-4">{{ $value->user?->name }}</td>
                                                    <td class="whitespace-nowrap px-6 py-4">{{ $value->date_start }}</td>
                                                    <td class="whitespace-nowrap px-6 py-4">{{ $value->time_start }} - {{ $value->time_end }}</td>

                                                    <td class="whitespace-nowrap px-6 py-4">
                                                        <div class="flex gap-2">
                                                            <a href="{{ route('session.attendant.show', ['id' => $session->id, 'attendantId' => $value->id]) }}">
                                                                <button class="border-primary border rounded-md px-3 py-2 hover:bg-primary-light text-primary hover:text-white transition duration-200 ease-in-out">Detail</button>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
