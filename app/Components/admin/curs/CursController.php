<?php

namespace App\Components\admin\curs;

use App\Http\Controllers\Controller;
use App\Models\Curs;
use App\Models\StepOfCurs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CursController extends Controller
{
    public function index() {
        $curs = Curs::with('first_step')->paginate(10);
        return view('admin.curs.template.index', [
            'meta_title' => 'Курсы',
            'curs' => $curs
        ]);
    }

    public function add() {
        $steps = StepOfCurs::all();
        return view('admin.curs.template.add-edit', [
            'meta_title' => 'Добавление курса',
            'steps' => $steps
        ]);
    }

    public function confirmAdd(Request $request) {
        $messages = [
            'name.required' => 'Введите название курса.',
            'description.required' => 'Введите описание курса.',
            'purpose.required' => 'Введите цель курса.',
            'average_completion_time.required' => 'Укажите среднее время завершения курса.',
            'average_completion_time.numeric' => 'Среднее время должно быть числом.',
            'path_icon.file' => 'Загрузите файл изображения.',
            'path_icon.mimes' => 'Изображение должно быть формата: jpeg, png, jpg, gif, svg.',
            'path_icon.max' => 'Размер изображения не должен превышать 2MB.',
        ];

        $request->validate([
            "name" => 'required',
            "description" => 'required',
            "purpose" => 'required',
            "average_completion_time" => 'nullable|numeric',
            "first_step_id" => 'nullable|exists:steps_of_curs,id',
            "path_icon" => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], $messages);

        $path_icon = null;
        if ($request->hasFile('path_icon') && $request->file('path_icon')->isValid()) {
            $path_icon = $request->file('path_icon')->store('curs', 'public');
        }

        $curs = Curs::create([
            "name" => $request->name,
            "description" => $request->description,
            "purpose" => $request->purpose,
            "average_completion_time" => $request->average_completion_time,
            "first_step_id" => $request->first_step_id,
            "path_icon" => $path_icon,
        ]);

        if ($curs) {
            return redirect()->route('admin.curs.finish', ['type' => 'add', 'id' => $curs->id]);
        } else {
            return back()->withErrors(['errors' => 'Ошибка создания курса']);
        }
    }

    public function edit($id) {
        $curs = Curs::find($id);
        $steps = StepOfCurs::all();
        return view('admin.curs.template.add-edit', [
            'meta_title' => 'Изменение курса',
            'curs' => $curs,
            'steps' => $steps
        ]);
    }

    public function confirmEdit(Request $request) {
        $messages = [
            'id.required' => 'Не хорошо лазить в коде)',
            'id.exists' => 'Не хорошо лазить в коде)',
            'name.required' => 'Введите название курса.',
            'description.required' => 'Введите описание курса.',
            'purpose.required' => 'Введите цель курса.',
            'average_completion_time.required' => 'Укажите среднее время завершения курса.',
            'average_completion_time.numeric' => 'Среднее время должно быть числом.',
        ];

        $request->validate([
            "id" => 'required|exists:curs,id',
            "name" => 'required',
            "description" => 'required',
            "purpose" => 'required',
            "average_completion_time" => 'nullable|numeric',
            "first_step_id" => 'nullable|exists:steps_of_curs,id',
            "path_icon" => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], $messages);

        $curs = Curs::find($request->id);
        $curs->name = $request->name;
        $curs->description = $request->description;
        $curs->purpose = $request->purpose;
        $curs->average_completion_time = $request->average_completion_time;
        $curs->first_step_id = $request->first_step_id;

        // Если была загружена новая иконка, удаляем старую иконку, если она есть
        if ($request->hasFile('path_icon') && $request->file('path_icon')->isValid()) {
            if ($curs->path_icon && Storage::disk('public')->exists($curs->path_icon)) {
                Storage::disk('public')->delete($curs->path_icon); // Удаляем старую иконку
            }
            // Сохраняем новый файл
            $curs->path_icon = $request->file('path_icon')->store('curs', 'public');
        }

        $curs->save();

        return redirect()->route('admin.curs.finish', ['type' => 'edit', 'id' => $curs->id]);
    }

    public function delete($id) {
        $curs = Curs::find($id);
        return view('admin.curs.template.delete', [
            'meta_title' => 'Удаление курса',
            'curs' => $curs
        ]);
    }

    public function confirmDelete($id) {
        $curs = Curs::find($id);
        if ($curs && $curs->path_icon) {
            if (Storage::disk('public')->exists($curs->path_icon)) {
                Storage::disk('public')->delete($curs->path_icon); // Удаляем файл иконки
            }
        }
        Curs::where('id', $id)->delete();
        return redirect()->route('admin.curs.finish', ['type' => 'delete', 'id' => $id]);
    }

    public function finish($type, $id) {
        $curs = ($type == 'delete') ? (object) ['name' => $id] : Curs::find($id);
        return view("admin.curs.template.finish", [
            'meta_title' => 'Завершение операции',
            'curs' => $curs,
            'type' => $type
        ]);
    }
}
