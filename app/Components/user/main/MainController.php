<?php

namespace App\Components\user\main;

use App\Http\Controllers\Controller;
use App\Models\Curs;
use App\Models\SelectedCurs;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    public function index() {
        $popularCurs = Curs::withCount('selected')
            ->orderByDesc('selected_count')
            ->limit(5)
            ->get();
        $completedCurs = Curs::select('curs.*')
            ->join('selected_curs', 'curs.id', '=', 'selected_curs.curs_id')
            ->selectRaw('curs.*, AVG(selected_curs.is_finish) as completion_rate')
            ->groupBy('curs.id')
            ->orderByDesc('completion_rate')
            ->limit(5)
            ->get();
        $user = User::auth();
        $activeCurs = [];
        if ($user) {
            $activeCurs = SelectedCurs::with(['curs'])
            ->where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();
        }
    
        // Возвращаем данные в представление
        return view('user.main.template.index', [
            'meta_title' => 'Главная',
            'popularCurs' => $popularCurs,
            'completedCurs' => $completedCurs,
            'activeCurs' => $activeCurs
        ]);
    }
}