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
                            <h5 class="author-card-name text-lg">{{auth()->user()->name}}</h5><span class="author-card-position">Joined {{auth()->user()->created_at->format('d F Y')}}</span>
                        </div>
                    </div>
                </div>
                <div class="wizard">
                    <nav class="list-group list-group-flush">
                        <a class="list-group-item" href="#">
                            <div class="d-flex justify-content-between align-items-center">
                                <div><i class="fa fa-tag mr-1 text-muted"></i>
                                    <div class="d-inline-block font-weight-medium text-uppercase log-ticket">Log Ticket</div>
                                </div>
{{--                                <span class="badge badge-secondary">4</span>--}}
                            </div>
                        </a>
                        <a class="list-group-item" href="#">
                            <div class="d-flex justify-content-between align-items-center">
                                <div><i class="fa fa-tag mr-1 text-muted"></i>
                                    <div class="d-inline-block font-weight-medium text-uppercase my-tickets">My Tickets</div>
                                </div><span class="badge badge-secondary">{{count($tickets)}}</span>
                            </div>
                        </a>
                    </nav>
                </div>
            </div>
            <!-- Orders Table-->
            <div class="col-lg-8 pb-5">
                <div class="table-responsive ticket-list">
                    <div class="d-flex justify-content-end pb-3">
                        <div class="form-inline">
                            <label class="text-muted mr-3" for="order-sort">Sort Orders</label>
                            <select class="form-control" id="order-sort">
                                <option>All</option>
                                <option>First Name</option>
                                <option>Last Name</option>
                                <option>Date logged</option>
                                <option>status of query</option>
                            </select>
                        </div>
                    </div>
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th>Ticket ID #</th>
                            <th>Title</th>
                            <th>Message</th>
                            <th>Priority</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <td><a class="navi-link" href="#order-details" data-toggle="modal">{{$ticket->ticket_id}}</a></td>
                                <td>{{$ticket->title}}</td>
                                <td>{{$ticket->message}}</td>
                                <td>{{$ticket->priority}}</td>
                                <td><span class="badge badge-{{($ticket->status_id == 1 ? 'danger' : ($ticket->status_id == 2 ? 'info' : 'success' ) )}} m-0">{{$ticket->status->name}}</span></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>


                <div class="ticket-form" style="display: none">
                    <form method="POST" action="{{route('store.ticket')}}">
                        @csrf

                        <div class="form-group">
                            <label for="categories">Category</label>
                            <select id="categories" name="category" class="form-control" aria-label="Default select example">
                                <option selected>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Title</label>
                            <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Message</label>
                            <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <button type="button" class="btn btn-success prio-btn" value="Low">Low</button>
                            <button type="button" class="btn btn-warning prio-btn" value="Medium">Medium</button>
                            <button type="button" class="btn btn-danger prio-btn" value="High">High</button>
                        </div>

                        <input type="hidden" name="priority" id="priority">
                        <hr>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Log Ticket</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-layout>

</body>
</html>
