<?php

namespace App\Observers;

use App\Models\AuditTrail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuditTrailObserver
{
    // Handle updated records
    public function updated($model)
    {
        Log::info('Audit Trail Updated Event Triggered');
        AuditTrail::create([
            'event' => 'updated',
            'table_name' => $model->getTable(),
            'record_id' => $model->id,
            'old_data' => serialize($model->getOriginal()),
            'new_data' => serialize($model->getChanges()),
            'user_id' => Auth::id(),
            'action_time' => now(),
        ]);
    }

    // Handle deleted records
    public function deleting($model)
    {
        Log::info('Audit Trail Deleted Event Triggered');
        AuditTrail::create([
            'event' => 'deleted',
            'table_name' => $model->getTable(),
            'record_id' => $model->id,
            'old_data' => serialize($model->getOriginal()),
            'new_data' => null,
            'user_id' => Auth::id(),
            'action_time' => now(),
        ]);
    }
}
