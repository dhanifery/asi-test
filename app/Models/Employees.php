<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nomor', 'nama', 'jabatan', 'talahir', 'photo_upload_path',
        'created_on', 'updated_on', 'created_by', 'updated_by', 'deleted_on'
    ];
}
