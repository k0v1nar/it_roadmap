<?php

namespace App\Components\admin\steps;

use App\Http\Controllers\Controller;
use App\Models\Curs;
use App\Models\StepOfCurs;
use Illuminate\Http\Request;

class StepsController extends Controller
{
    public function index()
    {
        $steps = StepOfCurs::paginate(10);
        return view('admin.steps.template.index', [
            'meta_title' => 'Этапы курсов',
            'steps' => $steps
        ]);
    }

    public function add()
    {
        $courses = Curs::all();
        return view('admin.steps.template.add-edit', [
            'meta_title' => 'Добавление шага курса',
            'courses' => $courses,
        ]);
    }

    public function confirmAdd(Request $request)
    {
        $messages = [
            'name.required' => 'Введите название шага.',
            'description.required' => 'Введите описание шага.',
            'average_completion_time.required' => 'Укажите среднее время завершения шага.',
            'average_completion_time.numeric' => 'Среднее время должно быть числом.',
            'previous_id.exists' => 'Выбранный предыдущий шаг не существует.',
            'previous_id.not_self' => 'Этап не может ссылаться сам на себя.',
        ];
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'average_completion_time' => 'required|numeric',
            'previous_id' => 'nullable|exists:steps_of_curs,id',
            'curs_id' => 'required|exists:curs,id',
        ], $messages);
        if ($request->previous_id == $request->id && isset($request->previous_id)) {
            return back()->withErrors(['previous_id' => 'Этап не может ссылаться сам на себя.']);
        }

        $step = StepOfCurs::create([
            'name' => $request->name,
            'description' => $request->description,
            'average_completion_time' => $request->average_completion_time,
            'previous_id' => $request->previous_id,
            'curs_id' => $request->curs_id
        ]);

        if ($step) {
            return redirect()->route('admin.steps.finish', ['type' => 'add', 'id' => $step->id]);
        } else {
            return back()->withErrors(['errors' => 'Ошибка создания шага курса']);
        }
    }

    public function edit($id)
    {
        $step = StepOfCurs::find($id);
        $courses = Curs::all();
        return view('admin.steps.template.add-edit', [
            'meta_title' => 'Изменение шага курса',
            'step' => $step,
            'courses' => $courses,
        ]);
    }

    public function confirmEdit(Request $request)
    {
        $messages = [
            'id.required' => 'Не подделывайте код.',
            'id.exists' => 'Такой шаг не найден.',
            'name.required' => 'Введите название шага.',
            'description.required' => 'Введите описание шага.',
            'average_completion_time.required' => 'Укажите среднее время завершения шага.',
            'average_completion_time.numeric' => 'Среднее время должно быть числом.',
            'previous_id.exists' => 'Выбранный предыдущий шаг не существует.',
            'previous_id.not_self' => 'Этап не может ссылаться сам на себя.',
        ];
        $request->validate([
            'id' => 'required|exists:steps_of_curs,id',
            'name' => 'required',
            'description' => 'required',
            'average_completion_time' => 'required|numeric',
            'previous_id' => 'nullable|exists:steps_of_curs,id',
            'curs_id' => 'required|exists:curs,id',
        ], $messages);
        if ($request->previous_id == $request->id) {
            return back()->withErrors(['previous_id' => 'Этап не может ссылаться сам на себя.']);
        }

        $step = StepOfCurs::find($request->id);
        $step->update([
            'name' => $request->name,
            'description' => $request->description,
            'average_completion_time' => $request->average_completion_time,
            'previous_id' => $request->previous_id,
            'curs_id' => $request->curs_id
        ]);

        return redirect()->route('admin.steps.finish', ['type' => 'edit', 'id' => $step->id]);
    }

    public function delete($id)
    {
        $step = StepOfCurs::find($id);
        return view('admin.steps.template.delete', [
            'meta_title' => 'Удаление шага курса',
            'step' => $step,
        ]);
    }

    public function confirmDelete($id)
    {
        $step = StepOfCurs::find($id);
        if ($step) {
            $step->delete();
        }
        return redirect()->route('admin.steps.finish', ['type' => 'delete', 'id' => $id]);
    }

    public function finish($type, $id)
    {
        $step = ($type == 'delete') ? (object) ['name' => $id] : StepOfCurs::find($id);
        return view('admin.steps.template.finish', [
            'meta_title' => 'Завершение операции',
            'step' => $step,
            'type' => $type,
        ]);
    }

    public function getStepsByCourse(Request $request)
    {
        $cursId = $request->input('curs_id');
        $currentStepId = $request->input('current_step_id');

        if (!$cursId) {
            return response()->json([]);
        }

        $steps = StepOfCurs::where('curs_id', $cursId)
            ->when($currentStepId, fn ($query) => $query->where('id', '!=', $currentStepId))
            ->get();

        return response()->json($steps);
    }
}
