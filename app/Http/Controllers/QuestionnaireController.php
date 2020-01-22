<?php

namespace App\Http\Controllers;

use App\Questionnaire;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view("questionnaire.create");
    }


    public function store(Questionnaire $questionnaire)
    {
        $data = request()->validate([
            'title' => 'required',
            'purpose' => 'required'   // "purpose" is taken from input name in blade
        ]);

        //$data['user_id'] = auth()->user()->id;
        //$questionnaire = Questionnaire::create($data);

        $questionnaire = auth()->user()->questionnaires()->create($data);

        return redirect("/questionnaires/" . $questionnaire->id);
    }


    public function show(Questionnaire $questionnaire)
    {
        $questionnaire->load('questions.answers.responses'); // 'questions' and 'answers' are from relations

        return view("questionnaire.show", compact('questionnaire'));
    }
}
