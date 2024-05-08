<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
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

        // Загрузка изображения
        // $imageName = time().'.'.$request->cover->extension();  
        // $request->cover->move(public_path('images'), $imageName);

        // Создание новой вакансии
        $vacancy = new Vacancy;

        if ($request->hasFile('cover')) {
            $imageName = time().'.'.$request->cover->extension();  
            $request->cover->move(public_path('images'), $imageName);
            $vacancy->cover = $imageName;
        }

        // $vacancy->cover = $imageName;
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

}
