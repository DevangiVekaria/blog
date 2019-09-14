@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h2>
                    {{ (isset($editId))?'Edit Post':'Add Post'  }}
                </h2>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @isset($editId)
                        {{ Form::open(array('route'=>array('update-post','id'=>$post->id))) }}
                        @method('PUT')
                    @else
                        {{ Form::open(array('route'=>'store-post')) }}
                        @method('POST')
                    @endisset
                        @csrf
                    <div class="card-body">
                        <div class="form-group">
                            @php($title= (isset($editId))?$post->title:'' )
                            {{ Form::label('title','Title') }}
                            {{ Form::text('title',$title,[
                                                'class'=>'form-control',
                                                'placeholder'=>'Post About?',
                                                'required'
                                                ]) }}
                        </div>
                        <div class="form-group">
                            @php($description= (isset($editId))?$post->description:'' )
                            {{ Form::label('description','Description') }}
                            {{ Form::textarea('description',$description,[
                                                'class'=>'form-control',
                                                'placeholder'=>'Give Your Thoughts...',
                                                'required'
                                                ]) }}
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right mb-2">
                            <button class="btn btn-dark" type="submit">
                                <i class="fa fa-check fa-fw"></i>
                                {{ (isset($editId))?'Update':'Add'  }}
                            </button>

                            <a class="btn btn-light" href="{{ route('posts') }}">
                                <i class="fa fa-times fa-fw"></i>
                                Cancel
                            </a>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
