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

class SurveyController extends Controller {
  public function __construct() {
    $this->middleware('auth');
  }

  # функция для домашней страницы
  public function home(Request $request) {
    $surveys = Survey::get();
    return view('home', compact('surveys'));
  }

  # показать страницу для создания нового опроса
  public function new_survey() {
    return view('survey.new');
  }

  public function create(Request $request, Survey $survey) {
    $arr = $request->all();
    // $request->all()['user_id'] = Auth::id();
    $arr['user_id'] = Auth::id();
    $surveyItem = $survey->create($arr);
    return Redirect::to("/survey/{$surveyItem->id}");
  }

  # получить страницу с подробностями и добавить вопросы
  public function detail_survey(Survey $survey) {
    $survey->load('questions.user');
    return view('survey.detail', compact('survey'));
  }


  public function edit(Survey $survey) {
    return view('survey.edit', compact('survey'));
  }

  # редактировать опрос
  public function update(Request $request, Survey $survey) {
    $survey->update($request->only(['title', 'description']));
    return redirect()->action('SurveyController@detail_survey', [$survey->id]);
  }

  # просмотреть опрос публично и завершить опрос
  public function view_survey(Survey $survey) {
    $survey->option_name = unserialize($survey->option_name);
    return view('survey.view', compact('survey'));
  }

  # просмотреть отправленные ответы вошедшего в систему пользователя
  public function view_survey_answers(Survey $survey) {
    $survey->load('user.questions.answers');
    return view('answer.view', compact('survey'));
  }

  public function delete_survey(Survey $survey) {
    $survey->delete();
    return redirect('');
  }

}