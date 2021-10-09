@extends('layouts.app')

@section('content')
<div class="pb-20">
<div class="w-4/5 m-auto text-center font-sans">
    <div class="py-15 border-b border-gray-200">
        <h1 class="text-5xl">
            Blog Posts
        </h1>
    </div>
</div>

@if (session()->has('message'))
    <div class="w-4/5 m-auto mt-10 pl-2 pr-2">
        <p class="w-2/6 mb-4 text-gray-50 bg-green-500 rounded-2xl py-4 px-4">
            {{ session()->get('message') }}
        </p>
    </div>
@endif

<div class="pt-15 w-4/5 m-auto">

@if (Auth::check())

    <div class="flex space-x-5">

    <div>
        <a 
            href="/blog/create"
            class="bg-blue-500 uppercase bg-transparent text-gray-100 text-xs font-bold py-3 px-5 rounded-3xl">
            Create post
        </a>
</div>

<div>

        <a 
            href="/categories"
            class="bg-purple-500 uppercase bg-transparent text-gray-100 text-xs font-bold py-3 px-5 rounded-3xl">
            Categories
        </a>

</div>
    </div>
@endif

@foreach ($posts as $post)
    <div class="sm:grid grid-cols-2 gap-20  py-10  border-b border-gray-200">
        <div class="content-center">
            <img class="h-64 w-full" src="{{ asset('images/' . $post->image_path) }}" alt="">
        </div>
        <div>
            <h2 class="text-gray-600 font-bold text-4xl pb-4">
                {{ $post->title }}
            </h2>

            <span class="text-gray-500">
                By <span class="font-bold italic text-gray-800">{{ $post->user->name }}</span>, Created on {{ date('jS M Y', strtotime($post->updated_at)) }}
            
            </span>

            <br>
            <br>
                <span class="pt-5"> Categories :- {{ $post->cat_name}}</span>

            <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
                {{ strlen($post->description) > 50 ? substr($post->description,1,90).'...' : $post->description }}
            </p>

            <a href="/blog/{{ $post->slug }}" class="uppercase bg-blue-500 text-gray-100 font-bold text-sm py-3 px-3 rounded-3xl">
                Keep Reading
            </a>

            @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                <span class="float-right">
                    <a 
                        href="/blog/{{ $post->slug }}/edit"
                        class="text-gray-700 italic hover:text-gray-900 pb-1 border-b-2">
                        Edit
                    </a>
                </span>

                <span class="float-right">
                     <form 
                        action="/blog/{{ $post->slug }}"
                        method="POST">
                        @csrf
                        @method('delete')

                        <button
                            class="text-red-500 pr-3"
                            type="submit">
                            Delete
                        </button>

                    </form>
                </span>
            @endif
        </div>
    </div>    
@endforeach

<div>
@endsection
@include('layouts.footer')

