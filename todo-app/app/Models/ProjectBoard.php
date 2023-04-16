<?php

namespace App\Models;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectBoard extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'project_board';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'active',
        'owner_id',
        'expired_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'expired_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * Get the tasks for the project board.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'project_board_id', 'id');
    }

    public function exipred()
    {
        return $this->expired_at < Carbon::now();
    }
}
