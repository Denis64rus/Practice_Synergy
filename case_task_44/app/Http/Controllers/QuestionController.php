<?php

namespace App\Http\Controllers;
use Auth;
use App\Survey;
use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class QuestionController extends Controller {
  public function __construct() {
    $this->middleware('auth');
  }

  public function store(Request $request, Survey $survey) {
    // удалить токен
    $arr = $request->except('_token');
    foreach ($arr as $key => $value) {
      $newQuestion = new Question();
      if (! is_array( $value )) {
        $newValue = $value['question'];
      } else {
        $newValue = json_encode($value['question']);
      }
      $newQuestion->question = $newValue;
      $newQuestion->question_id = $key;
      $newQuestion->user_id = Auth::id();
      $newQuestion->survey_id = $survey->id;

      $newQuestion->save();
    };
    return redirect()->action('SurveyController@view_survey_questions', [$survey->id]);
  }
}