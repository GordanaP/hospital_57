{{-- <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
 --}}

 @extends('layouts.admin')

 @section('content')
        <header>Calendar</header>

        <div class="card card-body p-0">
            <div id="calendar"></div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="event-modal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Modal body text goes here.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

 @endsection

 @section('scripts')
     <script>

         var calendar = $('#bs-year-calendar');

         function editEvent(event) {
             $('#event-modal').modal();
         }

             var currentYear = new Date().getFullYear();

             $('#calendar').calendar({
                 enableContextMenu: true,
                 enableRangeSelection: true,
                 contextMenuItems:[
                     {
                         text: 'Update',
                         click: editEvent
                     },
                 ],
                 clickDay: function(e) {

                    var eventId = e.events[0] ? e.events[0].id : '';

                    javascript:location.href = '/absences/' + eventId + '/edit'
                 },
                 mouseOnDay: function(e) {
                     if(e.events.length > 0) {
                         var content = '';

                         for(var i in e.events) {
                             content += '<div class="event-tooltip-content">'
                                             + '<div class="event-name" style="color:' + e.events[i].color + '">' + e.events[i].name + '</div>'
                                             + '<div class="event-location">' + e.events[i].location + '</div>'
                                         + '</div>';
                         }

                         $(e.element).popover({
                             trigger: 'manual',
                             container: 'body',
                             html:true,
                             content: content
                         });

                         $(e.element).popover('show');
                     }
                 },
                 mouseOutDay: function(e) {
                     if(e.events.length > 0) {
                         $(e.element).popover('hide');
                     }
                 },
                 dayContextMenu: function(e) {
                     $(e.element).popover('hide');
                 },
                 dataSource: [
                     {
                         id: 2,
                         name: 'Google I/O',
                         location: 'San Francisco, CA',
                         startDate: new Date(currentYear, 4, 28),
                         endDate: new Date(currentYear, 4, 29)
                     },
                     {
                         id: 3,
                         name: 'Microsoft Convergence',
                         location: 'New Orleans, LA',
                         startDate: new Date(currentYear, 2, 16),
                         endDate: new Date(currentYear, 2, 19)
                     },
                ]
             });

     </script>
 @endsection
