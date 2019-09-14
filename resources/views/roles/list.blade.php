@extends('layouts.manage')
@section('manage-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>Roles List</h2>
            </div>
            @if($userPermissions->contains('add-role'))
                <div class="col-md-4">
                    <a class="btn btn-light float-right" href="{{ route('add-role') }}">
                        <i class="fa fa-plus-circle fa-fw"></i>
                        Add Role
                    </a>
                </div>
            @endif
            @include('partials.flash')
            <div class="col-md-12 table-responsive">
                <table class="table table-striped table-light table-hover">
                    <thead class="bg-dark text-light">
                    <tr>
                        <th>Role</th>
                        <th>Description</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{$role->name}}</td>
                            <td>{{$role->description }}</td>
                            <td class="text-right">
                                @if($role->id!=1 && $userPermissions->contains('edit-role'))
                                    <a class="btn btn-light btn-sm" title="Edit Role"
                                       href="{{ route('edit-role',['id'=>$role->id]) }}">
                                        <i class="fa fa-pencil-alt fa-fw"></i>
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if($userPermissions->contains('delete-role') && !in_array($role->id,[1,2]))
                                    {{ Form::open(array(
                                                'route'=>array('delete-role','id'=>$role->id),
                                                 'class'=>'d-inline-block'
                                                )) }}
                                    @method('DELETE')
                                    <button class="btn btn-light btn-sm" title="Delete Role" type="submit">
                                        <i class="fa fa-trash fa-fw"></i>
                                    </button>
                                    {{ Form::close() }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
