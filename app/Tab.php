<?php

namespace App;
use App\Task;
use Illuminate\Database\Eloquent\Model;

class Tab extends Model
{
  public function tasks()
  {
    return $this->hasMany(Task::class);
  }
}
