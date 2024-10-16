<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Response;
use App\Models\ResponseStatus;

class ResponseController extends Controller
{
    public function recruiter_responses_index()
    {
        $vacancies = auth()->user()->vacancies;
        $responses = Response::whereIn('vacancy_id', $vacancies->pluck('id'))->paginate(5);
        return view('recruiter/recruiter_responses', compact('responses'));
    }
    

    public function applicant_responses_index()
    {
        $responses = auth()->user()->responses()->paginate(5);
        return view('applicant/applicant_responses', compact('responses'));
    }

    public function create_response(Request $request, $id)
    {
        $request->validate([
            'cover_letter' => 'nullable|string',
        ]);

        $response = new Response;
        $response->user_id = Auth::id();
        $response->vacancy_id = $id;
        $response->cover_letter = $request->cover_letter;
        $response->status_id = 4; // ID для 'не рассмотрено'
        $response->save();

        return response()->json(['success' => true]);
    }
    
    public function delete_response($id)
    {
        $vacancy = Response::find($id);
        $vacancy->delete();

        return redirect('/applicant_responses');
    }
    
    public function set_status(Request $request, $id)
    {
        $response = Response::find($id);

        if ($response) {
            $response_status = ResponseStatus::find($request->status_id);
            if ($response_status) {
                $response->status_id = $response_status->id;
                $response->save();
                return response()->json(['success' => true]);
            }
        }

        return response()->json(['success' => false]);
    }


}
