@if($errors->any())
    <div class="alert">
        <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="list-group-item text-danger">
                    <b>{{ $error }}</b>
                </li>
            @endforeach
        </ul>
    </div>
@endif