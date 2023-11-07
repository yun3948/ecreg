<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class MemberChangeLevel extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'member_change_level';
    
    protected $guarded = [];

    public function member (){
        return $this->hasOne(Member::class,'id','user_id');
    }
    
}
