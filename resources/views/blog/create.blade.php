@extends('layouts.app')

@section('content')
<div class="container mx-auto mb-10">
<div class="w-4/5 text-left">
    <div class="py-15">
        <h1 class="text-4xl">
            Create Post
        </h1>
    </div>
</div>
 
@if ($errors->any())
    <div class="w-4/5 ">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="w-1/5 mb-4 text-gray-50 bg-red-700 rounded-2xl py-4">
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
@endif

<div class="w-1/2 pb-15">
    <form 
        action="/blog"
        method="POST"
        enctype="multipart/form-data">
        @csrf

        <label class="block text-xl font-medium text-gray-700 mb-4">
                  Title
                </label>

        <input 
            type="text"
            name="title"
            placeholder="Enter title..."
            class="bg-transparent block border-b-2 w-full h-8 text-xl outline-none">

            <label class="block text-xl font-medium text-gray-700 mb-4 mt-6">
                  Select Category
                </label>

               

                <select name="cat_name" class="font-medium text-gray-700 ">
                <option selected value="Uncategorized">Uncategorized</option>
                @foreach($categorylist as $category)
                <option value={{ $category->cat_name }} >{{ $category->cat_name }}</option>
                @endforeach
                </select>





            <label class="block text-xl font-medium text-gray-700 mb-4 mt-6">
            Descripion
            </label>

        <textarea 
            name="description"
            placeholder="Enter description..."
            class="bg-transparent block border-b-2 w-full h-32 text-xl outline-none"></textarea>

        <div class="bg-grey-lighter pt-8">
            <label class="w-44 flex flex-col items-center px-2 py-3 bg-white-rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer">
                <span class="text-base leading-normal">
                    Select a file
                </span>
                <input 
                    type="file"
                    name="image"
                    class="hidden">
            </label>
        </div>

        <button    
            type="submit"
            class="uppercase mt-8 bg-blue-500 text-gray-100 text-lg font-bold py-4 px-4 rounded-3xl">
            Submit Post
        </button>
    </form>
</div>
</div>
@endsection
@include('layouts.footer')