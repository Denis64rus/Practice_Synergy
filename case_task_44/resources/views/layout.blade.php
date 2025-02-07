<!DOCTYPE html>
<html>
    <head>
        <title>Приложение-опросник</title>
        {!! MaterializeCSS::include_css() !!}
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    </head>

    <body>
      <div class="container">
          <!-- Навигация -->
          <div class="row" style="padding-top:10px;">
              <div class="center-align">
                <a class="btn blue waves-effect waves-light lighten-1 white-text" href="/"> Домашняя </a>
                  @if(Auth::check())
                    <a class="btn-flat waves-effect waves-light darken-1 white black-text" href="/logout"> Выйти </a>
                    <a class="btn-flat disabled" href="#" style="text-transform:none;">{{ Auth::user()->email }}</a>
                  @else
                    <a class="btn-flat waves-effect waves-light darken-1 white black-text" href="/login"> Войти </a>
                    <a class="btn-flat waves-effect waves-light darken-1 white black-text" href="/register"> Регистрация </a>
                  @endif
              </div>
          </div>
         <!-- Конец Навигация -->

         <!-- ТЕЛО СТРАНИЦЫ -->
          <div class="row">
              <div class="col s12 m10 offset-m1 l8 offset-l2" style="margin-top:10px;">
                @yield('content')
              </div>
          </div>
         <!-- Конец ТЕЛО СТРАНИЦЫ -->
      </div>
    </body>
    <script src="{{ URL::asset('jquery.min.js') }}"></script>
    {!! MaterializeCSS::include_js() !!}
    <script src="{{ URL::asset('init.js') }}"></script>
    <script src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js') }}"></script>

</html>