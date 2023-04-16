<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectBoardUser extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'project_board_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'task_id',
        'project_board_id'
    ];
}
