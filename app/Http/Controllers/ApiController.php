<?php

namespace App\Http\Controllers;

use App\Sprint;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function checkSprintForClosed(){
        $nowDate = Carbon::now()->startOfWeek()->format('Y-m-d');//Получаем начало текущей недели, чтобы сравнивать с этим значением
        $yearNow = Carbon::now()->year;
        $weekNow = Carbon::now()->week;

//        $nowDate = Carbon::now()->addWeek(2)->format('Y-m-d');
//        $weekNow = Carbon::now()->addWeek(2)->week;

        $sprints = DB::table('sprints')//Получаем все открытые спринты, которые созданы до начала текущей недели
            ->where([
                ['year','<', $yearNow],
                ['week', '>', $weekNow],['success', '=', '0']
            ])->orWhere([
                ['year','=', $yearNow],
                ['week', '<', $weekNow],['success', '=', '0']
            ])->orWhere([
                ['year','<', $yearNow],
                ['week', '<', $weekNow],['success', '=', '0']
            ])
            ->where('success', '=', '0')
            ->get();


        $sprintAfter = Sprint::where('year','>=', $yearNow)//Получаем все открытые спринты, которые идут сейчас или следуют после
            ->where('week', '>=', $weekNow)
            ->where('success', '=', '0')->first();

        $tasks = [];

        foreach ($sprints as $sprint){//В найденых ранее спринтах получаем все открытые таски
            $tasks += Task::all()
                ->where('sprintId', '=', $sprint->sprintId)
                ->where('success', '=', '0')
                ->all();//Шарим в массив тассков их
        }

        foreach ($tasks as $task){
            if(Task::where('taskId', $task['taskId'])->update(['sprintId'=> $sprintAfter->sprintId]))
            {
                foreach ($sprints as $spr){
                    if ($spr->created_at < $nowDate){
                        Sprint::where('sprintId',$spr->sprintId)->update([
                            'success' => 1
                        ]);
                    }

                }
            }
        }
    }
}
