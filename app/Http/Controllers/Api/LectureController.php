<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lecture;
use App\Http\Requests\Lecture\LectureStoreRequest;
use App\Http\Requests\Lecture\LectureUpdateRequest;
class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lectures = Lecture::with(['grades', 'students'])->get(); //eagle загрузка
        return response()->json($lectures);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(LectureStoreRequest $request)
    {
        $validated = $request->validated();
        $lecture = Lecture::create($validated);
        return response()->json($lecture,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lecture $lecture)
    {
        $lecture->load(['grades','students']); //Информация о том какие классы и студенты прослушали лекцию
        return response()->json($lecture);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LectureUpdateRequest $request, Lecture $lecture)
    {
        $validated = $request->validated();
        $lecture->update($validated);
        return response()->json($lecture);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lecture $lecture)
    {
        $lecture->delete();
        return response()->json(null,204);
    }
}
