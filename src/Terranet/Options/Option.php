<?php

namespace Terranet\Options;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public $timestamps = false;
    protected $table = 'options';
    protected $fillable = [
        'group',
        'key',
        'value'
    ];
}
