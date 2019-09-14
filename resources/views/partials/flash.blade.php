@if(session()->has('message'))
    <div class="alert alert-{{ session()->get('message')['type'] }} alert-block col-md-12">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <p>{{ session()->get('message')['message'] }}</p>
    </div>
@endif
