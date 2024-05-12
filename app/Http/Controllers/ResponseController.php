<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Response;

class ResponseController extends Controller
{
    public function create_response(Request $request, $id)
    {
        $request->validate([
            'message' => 'nullable|string',
        ]);

        $response = new Response;
        $response->user_id = Auth::id();
        $response->vacancy_id = $id;
        $response->cover_letter = $request->message;
        $response->status = 'не рассмотренно';
        $response->save();

        return response()->json(['success' => true]);
    }

}
