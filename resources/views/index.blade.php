@extends('master')
@section('content')

    <div class="container">

        <div class="row justify-content-center">
            <nav class="navbar navbar-expand-sm navbar-light bg-white shadow-sm " >
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-3 mb-lg-0">
                        @foreach($categories as $category)
                            <li class="nav-item">
                                <a class="nav-link text-primary" href="{{route('post.filter',$category->id)}}">{{$category->title}}</a>
                            </li>
                        @endforeach
                    </ul>
                    <form class="d-flex ms-auto" type="get" action="{{route('post.search')}}">
                        <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                    </form>
                    @auth
                        <a href="{{ route('post.create') }}" class="btn btn-primary">Create Post</a>
                    @endauth

                </div>
            </nav>
            <div class="py-3"></div>
            <div class="col-lg-10 col-xl-8">

                <div class="posts">
                    @forelse($posts as $post)
                    <div class="post mb-4">
                        <div class="row">
                            <div class="col-lg-4">
                                <img src="{{ asset("storage/cover/".$post->cover) }}" class="cover-img rounded-3 w-100" alt="">
                            </div>
                            <div class="col-lg-8">
                                <div class="d-flex flex-column justify-content-between h-350 py-4">
                                    <div class="">
                                        <h4 class="fw-bold">{{ $post->title }}</h4>
                                         <div>
                                             @foreach($post->categories as $category)
                                                 <span class="badge bg-primary rounded-pill">
                                                    {{$category->title}}
                                                 </span>
                                             @endforeach
                                         </div>
                                        <p class="text-black">
                                            {{ $post->excerpt }}
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex">
                                            <img src="{{ asset($post->user->photo) }}" class="user-img rounded-circle" alt="">
                                            <p class="mb-0 ms-2 small">
                                                {{ $post->user->name }}
                                                <br>
                                                <i class="fas fa-calendar"></i>
                                                {{ $post->created_at->format("d M Y") }}
                                            </p>

                                        </div>
                                        <div class="d-flex">
                                            <p class="mb-0 small">
                                                <br>
                                                <i class="fa-regular fa-comment fa-lg"></i>
                                                <span>
                                                    {{count($post->comments) }}
                                                    @if(count($post->comments) > 1)comments
                                                    @else comment
                                                    @endif
                                                </span>
                                            </p>
                                        </div>
                                        <a href="{{ route('post.detail',$post->slug,$categories) }}" class="btn btn-outline-primary" >Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>



@stop
