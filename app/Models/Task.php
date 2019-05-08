<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title', 'des', 'file', 'deadline'
    ];

    protected $appends = [
        'status','attachment'
    ];

    public function getStatusAttribute()
    {
        if ($this->pending) {
            return 'Panding';
        }else{
            if ($this->completed) {
                return 'Completed';
            }
            if ($this->fail_deadline) {
                return 'Fail Deadline';
            }
        }
    }

    public function getAttachmentAttribute()
    {
        if($this->file){
            return asset('uploads/'.$this->file);
        }
    }
}
