<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Test;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = Session::paginate(10);

        return view('sessions.index', compact('sessions'));
    }

    public function create()
    {
        $tests = Test::all();

        return view('sessions.create', compact('tests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'testId' => 'required',
            'class' => 'required',
            'teacher' => 'required',
            'dateStart' => 'required',
            'timeStart' => 'required',
            'timeEnd' => 'required',
        ]);

        $code = $this->generateRandomCode('SESS', 'sessions', 'code');
        $codeEncrypted = encrypt($code);
        Session::create([
            'code' => $code,
            'code_encrypted' => $codeEncrypted,
            'test_id' => $request->testId,
            'class' => $request->class,
            'teacher' => $request->teacher,
            'date_start' => $request->dateStart,
            'time_start' => $request->timeStart,
            'time_end' => $request->timeEnd,
        ]);

        return redirect()->route('session.index');
    }

    function generateRandomCode($prefix, $table, $column)
    {
        $rand = $prefix . "_" . mt_rand(1000000000, 9999999999);

        $data = DB::table($table)->select('id')->where($column, $rand)->first();
        if (isset($data))
            return generateRandomCode($prefix, $table, $column);

        return $rand;
    }

    public function edit($id)
    {
        $session = Session::findOrFail($id);
        $tests = Test::all();

        return view('sessions.edit', compact('session', 'tests'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required',
            'description' => 'required'
        ]);

        Session::findOrFail($id)->update([
            'subject' => $request->subject,
            'description' => $request->description
        ]);

        return redirect()->back();
    }

    public function delete($id)
    {
        Session::findOrFail($id)->delete();

        return redirect()->back();
    }
}
