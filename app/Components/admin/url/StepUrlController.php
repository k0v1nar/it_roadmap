<?php

namespace App\Components\admin\url;

use App\Http\Controllers\Controller;
use App\Models\StepUrls;
use App\Models\StepOfCurs;
use Illuminate\Http\Request;

class StepUrlController extends Controller {
    public function index() {
        $urls = StepUrls::paginate(10);
        return view('admin.url.template.index', [
            'meta_title' => 'Этапы URL',
            'urls' => $urls
        ]);
    }

    public function add() {
        $steps = StepOfCurs::all();
        return view('admin.url.template.add-edit', [
            'meta_title' => 'Добавление URL',
            'steps' => $steps
        ]);
    }

    public function confirmAdd(Request $request) {
        $messages = [
            'url.required' => 'Введите URL.',
            'step_id.required' => 'Выберите шаг.',
        ];
        $request->validate([
            "url" => 'required',
            "step_id" => 'required|exists:steps_of_curs,id'
        ], $messages);
        $stepUrl = StepUrls::create([
            "url" => $request->url,
            "step_id" => $request->step_id
        ]);
        if (isset($stepUrl)) {
            return redirect()->route('admin.steps.urls.finish', ['type' => 'add', 'id' => $stepUrl->id]);
        }
        else {
            return back()->withErrors(['errors' => 'Ошибка добавления URL']);
        }
    }

    public function edit($id) {
        $url = StepUrls::find($id);
        $steps = StepOfCurs::all();
        return view('admin.url.template.add-edit', [
            'meta_title' => 'Изменение URL',
            'url' => $url,
            'steps' => $steps
        ]);
    }

    public function confirmEdit(Request $request) {
        $messages = [
            'id.required' => 'Не хороший код',
            'id.exists' => 'Не хороший код',
            'url.required' => 'Введите URL.',
            'step_id.required' => 'Выберите шаг.',
        ];
        $request->validate([
            "id" => 'required|exists:step_urls,id',
            "url" => 'required',
            "step_id" => 'required|exists:steps_of_curs,id'
        ], $messages);
        $stepUrl = StepUrls::find($request->id);
        $stepUrl->url = $request->url;
        $stepUrl->step_id = $request->step_id;
        $stepUrl->save();
        return redirect()->route('admin.steps.urls.finish', ['type' => 'edit', 'id' => $stepUrl->id]);
    }

    public function delete($id) {
        $url = StepUrls::find($id);
        return view('admin.url.template.delete', [
            'meta_title' => 'Удаление URL',
            'url' => $url
        ]);
    }

    public function confirmDelete($id) {
        StepUrls::where('id', $id)->delete();
        return redirect()->route('admin.steps.urls.finish', ['type' => 'delete', 'id' => $id]);
    }

    public function finish($type, $id) {
        $url = StepUrls::find($id);
        return view("admin.url.template.finish", [
            'meta_title' => 'Завершение действия с URL',
            'url' => $url,
            "type" => $type
        ]);
    }
}
