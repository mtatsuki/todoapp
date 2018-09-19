<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class ApiController extends Controller
{
  public function cnt($id){
    $tasks = Task::where('tab_id',$id)->where('do_flg','0')->count();
    return response()->json([
      'yet_cnt' => $tasks,
    ]);
  }
}
