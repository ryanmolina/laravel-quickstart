<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Task;
use Illuminate\Http\Request;


/**
 * Display All Tasks
 */
Route::get('/', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();

	return view('tasks', [
        'tasks' => $tasks
    ]);
});


/**
 * Add A New Task
 */
Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    
    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/');
});


/**
 * Delete An Existing Task
 */
Route::delete('/task/{id}', function ($id) {
    Task::findOrFail($id)->delete();
    
    return redirect('/');
});

/**
 *   A Note On Method Spoofing
 *   Note that the delete button's form method is listed as POST,
 *   even though we are responding to the request using a Route::delete route.
 *   HTML forms only allow the GET and POST HTTP verbs, so we need a way to
 *   spoof a DELETE request from the form.
 *
 *   We can spoof a DELETE request by outputting the results of the
 *   method_field('DELETE') function within our form.
 *   This function generates a hidden form input that Laravel recognizes and
 *   will use to override the actual HTTP request method.
 *   The generated field will look like the following:
 * 
 *      <input type="hidden" name="_method" value="DELETE">
 * 
 */