<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherAccount extends Model
{
  protected $table = 'teacher_accounts';
  protected $fillable =["username","password","full_name","vnu_mail"];

  
}
