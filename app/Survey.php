<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable =['name','content'];

    public static function makeContent($requestFields){
      $fields = (array)json_decode($requestFields);
      foreach($fields as $field){
        unset($field->input);
      }
      return json_encode($fields);
    }
}
