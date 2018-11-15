<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class StudentAccount extends Authenticatable
{
    protected $guard = "students";
    protected $table = 'student_accounts';
    protected $fillable =["username","password","full_name","vnu_mail","school_year"];
}
