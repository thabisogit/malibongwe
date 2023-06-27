<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Registry</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#categories').select2();
            @if(Session::has('message'))
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
            toastr.success("{{ session('message') }}");
            @endif

                @if(Session::has('error'))
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
            toastr.error("{{ session('error') }}");
            @endif

                @if(Session::has('info'))
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
            toastr.info("{{ session('info') }}");
            @endif

            @if(Session::has('status'))
                $('.modal-body-ticket').empty();
                $('.modal-body-ticket').append(" {{session('status')}}");
               $('#ticketDetails').modal('show');
            @endif

            $('.my-tickets').on('click', function(){
                $('.ticket-list').show();
                $('.ticket-form').hide();
            })

            $('.log-ticket').on('click', function(){
                $('.ticket-list').hide();
                $('.ticket-form').show();
            })

            $('.prio-btn').on('click', function(){
                $('#priority').val($(this).val())
            })

            $('.edit-ticket-btn').on('click', function(){
                {{--let url = '{{ route("ticket.details", ":id") }}';--}}
                {{--url = url.replace(':id', $(this).attr('data-val'));--}}
                $.ajax({
                    url: '{{ route("ticket.details")}}',
                    type: "get", //send it through get method
                    data: {
                        ticket_id: $(this).attr('data-val'),
                    },
                    success: function(response) {
                        $('#modal-title').text(response.ticket[0].title);
                        $('.modal-body').empty()
                        $.each(response.statuses, function(index, item) {
                            $('#ticket_id').val(response.ticket[0].ticket_id);
                            $('.modal-body').append(`<div class="form-check">
                            <input class="form-check-input" type="radio" name="statusRadios" id="exampleRadios1" value="${item.id}" ${(response.ticket[0].status_id == item.id ? 'checked' : '')}>
                            <label class="form-check-label" for="exampleRadios1">${item.name}</label>
                            </div>`);
                        });
                    },
                    error: function(xhr) {
                        //Do Something to handle error
                    }
                });
            })
        });

        function filter(val){
            // let clas = $('#status-sort').val()+' '+$('#user-sort').val();

            $('.common').hide();

            if($('#user-sort').val() === '' || $('#status-sort').val() === ''){
                $('.'+val.trim()).show();
            }else{
                $('.'+$('#status-sort').val()).show();
                $('.'+$('#user-sort').val()).show();
            }

        }
    </script>
    <script src="{{asset('js/app.js')}}"></script>
</head>
<body class="d-flex flex-column min-vh-100">
{{--<nav class="navbar navbar-expand-lg navbar-dark bg-primary">--}}
{{--    <div class="container-fluid">--}}
{{--        <a class="navbar-brand" href="{{route('dashboard')}}">Navbar</a>--}}
{{--        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}
{{--        <div class="collapse navbar-collapse" id="navbarColor01">--}}
{{--            <ul class="navbar-nav me-auto">--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link active" href="{{route('dashboard')}}">Dashboard--}}
{{--                        <span class="visually-hidden">(current)</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="{{route('dashboard')}}">Schools</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="{{route('dashboard')}}">Suppliers</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <form method="POST" action="{{route('signout')}}">--}}
{{--                        @csrf--}}
{{--                        <button type="submit">--}}
{{--                            <i class="fa-solid fa-door-closed"></i>Logout--}}
{{--                        </button>--}}
{{--                    </form>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--            <form class="d-flex">--}}
{{--                <input class="form-control me-sm-2" type="search" placeholder="Search">--}}
{{--                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</nav>--}}
<main>
    {{$slot}}
</main>
<footer class="fixed mt-auto">
    <p class="text-center">Copyright &copy; {{ now()->year }}, User Listing App</p>
</footer>
</body>
</html>
