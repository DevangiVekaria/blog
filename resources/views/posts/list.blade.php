@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('partials.flash')
            <div class="col-md-8">
                <h1>Blogs</h1>
            </div>
            @if($userPermissions->contains('add-post'))
                <div class="col-md-4">
                    <a class="btn btn-light float-right" href="{{ route('add-post') }}">
                        <i class="fa fa-plus-circle fa-fw"></i>
                        Add Post
                    </a>
                </div>
            @endif
        </div>
        <div class="row">
            @if($userPermissions->contains('list-posts'))
                @if($posts->count()>0)
                    @foreach($posts as $post)
                        @include('posts.single')
                    @endforeach
                    <div class="col-md-12 mt-5">
                        <div class="float-right">
                            {{ $posts->links() }}
                        </div>
                    </div>
                @else
                    <div class="col-md-12 mt-5 text-center text-muted">
                        <h2>No Post Available</h2>
                    </div>
                @endif

            @else
                <div class="col-md-12 mt-5 text-center text-muted">
                    <h2>You are Not Authorized to show posts</h2>
                </div>
            @endif
        </div>
    </div>

@endsection

@section('PageJS')
    <script>
        $(document).ready(function () {
            let channel = 'user.{{ request()->user()->id }}';
            Echo.private(channel)
                .listen('.role.changed', (data) => {
                    swal(data.message)
                });
        });
    </script>
@endsection

