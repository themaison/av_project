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
        $vacancies = Vacancy::where('user_id', auth()->user()->id)->get();
        return view('recruiter/recruiter_vacancies', compact('vacancies'));
    }

    public function new_vacancy_index()
    {
        return view('recruiter/new_vacancy');
    }

    public function create_vacancy(Request $request)
    {
        // Проверка входных данных
        $request->validate([
            'title' => 'required',
            'company' => 'required',
            'city' => 'required',
        ]);

        // Создание новой вакансии
        $vacancy = new Vacancy;

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
        $vacancy->responsibilities = $request->responsibilities;
        $vacancy->requirements = $request->requirements;
        $vacancy->conditions = $request->conditions;
        $vacancy->skills = $request->skills;

        // Получение текущего пользователя
        $user = auth()->user();
        // Связывание вакансии с пользователем
        $user->vacancies()->save($vacancy);

        return redirect('/recruiter_vacancies');
    }

    public function vacancy_delete($id)
    {
        $vacancy = Vacancy::find($id);
        $vacancy->delete();

        return redirect('/recruiter_vacancies');
    }

    public function vacancy_update(Request $request, $id)
    {
        // Проверка входных данных
        $request->validate([
            'title' => 'required',
            'company' => 'required',
            'city' => 'required',
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
        $vacancy->responsibilities = $request->responsibilities;
        $vacancy->requirements = $request->requirements;
        $vacancy->conditions = $request->conditions;
        $vacancy->skills = $request->skills;
        // $vacancy->title = $request->input('title');
        // $vacancy->company = $request->input('company');
        // $vacancy->city = $request->input('city');
        // $vacancy->salary_from = $request->input('salary-from');
        // $vacancy->salary_to = $request->input('salary-to');
        // $vacancy->experience = $request->input('experience');
        // $vacancy->responsibilities = $request->input('responsibilities');
        // $vacancy->requirements = $request->input('requirements');
        // $vacancy->conditions = $request->input('conditions');
        // $vacancy->skills = $request->input('skills');

        $vacancy->save();
        return redirect('/recruiter_vacancies');
    }

    // public function upload_cover(Request $request)
    // {
    //     $request->validate([
    //         'cover' => 'required|file|image|max:2048',  // Проверка файла
    //     ]);

    //     $cover = $request->file('cover');
    //     $path = $cover->store('covers', 'public');  // Загрузка файла

    //     return response()->file(storage_path("app/public/{$path}"));  // Отправка файла обратно в браузер
    // }
}
