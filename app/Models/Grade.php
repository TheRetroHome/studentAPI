<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
class Grade extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public function students(){
        return $this->hasMany(Student::class);
    }
    public function lectures(){
        return $this->belongsToMany(Lecture::class, 'class_lecture')->withPivot('order')->orderBy('pivot_order');
    }
    // Скоуп для загрузки лекций
    public function scopeWithLectures(Builder $query)
    {
        return $query->with('lectures');
    }

    // Скоуп для открепления студентов
    public function scopeDetachStudents(Builder $query)
    {
        return $query->students()->update(['grade_id' => null]);
    }
    public function updatePlan(array $lectures): self
    {
        // Начинаем транзакцию для обеспечения целостности данных
        DB::beginTransaction();

        try {
            // Сначала удаляем все текущие связи между классом и лекциями
            $this->lectures()->detach();

            // Теперь создаем новые связи с обновленным порядком
            foreach ($lectures as $order => $lectureId) {
                $this->lectures()->attach($lectureId, ['order' => $order]);
            }

            // Если все прошло без ошибок, подтверждаем транзакцию
            DB::commit();

            // Возвращаем текущий объект с обновленными лекциями
            return $this->load('lectures');
        } catch (\Exception $e) {
            // В случае ошибки откатываем транзакцию
            DB::rollback();

            // Перебрасываем исключение
            throw $e;
        }
    }
}
