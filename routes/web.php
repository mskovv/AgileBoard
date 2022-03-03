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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/api', function () {
    $sprints = \App\Sprint::all()->where('success', '=', '0');
    $tasks = \App\Task::all();

    return response()->json([
        'sprints' => $sprints,
        'tasks' => $tasks,
    ]);
});

//Route::get('/addTask', function () {
//    return view('welcome');
//});
Route::post('/api/tasks', function (\Illuminate\Http\Request $request) {
    return request()->all();
});

//Route::get('/addSprint', function () {
//    return view('welcome');
//});
Route::post('/api/sprints', function (\Illuminate\Http\Request $request) {
    $week = $request->Week;
    $year = $request->Year;
    $sprintId = substr($year, '2') . '-' . $week;
    $sprint = \App\Sprint::create([
        'sprintId' => $sprintId,
        'week' => $week,
        'year' => $year
    ]);
    return response()->json([
       'sprintId' => $sprint->sprintId
    ]);
});


Route::post('/endTask', function () {
    return view('welcome');
});



