<?php
use App\Models\Tasks;
it('detecta si una tarea esta vencida', function () {
    $task= new Tasks([
        'due_date' => now()->subDay(),
        'status' => 'Pendiente'
    ]);
    expect($task->isOverdue())->toBeTrue();
});
