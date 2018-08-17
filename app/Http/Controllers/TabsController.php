<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tab;

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
    $task =  Tab::where('tab_id',$id);
    $task->delete();
    return back();
  }
}
