<?php

namespace App\Components\user\profile\courses;

use App\Http\Controllers\Controller;
use App\Models\Curs;
use App\Models\ProgressUser;
use App\Models\SelectedCurs;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileCoursesController extends Controller
{
    public function index()
    {
        $user = User::auth();
        $selectedCourses = SelectedCurs::with(['curs'])
            ->where('user_id', $user->id)
            ->paginate(20);

        return view('user.profile.courses.template.index', [
            'selectedCourses' => $selectedCourses,
            'meta_title' => 'Мои курсы',
            'user' => $user
        ]);
    }

    public function show($course)
    {
        $user = User::auth();
        $selectedCourse = SelectedCurs::with(['curs'])
            ->where('user_id', $user->id)
            ->where('curs_id', $course)
            ->firstOrFail();
        $steps = $this->getCourseStepsWithProgress($selectedCourse->id);
        return view('user.profile.courses.template.show', [
            'selectedCourse' => $selectedCourse,
            'steps' => json_encode($steps),
            'meta_title' => $selectedCourse->curs->name,
            'user' => $user
        ]);
    }

    public function getCourseStepsWithProgress($selectedCursId)
    {
        // Получаем выбранный курс по ID
        $selectedCurs = SelectedCurs::with(['curs', 'curs.first_step']) // Получаем курс, его первый шаг и все следующие шаги с прогрессом пользователя
            ->findOrFail($selectedCursId);

        // Инициализируем шаги
        $steps = $this->getStepsWithStatus($selectedCurs->curs->first_step, $selectedCurs->user_id);

        return $steps;
    }

    private function getStepsWithStatus($step, $userId)
    {
        // Получаем прогресс пользователя для данного шага
        $progress = ProgressUser::where('user_id', $userId)
            ->where('step_id', $step->id)
            ->first();

        // Создаем объект для текущего шага
        $stepData = [
            'id' => $step->id,
            'name' => $step->name,
            'description' => $step->description,
            'is_finished' => $progress ? $progress->is_finish : false,
            'date_of_finish' => $progress && $progress->is_finish ? $progress->date_of_finish : null,
            'nextSteps' => [] // Инициализируем пустой массив для вложенных шагов
        ];

        // Определяем статус шага (текущий, завершённый или будущий)
        if ($stepData['is_finished']) {
            $stepData['status'] = 'completed';
        } elseif ($progress) {
            $stepData['status'] = 'current';
        } else {
            $stepData['status'] = 'future';
        }

        // Рекурсивно обрабатываем nextSteps
        if ($step->nextSteps->isNotEmpty()) {
            $stepData['nextSteps'] = $step->nextSteps->map(function ($nextStep) use ($userId) {
                return $this->getStepsWithStatus($nextStep, $userId);
            });
        }

        return $stepData;
    }


    public function add($course) {
        $user = User::auth();
        if ($user) {
            $result = SelectedCurs::create([
                'user_id' => $user->id,
                'curs_id' => $course,
                'progress' => 0,
                'is_finish' => false,
                'date_of_finish' => null
            ]);
            $curs = Curs::find($course);
            $progress = ProgressUser::create([
                'user_id' => $user->id,
                'step_id' => $curs->first_step_id,
                'is_finish' => false,
                'date_of_finish' => null
            ]);
            if (isset($result)) {
                return redirect()->route('profile.courses.index');
            }
        }
        return redirect()->back();
    }
}
