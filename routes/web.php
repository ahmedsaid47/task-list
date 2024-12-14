<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models;





Route::get('/', function (){
    return redirect()->route('tasks.index');
});




Route::get('/tasks', function (){
    return view('index', [
        'tasks' => Models\Task::latest()->paginate()
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create' );






Route::get('/tasks/{task}/edit', function (Task $task) {

    return view('edit', ['task'=> $task]);

})->name('tasks.show');






Route::get('/tasks/{task}', function (Task $task) {

    return view('show', ['task'=> $task]);

})->name('tasks.show');






Route::post('/tasks', function (TaskRequest $request) {
   //dd($request->all());

    $task = Task::create($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task created successfully!');


})->name('tasks.store');






Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    //dd($request->all());

    //$data = $request->validated();

    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task Updated successfully!');


})->name('tasks.update');



Route::delete('/tasks/{task}', function (Task $task) {

    $task->delete();

    return redirect()->route('tasks.index')
        ->with('success', 'Task deleted successfully!');

})->name('tasks.destroy');
