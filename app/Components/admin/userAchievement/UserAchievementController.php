<?php

namespace App\Components\admin\userAchievement;

use App\Http\Controllers\Controller;
use App\Models\UserAchievement;
use App\Models\User;
use App\Models\Achievement;
use Illuminate\Http\Request;

class UserAchievementController extends Controller
{
    public function index()
    {
        $userAchievements = UserAchievement::paginate(10);
        return view('admin.userAchievement.template.index', [
            'meta_title' => 'Достижения пользователей',
            'userAchievements' => $userAchievements
        ]);
    }

    public function add()
    {
        $users = User::all();
        $achievements = Achievement::all();
        return view('admin.userAchievement.template.add-edit', [
            'meta_title' => 'Добавление достижения пользователя',
            'users' => $users,
            'achievements' => $achievements
        ]);
    }

    public function confirmAdd(Request $request)
    {
        $messages = [
            'user_id.required' => 'Выберите пользователя.',
            'achievement_id.required' => 'Выберите достижение.',
        ];

        $request->validate([
            "user_id" => 'required|exists:users,id',
            "achievement_id" => 'required|exists:achievements,id'
        ], $messages);

        $userAchievement = UserAchievement::create([
            "user_id" => $request->user_id,
            "achievement_id" => $request->achievement_id
        ]);

        if (isset($userAchievement)) {
            return redirect()->route('admin.user.achievement.finish', ['type' => 'add', 'id' => $userAchievement->id]);
        } else {
            return back()->withErrors(['errors' => 'Ошибка добавления достижения']);
        }
    }

    public function edit($id)
    {
        $userAchievement = UserAchievement::find($id);
        $users = User::all();
        $achievements = Achievement::all();
        return view('admin.userAchievement.template.add-edit', [
            'meta_title' => 'Изменение достижения пользователя',
            'userAchievement' => $userAchievement,
            'users' => $users,
            'achievements' => $achievements
        ]);
    }

    public function confirmEdit(Request $request)
    {
        $messages = [
            'user_id.required' => 'Выберите пользователя.',
            'achievement_id.required' => 'Выберите достижение.',
        ];

        $request->validate([
            "user_id" => 'required|exists:users,id',
            "achievement_id" => 'required|exists:achievements,id'
        ], $messages);

        $userAchievement = UserAchievement::find($request->id);
        $userAchievement->user_id = $request->user_id;
        $userAchievement->achievement_id = $request->achievement_id;
        $userAchievement->save();

        return redirect()->route('admin.user.achievement.finish', ['type' => 'edit', 'id' => $userAchievement->id]);
    }

    public function delete($id)
    {
        $userAchievement = UserAchievement::find($id);
        return view('admin.userAchievement.template.delete', [
            'meta_title' => 'Удаление достижения пользователя',
            'userAchievement' => $userAchievement
        ]);
    }

    public function confirmDelete($id)
    {
        UserAchievement::where('id', $id)->delete();
        return redirect()->route('admin.user.achievement.finish', ['type' => 'delete', 'id' => $id]);
    }

    public function finish($type, $id)
    {
        $userAchievement = ($type == "delete") ? (object) ['id' => $id] : UserAchievement::find($id);
        return view("admin.userAchievement.template.finish", [
            'meta_title' => 'Завершение действия с достижениями пользователей',
            'userAchievement' => $userAchievement,
            "type" => $type
        ]);
    }
}
