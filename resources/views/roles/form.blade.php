@extends('layouts.manage')
@section('manage-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>{{ (isset($editId))?'Edit Role':'Add Role' }}</h2>
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
                        {{ Form::open(array('route'=>array('update-role','id'=>$role->id))) }}
                        @method('PUT')
                    @else
                        {{ Form::open(array('route'=>'store-role')) }}
                        @method('POST')
                    @endisset
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            @php($name= (isset($editId))?$role->name:'' )
                            {{ Form::label('name','Role') }}
                            {{ Form::text('name',$name,[
                                                'class'=>'form-control',
                                                'placeholder'=>'Role Name',
                                                'required'
                                                ]) }}
                        </div>
                        <div class="form-group">
                            @php($description= (isset($editId))?$role->description:'' )
                            {{ Form::label('description','Description') }}
                            {{ Form::textarea('description',$description,[
                                                'class'=>'form-control',
                                                'placeholder'=>'Tell About Role',
                                                'maxlength'=>'200',
                                                'rows'=>'3',
                                                'required'
                                                ]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('permissionLabel','Permissions') }}
                            <div class="row col-md-12">
                                @foreach($permissions as $permission)
                                    <div class="form-check col-md-3 d-inline-block">
                                        @php($checked=(isset($role))?$role->permissions->pluck('name')->contains($permission->name):false)
                                        {{ Form::checkbox('permissions[]',$permission->id,$checked,[
                                                                            'class'=>'form-check-input',
                                                                            'id'=>$permission->name
                                                                            ]) }}
                                        {{ Form::label($permission->name,$permission->display_name,[
                                                                            'class'=>'form-check-label',
                                                                            'id'=>$permission->name,
                                                                            'title'=>$permission->description
                                                                            ]) }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right mb-2">
                            <button class="btn btn-dark" type="submit">
                                <i class="fa fa-check fa-fw"></i>
                                {{ (isset($editId))?'Update':'Add'  }}
                            </button>

                            <a class="btn btn-light" href="{{ route('roles') }}">
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
