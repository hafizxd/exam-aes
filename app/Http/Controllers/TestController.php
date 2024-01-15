<?php

namespace App\Http\Controllers;

use App\Models\TestQuestion;
use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::paginate(10);

        return view('tests.index', compact('tests'));
    }

    public function create()
    {
        return view('tests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'description' => 'required'
        ]);

        Test::create([
            'subject' => $request->subject,
            'description' => $request->description
        ]);

        return redirect()->route('test.index');
    }

    public function edit($id)
    {
        $test = Test::findOrFail($id);
        $questions = TestQuestion::where('test_id', $test->id)->paginate(10);

        return view('tests.edit', compact('test', 'questions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required',
            'description' => 'required'
        ]);

        Test::findOrFail($id)->update([
            'subject' => $request->subject,
            'description' => $request->description
        ]);

        return redirect()->back();
    }

    public function delete($id)
    {
        Test::findOrFail($id)->delete();

        return redirect()->back();
    }

    public function questionCreate()
    {
        return view('tests.questions.create');
    }

    public function questionStore(Request $request, $id)
    {
        $request->validate([
            'question' => 'required'
        ]);

        Test::findOrFail($id)->testQuestions()->create([
            'question' => $request->question
        ]);

        return redirect()->route('test.edit', $id);
    }

    public function questionEdit($id, $questionId)
    {
        $question = Test::findOrFail($id)->testQuestions()->findOrFail($questionId);

        return view('tests.questions.edit', compact('question'));
    }

    public function questionUpdate(Request $request, $id, $questionId)
    {
        $request->validate([
            'question' => 'required'
        ]);

        Test::findOrFail($id)->testQuestions()->where('id', $questionId)->update([
            'question' => $request->question
        ]);

        return redirect()->back();
    }

    public function questionDelete($id, $questionId)
    {
        Test::findOrFail($id)->testQuestions()->where('id', $questionId)->delete();

        return redirect()->back();
    }
}
