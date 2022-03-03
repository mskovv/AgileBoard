<?php

namespace App\Http\Controllers;

use App\Sprint;
use App\Task;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index(){
        $sprints = Sprint::all()->where('success', '=', '0');
        $tasks = Task::all()->where('success', '=', '0');

        return response()->json([
            'sprints' => $sprints,
            'tasks' => $tasks,
        ]);
    }

    public function tasks(){
        $task = Task::create([
            'sprintId' => $this->request->sprintId,
            'estimation' => $this->request->estimation,
            'title' => $this->request->title,
            'description' => $this->request->description,
        ]);

        $taskId = 'TASK' . '-' . $task->id; //Генерируем taskId согласно ТЗ (TASK-1)

        Task::where('id', $task->id)->update([
            'taskId' => $taskId //присваиваем taskId созданной task
        ]);

        return response()->json([
            'taskId' => Task::find($task->id)->taskId, //возвращаем в ответе taskId согласно ТЗ
        ]);
    }

    public function sprints(){
        $week = $this->request->Week;
        $year = $this->request->Year;
        $sprintId = substr($year, '2') . '-' . $week;

        $sprint = Sprint::create([
            'sprintId' => $sprintId,
            'week' => $week,
            'year' => $year
        ]);

        return response()->json([
            'sprintId' => $sprint->sprintId
        ]);
    }

    public function closeTasks(){
        $taskId = $this->request->taskId;

        Task::where('taskId', $taskId)->update([
            'success' => 1,
        ]);

        return response()->json([
            'success' => 'true'
        ]);
    }

    public function closeSprint(){
        $sprintId = $this->request->sprintId;

        $sprint = Sprint::with('tasks')->where('sprintId', $sprintId)->get();

        $tasks = ($sprint[0]['tasks']);

        foreach ($tasks as $task){
            if($task->success == '0'){
                return response()->json([
                    'message' => 'Not all tasks completed'
                ]);
            }
        }

        Sprint::where('sprintId',$sprintId)->update([
            'success' => 1
        ]);

        return response()->json([
            "sprintId" => $this->request->sprintId
        ]);
    }
}
