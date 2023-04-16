<?php

namespace App\Models;

use App\Models\TaskStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    public const TASK_UPDATED = true;
    public const TASK_CREATED = false;

    /**
     * @var string
     */
    protected $table = 'tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'priority',
        'importance',
        'description',
        'status_id',
        'user_id',
        'project_board_id'
    ];

    /**
     * Give the status name
     *
     */
    public function statusName($status_id)
    {
        $name = "";

        switch ($status_id) {
            case TaskStatus::TASK_STATUS_TO_DO_ID:
                $name = TaskStatus::TASK_STATUS_TO_DO;
                break;
            case TaskStatus::TASK_STATUS_IN_PROGRESS_ID:
                $name = TaskStatus::TASK_STATUS_IN_PROGRESS;
                break;
            case TaskStatus::TASK_STATUS_DONE_ID:
                $name = TaskStatus::TASK_STATUS_DONE;
                break;
        }

        return $name;
    }

    public function statusNameItem($index)
    {
        $nameItem = "";
        switch ($index) {
            case TaskStatus::TASK_STATUS_TO_DO_ID:
                $nameItem = TaskStatus::TASK_STATUS_TO_DO_ITEMS;
                break;
            case TaskStatus::TASK_STATUS_IN_PROGRESS_ID:
                $nameItem = TaskStatus::TASK_STATUS_IN_PROGRESS_ITEMS;
                break;
            case TaskStatus::TASK_STATUS_DONE_ID:
                $nameItem = TaskStatus::TASK_STATUS_DONE_ITEMS;
                break;
        }

        return $nameItem;
    }
}
