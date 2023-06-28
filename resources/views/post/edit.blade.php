@extends('master')
@section("title") Edit Post : {{ env("APP_NAME") }} @endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Edit Post</h4>
                    <p class="mb-0">
                        <i class="fas fa-calendar"></i>
                        {{ date("d M Y") }}
                    </p>
                </div>
                <form action="{{ route('post.update',$post->id,$categories) }}" method="post" id="post-edit" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col  col-md-8 form-floating mb-4">
                            <div class=" form-floating mb-4">
                                <input type="text" name="title" value="{{ old('title',$post->title) }}" class="form-control @error('title') is-invalid @enderror" id="postTitle" placeholder="no need">
                                <label for="postTitle">Post Title</label>
                                @error('title')
                                <div class="invalid-feedback ps-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <img src="{{ asset('storage/cover/'.$post->cover) }}" id="coverPreview" class="cover-img w-100 h-100 rounded @error('cover') border border-danger is-invalid @enderror" alt="">
                                <input type="file" name="cover" class="d-none" id="cover" accept="image/jpeg,image/png">
                                @error('cover')
                                <div class="invalid-feedback ps-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col col-md-3 form-floating mb-4 ms-auto">
                            <div class="my-4 text-capitalize">
                                <label for="Choose Category">
                                    Choose Category
                                    <i class="fa-sharp fa-regular fa-face-smile fa-xl"></i>
                                </label>
                            </div>
                            <div>
                                @for($x=0;$x< $categories->count();$x++)
                                    <div class="form-check">
                                        <input class="form-check-input" form="post-edit" type="checkbox" name="category[]"
                                               {{$categories[$x] == isset($post->categories[$x])  ? 'checked': ''}} value="{{$categories[$x]->id}}" id="cat{{ $categories[$x]->id }}" >
                                        <label class="form-check-label" for="cat{{ $categories[$x]->id }}">
                                            {{ $categories[$x]->title }}
                                        </label>
                                    </div>
                                    @endfor
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-4">
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 150px">{{ old('description',$post->description) }}</textarea>
                        <label for="floatingTextarea2">Share Your Experience</label>
                        @error('description')
                        <div class="invalid-feedback ps-2">{{ $message }}</div>
                        @enderror
                    </div>
                </form>

                <div class="border rounded p-3 mb-4" id="gallery">
                    <div class="d-flex align-items-stretch">
                        <div class="border px-5 me-2 rounded-1 d-flex justify-content-center align-items-center" id="upload-ui" style="height: 150px">
                            <i class="fas fa-upload"></i>
                        </div>
                        <div class="d-flex overflow-scroll" style="height: 150px">
                            @forelse($post->galleries as $gallery)
                                <div class="d-flex align-items-end me-2">
                                    <img src="{{ asset('storage/gallery/'.$gallery->photo) }}" class="h-100 rounded-1 " alt="">
                                    <form action="{{ route('gallery.destroy',$gallery->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm gallery-img-delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                    <form action="{{ route('gallery.store') }}" method="post" id="gallery-upload" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="">
                            <input type="file" id="gallery-input"  name="galleries[]" class="d-none @error('galleries') is-invalid @enderror @error('galleries.*') is-invalid @enderror" multiple>
                            @error('galleries')
                            <div class="invalid-feedback ps-2">{{ $message }}</div>
                            @enderror
                            @error('galleries.*')
                            <div class="invalid-feedback ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="text-center mb-4" >
                    <button class="btn btn-primary" form="post-edit">
                        <i class="fas fa-message fa-fw"></i>
                        Update Post
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push("scripts")
    <script>
        let coverPreview = document.querySelector("#coverPreview");
        let cover = document.querySelector("#cover");
        coverPreview.addEventListener("click",_=>cover.click())
        cover.addEventListener("change",_=>{
            let file = cover.files[0];
            let reader = new FileReader();
            reader.onload = function (){
                coverPreview.src = reader.result;
            }
            reader.readAsDataURL(file);
        })
        let uploadUi = document.getElementById('upload-ui');
        let galleryInput = document.getElementById('gallery-input');
        let galleryUpload = document.getElementById('gallery-upload');

        uploadUi.addEventListener('click',_=>galleryInput.click());
        galleryInput.addEventListener('change',_=>galleryUpload.submit());
    </script>
@endpush
