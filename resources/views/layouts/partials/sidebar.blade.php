<div class="sidenav">
    @if($userPermissions->contains('list-roles'))
        <a href="{{ route('roles') }}" class="{{ ($menu=='roles')?'active':'' }}">Roles</a>
    @endif
    <hr/>
    @if($userPermissions->contains('list-users'))
        <a href="{{ route('users') }}" class="{{ ($menu=='users')?'active':'' }}">Users</a>
    @endif
</div>
