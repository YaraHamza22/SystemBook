<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
  use HasFactory;
  protected $fillale = [
    'name',
    'author_id',
    'authorname',
    'age',
    'description'
  ];
 /* protected $casts=[
    'age' => 'integer',
    'created_at'=> 'datetime:Y-m-d',
    'updated_at'=> 'datetime:Y-m-d',
  ];*/

  public function author(){
    return $this->belongsTo(Author::class);
  }
}
