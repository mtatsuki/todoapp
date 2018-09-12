<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tab;
use App\Task;
class TabsController extends Controller
{
  public function index(Request $request)
  {
      $tabs = Tab::all();
      $tabs -> toArray();

      return view('tabs.index',['tabs' => $tabs]);
  }

  public function store(Request $request)
  {
    $tab = new Tab;
    $tab->tab_name = $request->tab_name;
    $tab->timestamps = false;
    $tab->save();
    return redirect('/tab');
  }

  public function destroy($id)
  {
    $tab =  Tab::where('id',$id);
    $tab->delete();
    return back();
  }
  public function cnt($id){
    $tasks = Task::where('tab_id',$id)->where('do_flg','yet')->count();
    return response()->json([
      'yet_cnt' => $tasks,
    ]);
  }
}
