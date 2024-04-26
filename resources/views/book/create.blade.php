@extends('layout.app')
@section('content')
    @if ($errors->any())
        <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert" id="validateDisapper">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- Validation Message --}}
    <div class="" role="alert" id="validateCreateBook">
        <ul>
        </ul>
    </div>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-10 p-5 grid grid-cols-3">
        <div>

        </div>
        <div class="">
            <form action="{{ route('books.store') }}" method="post" id="createBookForm" enctype="multipart/form-data">
                @csrf
                {{-- book_unique_idx --}}
                <div class="mb-4 py-2">
                    <label for="remark" class="block mb-1 text-sm font-medium text-gray-900 dark:text-gray-300">Book
                        Unique
                        Idx</label>
                    <input type="text" id="book_unique_idx" value="{{ old('book_unique_idx') }}" name="book_unique_idx"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
                    block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="">
                </div>
                {{-- book_unique_idx --}}

                {{-- book_name --}}
                <div class="mb-4 py-2">
                    <label for="remark" class="block mb-1 text-sm font-medium text-gray-900 dark:text-gray-300">Book
                        Name</label>
                    <input type="text" id="book_name" value="{{ old('book_name') }}" name="book_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
                    block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="">
                </div>
                {{-- book_name --}}

                {{-- co_id --}}
                <div class="mb-4 py-2">
                    <label for="remark" class="block mb-1 text-sm font-medium text-gray-900 dark:text-gray-300">Content
                        Owner</label>
                    <input type="text" id="co_id" value="" name="co_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
                    block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="">
                </div>
                {{-- co_id --}}

                {{-- publisher_id --}}
                <div class="mb-4 py-2">
                    <label for="remark"
                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-gray-300">Publisher</label>
                    <input type="text" id="publisher_id" value="" name="publisher_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
                    block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="">
                </div>
                {{-- publisher_id --}}

                {{-- cover photo --}}
                <div class="mb-4 py-2">
                    <label for="remark" class="block mb-1 text-sm font-medium text-gray-900 dark:text-gray-300">Cover
                        Photo</label>
                    <input id="uploadFile" name="cover_photo" value="{{ old('cover_photo') }}" type="file" class=""
                        multiple accept="image/*" />
                </div>
                {{-- cover photo --}}

                <div class="flex justify-content-end">
                    <a href="{{ route('books.index') }}">
                        <button type="button"
                            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                            Cancel
                        </button>
                    </a>


                    <button type="button" id="btn-submit"
                        class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Save</button>

                </div>
            </form>
        </div>
        <div></div>
    </div>
    @vite('resources/js/book/validation.js')
    @vite('resources/js/validateDisapper.js')

@endsection
