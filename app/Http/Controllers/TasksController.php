<?php

namespace App\Http\Controllers;

use App\Task;
use App\Tab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function index(Request $request)
    {
        $items = Task::orderBy('do_flg','ASC')
                ->join('tabs','tabs.id','=','tasks.tab_id')
                ->get();
        $items -> toArray();

        $tabs = Tab::all();
        $tabs -> toArray();

        return view('tasks.index',['items' => $items],['tabs' => $tabs]);
    }

    public function store(Request $request)
    {
      $task = new Task;
      $task->user_id = Auth::id();
      $task->tab_id = $request->tab_id;
      $task->task = $id = $request->task;
      $task->save();
      return back();
    }

    public function show($id)
    {
      $items = Task::where('tab_id',$id)->orderBy('do_flg','ASC')->get();
      $items -> toArray();

      $tabs = Tab::all();
      $tabs -> toArray();

      return view('tasks.show',['items' => $items],['tabs' => $tabs])->with('id',$id);
    }

    public function update(Request $request,$id){
      $tab = Tab::where('tab_name', $request->tab_name)->value('id');
      $task = Task::where('task_id',$id)->update(['task' => $request->task,'tab_id' => $tab]);
      //リダイレクト
      return back();
    }

    public function check($id)
    {
      if(Task::where('task_id','=',$id)->value('do_flg') == '0'){
        $task = Task::where('task_id',$id)->update(['do_flg' => '1']);
      }else{
        $task = Task::where('task_id',$id)->update(['do_flg' => '0']);
      }
      return back();
    }

    public function destroy($id)
    {
      $task =  Task::where('task_id',$id);
      $task->delete();
      return back();
    }
}
