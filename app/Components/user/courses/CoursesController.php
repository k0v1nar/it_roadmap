<?php

namespace App\Components\user\courses;

use App\Http\Controllers\Controller;
use App\Models\Curs;
use App\Models\SelectedCurs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class CoursesController extends Controller
{
    public function index() {
        $user = User::auth();
        $courses = Curs::with('first_step')->paginate(20);
        if ($user) {
            $selectedCursIds = SelectedCurs::where('user_id', $user->id)->pluck('curs_id')->toArray();
            $courses->getCollection()->transform(function ($course) use ($selectedCursIds) {
                $course->selected = in_array($course->id, $selectedCursIds);
                return $course;
            });
        }
        return view('user.courses.template.index', [
            'courses' => $courses,
            'meta_title' => 'Список курсов',
            'user' => $user
        ]);
    }

    public function getCourseSteps($step)
    {
        $result = $step->toArray();
        $result['nextSteps'] = $step->nextSteps->map(function ($nextStep) {
            return $this->getCourseSteps($nextStep);
        })->toArray();
        $result['urls'] = $step->urls;
        return $result;
    }

    public function show($course) {
        $user = User::auth();
        $curs = Curs::with('first_step.nextSteps')->findOrFail($course);
        $steps = $this->getCourseSteps($curs->first_step);
        $selected = false;
        if (isset($user)) {
            $selectedCurs = SelectedCurs::where('user_id', $user->id)->where('curs_id', $course)->first();
            if (isset($selectedCurs)) {
                $selected = true;
            }
        }
        return view('user.courses.template.show', [
            'curs' => $curs,
            'steps' => json_encode($steps),
            'meta_title' => 'Курс',
            'user' => $user, 
            'selected' => $selected
        ]);
    }
}
