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

class AnswerController extends Controller {
  public function __construct() {
    $this->middleware('auth');
  }

  public function store(Request $request, Survey $survey) {
    // удалить токен
    $arr = $request->except('_token');
    foreach ($arr as $key => $value) {
      $newAnswer = new Answer();
      if (! is_array( $value )) {
        $newValue = $value['answer'];
      } else {
        $newValue = json_encode($value['answer']);
      }
      $newAnswer->answer = $newValue;
      $newAnswer->question_id = $key;
      $newAnswer->user_id = Auth::id();
      $newAnswer->survey_id = $survey->id;

      $newAnswer->save();
    };
    return redirect()->action('SurveyController@view_survey_answers', [$survey->id]);
  }
}