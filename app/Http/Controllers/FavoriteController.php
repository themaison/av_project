<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function favorite_vacancies_index()
    {
        $user = Auth::user();
        $vacancies = $user->favoritedVacancies()->paginate(6);

        return view('applicant/favorite_vacancies', ['vacancies' => $vacancies]);
    }

    public function toggle_favorite(Request $request, $id)
    {
        $vacancy = Vacancy::find($id);
        $user = Auth::user();

        if ($user->favoritedVacancies()->where('vacancy_id', $vacancy->id)->exists()) {
            $user->favoritedVacancies()->detach($vacancy->id);
            return response()->json(['favorite' => false]);
        } else {
            $user->favoritedVacancies()->attach($vacancy->id);
            return response()->json(['favorite' => true]);
        }
    }


}
