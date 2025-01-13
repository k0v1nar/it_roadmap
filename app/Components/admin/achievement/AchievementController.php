<?php

namespace App\Components\admin\achievement;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller {
    public function index() {
        $achievements = Achievement::paginate(10);
        return view('admin.achievement.template.index', [
            'meta_title' => 'Достижения',
            'achievements' => $achievements
        ]);
    }

    public function add() {
        return view('admin.achievement.template.add-edit', [
            'meta_title' => 'Добавление достижения'
        ]);
    }

    public function confirmAdd(Request $request) {
        $messages = [
            'name.required' => 'Введите название достижения.',
            'name.unique' => 'Название достижения должно быть уникальным.',
            'description.required' => 'Введите описание достижения.',
            'path_icon.file' => 'Загрузите файл изображения.',
            'path_icon.mimes' => 'Изображение должно быть формата: jpeg, png, jpg, gif, svg.',
            'path_icon.max' => 'Размер изображения не должен превышать 2MB.',
        ];
        $request->validate([
            "name" => 'required|unique:achievements,name',
            "description" => 'required',
            "path_icon" => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], $messages);
        $path_icon = null;
        if ($request->hasFile('path_icon') && $request->file('path_icon')->isValid()) {
            // Сохраняем файл в public storage и получаем путь
            $path_icon = $request->file('path_icon')->store('achievements', 'public');
        }
        $achievement = Achievement::create([
            "name" => $request->name,
            "description" => $request->description,
            "path_icon" => $path_icon
        ]);
        if (isset($achievement)) {
            return redirect()->route('admin.achievement.finish', ['type' => 'add', 'id' => $achievement->id]);
        } else {
            return back()->withErrors(['errors' => 'Ошибка создания достижения']);
        }
    }

    public function edit($id) {
        $achievement = Achievement::find($id);
        return view('admin.achievement.template.add-edit', [
            'meta_title' => 'Изменение достижения',
            'achievement' => $achievement
        ]);
    }

    public function confirmEdit(Request $request) {
        $messages = [
            'id.required' => 'Не хорошо лазить в коде)',
            'id.exists' => 'Не хорошо лазить в коде)',
            'name.required' => 'Введите название достижения.',
            'name.unique' => 'Название достижения должно быть уникальным.',
            'description.required' => 'Введите описание достижения.',
            'path_icon.file' => 'Загрузите файл изображения.',
            'path_icon.mimes' => 'Изображение должно быть формата: jpeg, png, jpg, gif, svg.',
            'path_icon.max' => 'Размер изображения не должен превышать 2MB.',
        ];
        $request->validate([
            "id" => 'required|exists:achievements,id',
            "name" => 'required|unique:achievements,name,' . $request->id,
            "description" => 'required',
            "path_icon" => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], $messages);
        $achievement = Achievement::find($request->id);
        if ($request->hasFile('path_icon') && $request->file('path_icon')->isValid()) {
            if ($achievement->path_icon && Storage::disk('public')->exists($achievement->path_icon)) {
                Storage::disk('public')->delete($achievement->path_icon);
            }
    
            // Сохраняем новый файл
            $path_icon = $request->file('path_icon')->store('achievements', 'public');
        } else {
            // Если новая иконка не загружена, оставляем старую
            $path_icon = $achievement->path_icon;
        }
        $achievement->name = $request->name;
        $achievement->description = $request->description;
        $achievement->path_icon = $path_icon;
        $achievement->save();
        return redirect()->route('admin.achievement.finish', ['type' => 'edit', 'id' => $achievement->id]);
    }

    public function delete($id) {
        $achievement = Achievement::find($id);
        return view('admin.achievement.template.delete', [
            'meta_title' => 'Удаление достижения',
            'achievement' => $achievement
        ]);
    }

    public function confirmDelete($id) {
        $achievement = Achievement::find($id);

        // Если у достижения есть иконка, удаляем её с диска
        if ($achievement && $achievement->path_icon) {
            if (Storage::disk('public')->exists($achievement->path_icon)) {
                Storage::disk('public')->delete($achievement->path_icon); // Удаляем файл иконки
            }
        }
    
        // Удаляем достижение из базы данных
        Achievement::where('id', $id)->delete();
        return redirect()->route('admin.achievement.finish', ['type' => 'delete', 'id' => $id]);
    }

    public function finish($type, $id) {
        if ($type == "delete") {
            $achievement = (object) [
                'name' => $id
            ];
        } else {
            $achievement = Achievement::find($id);
        }
        return view("admin.achievement.template.finish", [
            'meta_title' => 'Завершение действия с достижениями',
            'achievement' => $achievement,
            "type" => $type
        ]);
    }
}