<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function search(Request $request)
    {
        // Получение запроса поиска из GET-параметров
        $query = $request->input('query');

        // Проверка, что поле поиска не пустое
        if($query == null || trim($query) === "") {
            return view('vacancy_list');
        }

        $vacancies = Vacancy::where('title', 'like', "%{$query}%")->orderBy('created_at', 'desc')->paginate(6);

        return view('vacancy_list', compact('vacancies', 'query'));
    }

    public function vacancy_search_index()
    {
        return view('vacancy_search');
    }

    public function vacancy_detail_index($id)
    {
        $vacancy = Vacancy::find($id);

        if ($vacancy === null) {
            // Вакансия с данным ID не найдена
            abort(404);
        }

        return view('vacancy_detail', compact('vacancy'));
    }

    public function recruiter_vacancies_index()
    {
        $vacancies = Vacancy::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(5);
        return view('recruiter/recruiter_vacancies', compact('vacancies'));
    }

    public function new_vacancy_index()
    {
        return view('recruiter/new_vacancy');
    }

    public function create_vacancy(Request $request)
    {

        // dd($request);
        // Проверка входных данных
        $request->validate([
            'title' => 'required|max:40',
            'company' => 'required|max:40',
            'city' => 'required|max:40',
            'salary-from' => 'nullable|numeric|min:0|max:99999999',
            'salary-to' => 'nullable|numeric|min:0|gte:salary-from|max:99999999',
            'experience' => 'nullable|numeric|min:0|max:100',
            'responsibilities' => 'nullable|max:255',
            'requirements' => 'nullable|max:255',
            'conditions' => 'nullable|max:255',
            'skills' => 'nullable|max:255',
        ]);

        // Создание новой вакансии
        $vacancy = new Vacancy;

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('public/images/covers');
            $vacancy->cover = $path;
        }

        // if (session()->has('cover_path')) {
        //     $vacancy->cover = session('cover_path');
        // }

        $vacancy->title = $request->title;
        $vacancy->company = $request->company;
        $vacancy->city = $request->city;
        $vacancy->salary_from = $request->input('salary-from');
        $vacancy->salary_to = $request->input('salary-to');
        $vacancy->experience = $request->experience;
        $vacancy->responsibilities = nl2br(e($request->responsibilities));
        $vacancy->requirements = nl2br(e($request->requirements));
        $vacancy->conditions = nl2br(e($request->conditions));
        $vacancy->skills = $request->skills;

        // Получение текущего пользователя
        $user = auth()->user();
        // Связывание вакансии с пользователем
        $user->vacancies()->save($vacancy);

        return redirect('/recruiter_vacancies');
    }

    public function upload_cover(Request $request)
    {
        // $request->validate([
        //     'cover' => 'required|file|image|max:5000',
        // ]);

        $path = $request->file('cover')->store('public/images/covers');

        session(['cover_path' => $path]);

        return response()->json(['success' => true]);
    }

    public function vacancy_delete($id)
    {
        $vacancy = Vacancy::find($id);
        $vacancy->delete();

        return redirect('/recruiter_vacancies');
    }

    public function vacancy_update(Request $request, $id)
    {

        // dd($id);
        // Проверка входных данных
        $request->validate([
            'title' => 'required|max:40',
            'company' => 'required|max:40',
            'city' => 'required|max:40',
            'salary-from' => 'nullable|numeric|min:0|max:99999999',
            'salary-to' => 'nullable|numeric|min:0|gte:salary-from|max:99999999',
            'experience' => 'nullable|numeric|min:0|max:100',
            'responsibilities' => 'nullable|max:255',
            'requirements' => 'nullable|max:255',
            'conditions' => 'nullable|max:255',
            'skills' => 'nullable|max:255',
        ]);

        $vacancy = Vacancy::find($id);

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('public/images/covers');
            $vacancy->cover = $path;
        }

        $vacancy->title = $request->title;
        $vacancy->company = $request->company;
        $vacancy->city = $request->city;
        $vacancy->salary_from = $request->input('salary-from');
        $vacancy->salary_to = $request->input('salary-to');
        $vacancy->experience = $request->experience;
        $vacancy->responsibilities = nl2br(e($request->responsibilities));
        $vacancy->requirements = nl2br(e($request->requirements));
        $vacancy->conditions = nl2br(e($request->conditions));
        $vacancy->skills = $request->skills;

        $vacancy->save();

        // Если запрос является AJAX-запросом, вернуть ответ JSON
        // if ($request->ajax()) {
        //     return response()->json(['success' => true, 'redirectUrl' => '/vacancy_detail/' . $id]);
        // }

        // Иначе, перенаправить на страницу деталей вакансии
        return redirect('/vacancy_detail/' . $id);
    }

}
