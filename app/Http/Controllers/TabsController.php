<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tab;
use App\Task;

class TabsController extends Controller
{

  public function __construct() {
    $this->middleware('auth');
    }
    
  public function index(Request $request)
  {
      $id = Auth::id();
      $tabs = Tab::where('user_id',$id)->get();
      $tabs -> toArray();
      return view('tabs.index',['tabs' => $tabs]);
  }

  public function store(Request $request)
  {
    $tab = new Tab;
    $tab->tab_name = $request->tab_name;
    $tab->user_id = Auth::id();
    $tab->timestamps = false;
    $tab->save();
    return redirect('/tab');
  }

  public function destroy($id)
  {
    if(Tab::where('id',$id)->value('user_id') !== Auth::id()){
      return abort(404);
    }
    $tab = Tab::where('id',$id);
    $tab->delete();
    return back();
  }

  public function update(Request $request,$id){
    if(Tab::where('id',$id)->value('user_id') !== Auth::id()){
      return abort(404);
    }

    $tab = Tab::find($id);
    $tab->tab_name = $request->tab_name;
    $tab->user_id = Auth::id();
    $tab->save();
    //リダイレクト
    return redirect()->to('/tab');
  }
}
