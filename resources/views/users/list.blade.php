@extends('layouts.manage')
@section('manage-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Users List</h2>
            </div>
            @include('partials.flash')
            <div class="col-md-12 table-responsive">
                <table class="table table-striped table-light table-hover">
                    <thead class="bg-dark text-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email }}</td>
                            <td>
                                @if($user->role->id!=1 && $userPermissions->contains('edit-user'))
                                    {{ Form::select('role',$roles->toArray(),$user->role->id,['class'=>'form-control',
                                                                                                'id'=>'userRole'.$user->id,
                                                                                                'data-value'=>$user->role->id]) }}
                                @else
                                    {{$user->role->name }}
                                @endif
                            </td>
                            <td>
                                @if($userPermissions->contains('delete-user') && $user->role->id!=1)
                                    <button class="btn btn-light btn-sm deleteBtn" id="user{{$user->id}}"
                                            title="Delete User" type="button">
                                        <i class="fa fa-trash fa-fw"></i>
                                    </button>
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
@section('PageJS')

    <script src="{{ asset('js/custom/user.js') }}" defer></script>
    <script>
        var updateRole = '{!! route('update-user-role') !!}';
        var usersUrl = '{!! url('/users') !!}';
        $(document).ready(function () {
            User.manage(usersUrl);
        });
    </script>
@endsection
