@extends('layout.app')
@section('content')
    @if (Session::has('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert" id="validateDisapper">
            <ul>
                <li>{{ Session::get('success') }}</li>
            </ul>
        </div>
    @endif

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-10 p-5">
        <div class="flex float-right">
            <a href="{{ route('books.create') }}">
                <button type="button"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                    Create
                </button>
            </a>
        </div>


        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Idx
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Content Owner
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Publisher
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created Date
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['data'] as $book)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $book['book_unique_idx'] }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $book['book_name'] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $book['co_id'] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $book['publisher_id'] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $book['created_at'] }}
                        </td>
                        <form action=" {{ route('books.destroy', $book['idx']) }}" method="post" class="formActionDelete">
                            @csrf
                            @method('DELETE')
                            <td class="px-6 py-4 items-center">
                                <input type="hidden" name="idx" value="{{ $book['idx'] }}">
                                <a href="{{ route('books.edit', $book['idx']) }}">
                                    <button type="button"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        Edit
                                    </button>
                                    <button type="submit"
                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                        Delete
                                    </button>
                                </a>
                            </td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @vite('resources/js/validateDisapper.js')
    @vite('resources/js/deleteConfirm.js')
@endsection
