<?php

namespace App;
use App\Tab;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  public $incrementing = false; 

  protected $keyType = 'string';
  
  public function tabs()
  {
    return $this->belongsTo(Tab::class);
  }
}
