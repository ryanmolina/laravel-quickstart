@extends('layouts.app')
@section('content')
	<!-- Bootstrap Boilerplate -->
	<div>
		<!-- Display Validation Erros -->
		@include('common.errors')
		<!-- New Task Form -->
		<form action="/task" method="POST">
			{{ csrf_field() }}
			<label for="task">Task</label>
			<input type="text" name="name" id="task-name">
			
			<button type="submit">+ Add Task</button>
		</form>
		<ul>
			@foreach ($tasks as $task)
				<form action="/task/{{ $task->id }}" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<li>
						{{ $task->name }} 
						<button>Delete</button>
					</li>
				</form>
			@endforeach
		</ul>
    </div>
@endsection
{{--
	A Few Notes Of Explanation

	Before moving on, let's talk about this template a bit.
	First, the @extends directive informs Blade that we are
	using the layout we defined at
	resources/views/layouts/app.blade.php.

	All of the content between  @section('content') and
	@endsection will be injected into the location of the
	@yield('content') directive within the app.blade.php layout.
--}}