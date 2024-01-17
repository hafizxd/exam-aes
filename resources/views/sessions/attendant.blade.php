@php
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-primary leading-tight">
                {{ __('Peserta Sesi Tes') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-5">
                <div class="p-6 text-gray-800">

                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="min-w-full text-left text-sm font-light">
                                        <thead class="border-b font-medium dark:border-neutral-500">
                                            <tr>
                                                <th scope="col" class="px-6 py-4">Siswa</th>
                                                <th scope="col" class="px-6 py-4">Tanggal</th>
                                                <th scope="col" class="px-6 py-4">Waktu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="border-b transition duration-300 ease-in-out hover:bg-neutral-100">
                                                <td class="whitespace-nowrap px-6 py-4">{{ $attendant->user?->name }}</td>
                                                <td class="whitespace-nowrap px-6 py-4">{{ $attendant->date_start }}</td>
                                                <td class="whitespace-nowrap px-6 py-4">{{ $attendant->time_start }} - {{ $attendant->time_end }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    @php $count = 1; @endphp
                                    @foreach ($attendant->attendantAnswers as $value)
                                        <div class="mt-2 mb-6">
                                            <h4 class="text-lg"><b> {{ $count++ }}. {{ $value->testQuestion->question }}</b></h4>
                                            <p>Jawaban: {{ $value->answer }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
