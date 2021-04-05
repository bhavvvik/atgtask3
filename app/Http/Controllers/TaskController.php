<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    private $sucess_status = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
            $user  =Auth::user();
            $validator =Validator::make($request->all(),
                [
                    "task" => "required",
                    
                ]
            );
            if($validator->fails()) {
                return response()->json(["validation_errors" => $validator->errors()]);
            }
    
            $task_array  =array(
                "task" => $request->task,
                "status"=> $request->status,
                "user_id"  => $user->id
            );
    
            $task_id=$request->id;
    
            if($task_id != "") {
                $task_status = Task::where("id", $task_id)->update($task_array);
    
                if($task_status == 1) {
                    return response()->json(["status" => $this->sucess_status, "success" => true, "message" => "Todo updated successfully", "data" => $task_array]);
                }
    
                else {
                    return response()->json(["status" => $this->sucess_status, "success" => true, "message" => "Todo not updated"]);
                }
    
            }
    
            $task  =Task::create($task_array);
    
            if(!is_null($task)) {
                return response()->json(["status" => $this->sucess_status, "success" => true, "data" => $task]);
            }
    
            else {
                return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! task not created."]);
            }
    }


   
    public function tasks() {
        $tasks=array();
        $user=Auth::user();
        $tasks=Task::where("user_id", $user->id)->get();
        if(count($tasks) > 0) {
            return response()->json(["status" => $this->sucess_status, "success" => true, "count" => count($tasks), "data" => $tasks]);
        }

        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! no todo found"]);
        }
    }

    public function task($task_id) {
        if($task_id == 'undefined' || $task_id == "") {
            return response()->json(["status" => "failed", "success" => false, "message" => "Alert! enter the task id"]);
        }

        $task =  Task::find($task_id);

        if(!is_null($task)) {
            return response()->json(["status" => $this->sucess_status, "success" => true, "data" => $task]);
        }

        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! no todo found"]);
        }
    }



    public function change($task_id,Request $request) {
        $task =  Task::find($task_id);
        // dd($request->all());

        
            $task->status = is_null($request->status) ? $task->status : $request->status;
        
        $task->save();
        return response()->json(["status" => $this->sucess_status, "success" => true, "data" => $task]);
            
      
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
