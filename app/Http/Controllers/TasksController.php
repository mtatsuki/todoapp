<?php

namespace App\Http\Controllers;

use App\Task;
use App\Tab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{

    public function __construct() {
     $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $id = Auth::id();
        $items = Task::where('tasks.user_id',$id)
                ->orderBy('do_flg','ASC')
                ->join('tabs','tabs.id','=','tasks.tab_id')
                ->get();
        $items -> toArray();

        $tabs = Tab::where('user_id',$id)->get();
        $tabs -> toArray();

        return view('tasks.index',['items' => $items],['tabs' => $tabs]);
    }

    public function store(Request $request)
    {
      $task = new Task;
      $task->user_id = Auth::id();
      $task->tab_id = $request->tab_id;
      $task->task = $request->task;
      $task->save();
      return back();
    }

    public function show($id)
    {
      //page not found
      if(Tab::where('id',$id)->value('user_id') !== Auth::id()){
        return abort(404);
      }

      $items = Task::where('tab_id',$id)->where('user_id',Auth::id())->orderBy('do_flg','ASC')->get();
      $items -> toArray();

      $tabs = Tab::where('user_id',Auth::id())->get();
      $tabs -> toArray();

      return view('tasks.show',['items' => $items],['tabs' => $tabs])->with('id',$id);
    }

    public function update(Request $request,$id){
      if(Task::where('task_id',$id)->value('user_id') !== Auth::id()){
        return abort(404);
      }
      
      $tab = Tab::where('tab_name', $request->tab_name)->where('user_id', Auth::id())->value('id');
      $task = Task::where('task_id',$id)->where('user_id', Auth::id())->update(['task' => $request->task,'tab_id' => $tab]);
      //リダイレクト
      return back();
    }

    public function check($id)
    {
      if(Task::where('task_id','=',$id)->value('do_flg') == '0'){
        $task = Task::where('task_id',$id)->where('user_id', Auth::id())->update(['do_flg' => '1']);
      }else{
        $task = Task::where('task_id',$id)->where('user_id', Auth::id())->update(['do_flg' => '0']);
      }
      return back();
    }

    public function destroy($id)
    {
      if(Task::where('task_id',$id)->value('user_id') !== Auth::id()){
        return abort(404);
      }
      
      $task = Task::where('task_id',$id)->where('user_id', Auth::id());
      $task->delete();
      return back();
    }
}
