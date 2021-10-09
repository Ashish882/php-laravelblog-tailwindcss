@extends('layouts.app')

@section('content')
<div class="pb-20">
<div class="w-4/5 m-auto text-left">
    <div class="py-15">
        <h1 class="text-4xl">
           Categories
        </h1>
    </div>
</div>

<div class="container max-w-3xl mx-auto font-sans">
@if ($errors->any())
    <div class="w-4/5 ">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="w-full mb-4 text-gray-50 bg-red-700 rounded-2xl py-4 px-4">
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
@endif

@if (session()->has('message'))
    <div class="w-full mt-10 pl-2">
        <p class="w-full mb-4 text-gray-50 bg-green-500 rounded-2xl py-4 px-4">
            {{ session()->get('message') }}
        </p>
    </div>
@endif

<form   class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4"
        action="/add_cat"
        method="POST"
        >
        @csrf
        @method('POST')

      <h3 class="title text-xl mb-8 mx-auto text-center font-bold text-blue-800"> Create Categories</h3>
      <div class="mb-4">
        <label for="something" class="block text-gray-500 font-bold text-sm mb-3">Categories title </label>
        <input name="cat_name" type="text" placeholder="Enter Your Stuff" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-300" />
        <div class="flex items-center justify-between">
          <button type="submit" class="shadow bg-blue-900 hover:bg-blue-800 focus:shadow-outline focus:outline-none text-white text-sm  py-3 px-3 rounded mt-5" type="button">
            Add Categories
          </button>
        </div>
      </div>
    </form>

    <div class="w-4/5 ">
    <div class="py-10">
        <h1 class="text-4xl">
           Categories
        </h1>
    </div>
</div>

    <div class="flex flex-col mb-20 ">
        <div class="w-full">
            <div class="border-b border-gray-200 shadow">
                <table class="divide-y divide-gray-300 w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-2 text-xs text-gray-500">
                                ID
                            </th>
                            <th class="px-6 py-2 text-xs text-gray-500">
                                Categories Name
                            </th>

                            <th class="px-6 py-2 text-xs text-gray-500">
                                Created_at
                            </th>
        
                            <th class="px-6 py-2 text-xs text-gray-500">
                                Delete
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-300">
                        
                        @foreach($categories as $key => $category)
                        <tr class="whitespace-nowrap">
                            <td class="px-6 py-4 text-sm text-gray-500 text-center">
                                {{ $key + 1 }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="text-sm text-gray-900">
                                  {{ $category->cat_name }}
                                </div>
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-500 text-center">
                            {{ $category->created_at }}
                            </td>
                 
                            <td class="px-6 py-4 text-gray-500 text-center">
                            <form 
                        action="/cat_delete/{{ $category->id }}"
                        method="POST">
                        @csrf
                        @method('post')

                        <button
                            class="text-red-500 pr-3"
                            type="submit">
                            Delete
                        </button>

                    </form>
                              
                            </td>


                            @endforeach


                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


  </div>



</div>

@endsection
@include('layouts.footer')