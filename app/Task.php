<?php

namespace App;
use App\Tab;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  public function tabs()
  {
    return $this->belongsTo(Tab::class);
  }
}
