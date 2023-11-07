<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class MemberChangeLevelLog extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'member_change_level_log';
    
}
