<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Accounts extends Model
{
    use Notifiable;

    #tắt giá trị mặc định thời gian
    public $timestamps = false;

    protected $primaryKey = 'registerID';

    protected $table = 'accounts';

    protected $fillable = [

       'registerID', 'login','password','phone'
    
    ];
}