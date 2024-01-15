<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-primary leading-tight">
                {{ __('Test') }}
            </h2>
            <a href="{{ route('test.create') }}" type="button" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:bg-blue-600 active:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Tambah</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                                                <th scope="col" class="px-6 py-4">Mata Pelajaran</th>
                                                <th scope="col" class="px-6 py-4">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tests as $key => $value)
                                                <tr class="border-b transition duration-300 ease-in-out hover:bg-neutral-100">
                                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $count++ }}</td>
                                                    <td class="whitespace-nowrap px-6 py-4">{{ $value->subject }}</td>

                                                    <td class="whitespace-nowrap px-6 py-4">
                                                        <div class="flex gap-2">
                                                            <a href="{{ route('test.edit', ['id' => $value->id]) }}">
                                                                <button class="border-primary border rounded-md px-3 py-2 hover:bg-primary-light text-primary hover:text-white transition duration-200 ease-in-out">Edit</button>
                                                            </a>

                                                            <form action="{{ route('test.delete', ['id' => $value->id]) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input class="border-red-700 border rounded-md px-3 py-2 hover:bg-red-700 text-red-700 hover:text-white transition duration-200 ease-in-out" type="submit" value="Hapus">
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="pt-3">
                                        {{ $tests->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
