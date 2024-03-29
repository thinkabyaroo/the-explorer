@extends('master')
@section("title") Create category : {{ env("APP_NAME") }} @endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Create Category</h4>
                    <p class="mb-0">
                        <i class="fas fa-calendar"></i>
                        {{ date("d M Y") }}
                    </p>
                </div>

                <form action="{{ route('category.store') }}" method="post" >
                    @csrf
                    <div class="form-floating mb-4">
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" id="postTitle" placeholder="no need">
                        <label for="categoryTitle">Category Title</label>
                        @error('title')
                        <div class="invalid-feedback ps-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-center mb-4">
                        <button class="btn btn-lg btn-primary">
                            <i class="fas fa-message fa-fw"></i>
                            Create Category
                        </button>
                    </div>

                </form>
            </div>
        </div>

            <div class="col-lg-10 col-xl-8">
                <table class="table table-hover table-bordered mb-0 align-middle">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Owner</th>
                        <th>Control</th>
                        <th>Created At</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->title }}</td>
                            <td>{{ $category->user->name }}</td>
                            <td>
                                <a href="{{ route('category.edit',$category->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            </td>
                            <td>
                                <p class="small mb-0">
                                    <i class="fas fa-clock"></i>
                                    {{ $category->created_at->format("h : i a") }}
                                </p>
                                <p class="small mb-0">
                                    <i class="fas fa-calendar"></i>
                                    {{ $category->created_at->format("d m Y") }}
                                </p>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">There is no Category Yet</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>


            </div>

        </div>

    </div>
@endsection



