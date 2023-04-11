<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;

    public const TASK_STATUS_TO_DO_ID = 1;
    public const TASK_STATUS_TO_DO = "TO DO";
    public const TASK_STATUS_TO_DO_ITEMS = "todoItems";

    public const TASK_STATUS_IN_PROGRESS_ID = 2;
    public const TASK_STATUS_IN_PROGRESS = "IN PROGRESS";
    public const TASK_STATUS_IN_PROGRESS_ITEMS = "inProgressItems";

    public const TASK_STATUS_DONE_ID = 3;
    public const TASK_STATUS_DONE = "DONE";
    public const TASK_STATUS_DONE_ITEMS = "doneItems";

    /**
     * @var string
     */
    protected $table = 'task_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];
}
