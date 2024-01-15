<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Attendant;
use App\Models\Session;

class SessionController extends Controller
{
    public function indexFinished()
    {
        $attendants = Attendant::where('user_id', Auth::user()->id)
            ->where('time_end', '!=', "0")
            ->with(['session.test', 'attendantAnswers.testQuestion'])
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Success',
            'payload' => $attendants
        ]);
    }

    public function index(Request $request)
    {
        $request->validate(['code' => 'required']);

        $session = Session::where('code', $request->code)
            ->with('test.testQuestions')
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'message' => 'Success',
            'payload' => $session
        ]);
    }

    public function start(Request $request)
    {
        $request->validate(['code' => 'required']);

        $session = Session::where('code', $request->code)->firstOrFail();
        $exists = Attendant::where('user_id', Auth::user()->id)->where('session_id', $session->id)->exists();
        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah memulai sesi tes ini',
                'payload' => []
            ]);
        }

        $attendant = Attendant::create([
            'user_id' => Auth::user()->id,
            'session_id' => $session->id,
            'date_start' => date('Y-m-d'),
            'time_start' => date('H:i'),
            'time_end' => 0
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Success',
            'payload' => $attendant
        ]);
    }

    public function storeAnswer(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'answers' => 'required|array'
        ]);

        $session = Session::where('code', $request->code)->firstOrFail();

        $attendant = Attendant::where('session_id', $session->id)->where('user_id', Auth::user()->id)->firstOrFail();
        $attendant->update([
            'time_end' => date('H:i')
        ]);

        $attendant->attendantAnswers()->createMany($request->answers);

        return response()->json([
            'success' => true,
            'message' => 'Success',
            'payload' => $attendant
        ]);
    }
}
