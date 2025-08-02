<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait HasStatusToggle
{
    public function toggleStatu($modelClass, $id): JsonResponse
    {
        try {
            $model = $modelClass::findOrFail($id);
            $model->status = !$model->status;
            $model->save();
            $statusText = $model->status ? 'مفعل' : 'غير مفعل';
            return response()->json(['status' => true,
                'newStatus' => $model->status,
                'message' => "تم تحديث الحالة إلى: $statusText",
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'لم يتم العثور على العنصر'], 404);
        }
    }
}
