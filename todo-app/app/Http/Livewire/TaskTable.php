<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class TaskTable extends DataTableComponent
{
    protected $model = Task::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        // ->setTableRowUrl(function ($row) {
        //     return route('edit-task', $row->id);
        // })
        // ->setTableRowUrlTarget(function ($row) {
        //     return '_self';
        // });
    }

    public function builder(): Builder
    {
        return Task::query()
            ->where('user_id', '=', auth()->user()->id)
            ->select(); // Select some things
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),
            Column::make('title')
                ->sortable()
                ->searchable(),
            Column::make('priority')
                ->sortable(),
            Column::make('importance')
                ->sortable(),
            Column::make('description')
                ->sortable()
                ->searchable(),
            Column::make('status_id')
                ->sortable(),
            ButtonGroupColumn::make('Action')
                ->unclickable()
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Edit')
                        ->title(fn ($row) => 'Edit')
                        ->location(fn ($row) => route('task.show', $row->id))
                        ->attributes(function ($row) {
                            return [
                                'target' => '_self',
                                'class' => 'underline text-blue-500',
                            ];
                        }),
                ]),
        ];
    }
}
