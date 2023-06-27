<!DOCTYPE html>
<html>
<head>
    <title>Custom Auth in Laravel</title>
</head>
<body>
<x-navBar />
<x-layout>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container mb-4 main-container">
        <div class="row">
            <div class="col-lg-4 pb-5">
                <!-- Account Sidebar-->
                <div class="author-card pb-3">
                    <div class="author-card-cover" style="background-image: url(https://bootdey.com/img/Content/flores-amarillas-wallpaper.jpeg);"><a class="btn btn-style-1 btn-white btn-sm" href="#" data-toggle="tooltip" title="" data-original-title="You currently have 290 Reward points to spend"><i class="fa fa-award text-md"></i>&nbsp;290 points</a></div>
                    <div class="author-card-profile">
                        <div class="author-card-avatar"><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Daniel Adams">
                        </div>
                        <div class="author-card-details">
{{--                            <h5 class="author-card-name text-lg">{{auth()->user()->name}}</h5><span class="author-card-position">Joined {{auth()->user()->created_at->format('d F Y')}}</span>--}}
                        </div>
                    </div>
                </div>
                <div class="wizard">
                    <form method="POST" action="{{route('get.data')}}">
                        @csrf
                        <nav class="list-group list-group-flush">
                            <a class="list-group-item" href="#">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="fa fa-tag mr-1 text-muted"></i>
                                        <button type="submit"  class="badge badge-info m-0" data-val="animal_lovers">Animal Lovers with only 1 document linked</button>
                                    </div>
                                </div>
                            </a>
                            <a class="list-group-item" href="#">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="fa fa-tag mr-1 text-muted"></i>
                                        <button type="submit" class="badge badge-info m-0" data-val="children_sport_lovers">Children & Sport Lovers</button>
                                    </div>
                                </div>
                            </a>
                            <a class="list-group-item" href="#">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="fa fa-tag mr-1 text-muted"></i>
                                        <button type="submit" class="badge badge-info m-0" data-val="5-6-lovers">People with 5 or 6 interests</button>
                                    </div>
                                </div>
                            </a>
                        </nav>
                        <input type="hidden" name="qry" id="qry">
                    </form>

                </div>
            </div>
            <!-- Orders Table-->
            <div class="col-lg-8 pb-5">
                <div class="table-responsive ticket-list">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Surname</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($data != null)
                            @foreach($data as $dat)
                                <tr>
                                    <td>{{$dat->id}}</td>
                                    <td>{{$dat->name}}</td>
                                    <td>{{$dat->surname}}</td>
                                </tr>
                            @endforeach
                        @else
                            <small>No data found</small>
                        @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-layout>

</body>

<script>
    $(document).ready(function(){
        $('.badge').on('click', function (){
            $('#qry').val($(this).attr('data-val'));
            {{--$.ajax({--}}
            {{--    url: '{{ route("get.data")}}',--}}
            {{--    type: "post", //send it through get method--}}
            {{--    data: {--}}
            {{--        qry: $(this).attr('data-val'),--}}
            {{--    },--}}
            {{--    success: function(response) {--}}
            {{--        $('.modal-body').empty()--}}
            {{--        $.each(response, function(index, item) {--}}
            {{--            $('#ticket_id').val(response.ticket[0].ticket_id);--}}
            {{--            $('.modal-body').append(`<div class="form-check">--}}
            {{--                    <input class="form-check-input" type="radio" name="statusRadios" id="exampleRadios1" value="${item.id}" ${(response.ticket[0].status_id == item.id ? 'checked' : '')}>--}}
            {{--                    <label class="form-check-label" for="exampleRadios1">${item.name}</label>--}}
            {{--                    </div>`);--}}
            {{--        });--}}
            {{--    },--}}
            {{--    error: function(xhr) {--}}
            {{--        //Do Something to handle error--}}
            {{--    }--}}
            {{--})--}}
        })
    });
</script>
</html>
