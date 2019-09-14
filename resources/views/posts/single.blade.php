<div class="col-md-12 mt-3">
    <div class="card">
        <div class="card-header">
            <h2>{{$post->title}}</h2>
        </div>
        <div class="card-body">
            <p class="card-text">
                {{$post->description}}
            </p>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-6">
                    @if($userPermissions->contains('edit-post') && ($post->user_id == Auth::user()->id || Auth::user()->role_id==1))
                        <a class="btn btn-outline-dark btn-sm" title="Edit Post"
                           href="{{ route('edit-post',['id'=>$post->id]) }}">
                            <i class="fa fa-pencil-alt fa-fw"></i>
                        </a>
                    @endif
                    @if($userPermissions->contains('delete-post') && ($post->user_id == Auth::user()->id || Auth::user()->role_id==1))
                        {{ Form::open(array(
                                            'route'=>array('delete-post','id'=>$post->id),
                                             'class'=>'d-inline-block'
                                            )) }}
                        @method('DELETE')
                        <button class="btn btn-outline-dark btn-sm" title="Delete Post" type="submit">
                            <i class="fa fa-trash fa-fw"></i>
                        </button>
                        {{ Form::close() }}
                    @endif
                </div>
                <div class="col-md-6">
                    <p class="float-right">
                        Created By {{ $post->user->name }} on {{$post->created_at}}
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
