<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Http\Requests\Grade\GradeStoreRequest;
use App\Http\Requests\Grade\GradeUpdateRequest;
use App\Http\Requests\Grade\GradeUpdatePlanRequest;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::all();
        return response()->json($grades);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GradeStoreRequest $request)
    {
        $validated = $request->validated();
        $grade = Grade::create($validated);
        return response()->json($grade,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        return response()->json($grade);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GradeUpdateRequest $request, Grade $grade)
    {
        $validated = $request->validated();
        $grade->update($validated);
        return response()->json($grade);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();
        return response()->json(null,204);
    }
    public function updatePlan(GradeUpdatePlanRequest $request, Grade $grade)
    {
        // Получаем проверенные данные из запроса
        $validated = $request->validated();

        // Начинаем транзакцию для обеспечения целостности данных
        DB::beginTransaction();

        try {
            // Сначала удаляем все текущие связи между классом и лекциями
            $grade->lectures()->detach();

            // Теперь создаем новые связи с обновленным порядком
            foreach ($validated['lectures'] as $order => $lectureId) {
                $grade->lectures()->attach($lectureId, ['order' => $order]);
            }

            // Если все прошло без ошибок, подтверждаем транзакцию
            DB::commit();

            // Возвращаем ответ с успехом
            return response()->json([
                'message' => 'Учебный план успешно обновлен.',
                'grade' => $grade->load('lectures'),  // Загружаем обновленные лекции с помощью "жадной" загрузки
            ]);
        } catch (\Exception $e) {
            // В случае ошибки откатываем транзакцию
            DB::rollback();

            // Возвращаем ответ с ошибкой
            return response()->json([
                'message' => 'Произошла ошибка при обновлении учебного плана.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



}
