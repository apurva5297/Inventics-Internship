<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadError extends Model
{
    protected $table = 'upload_errors';

    protected $fillable = ['shop_id','file_name','error_data'];
}
