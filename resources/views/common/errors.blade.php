@if (count($errors) > 0)
    <strong>Whoops! Something went wrong!</strong>
    <br>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $erro }}</li>
        @endforeach
    </ul>
@endif
{{-- 
The $errors variable is available in every Laravel view.
Instance of ViewErrorBag if no validation errors are present.
--}}