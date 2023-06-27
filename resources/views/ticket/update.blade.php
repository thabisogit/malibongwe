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
                <div class="table-responsive ticket-list">
                    <div class="d-flex justify-content-end pb-3">
                        <div class="form-inline">
                            <small><a href="{{route('edit.ticket')}}" class="text-muted mr-3" for="order-sort">Clear Filters</a></small>
                            <select class="form-control status-sort" onchange="filter(this.value)" id="status-sort">
                                <option value="">Filter By Status</option>
                                @foreach($statuses as $status)
                                    <option value="{{str_replace(' ', '', $status->name)}}">{{$status->name}}</option>
                                @endforeach
                            </select>

                            <select class="form-control ml-3" id="user-sort" onchange="filter(this.value)">
                                <option value="">Filter By User</option>
                                @foreach($users as $user)
                                    <option>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th>Ticket ID #</th>
                            <th>First Name</th>
                            <th>Title</th>
                            <th>Message</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets as $ticket)
                            @php
                                $class = str_replace(' ', '',$ticket->status->name).' '.$ticket->user->name;
                            @endphp
                            <tr>
                                <td class="common {{$class}}"><a class="navi-link" href="#order-details" data-toggle="modal">{{$ticket->ticket_id}}</a></td>
                                <td class="common {{$class}}">{{$ticket->user->name}}</td>
                                <td class="common {{$class}}">{{$ticket->title}}</td>
                                <td class="common {{$class}}">{{$ticket->message}}</td>
                                <td class="common {{$class}}">{{$ticket->priority}}</td>
                                <td class="common {{$class}}"><span class="badge badge-{{($ticket->status_id == 1 ? 'danger' : ($ticket->status_id == 2 ? 'info' : 'success' ) )}} m-0">{{$ticket->status->name}}</span></td>
                                <td class="common {{$class}}"><button type="button" data-val="{{$ticket->ticket_id}}" class="btn btn-primary badge badge-info edit-ticket-btn" data-toggle="modal" data-target="#ticketModal">Update status</button></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {!! $tickets->links() !!}
                </div>

            </div>


        <!-- Modal -->
        <div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" action="{{route('update.ticket')}}">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Modal title</h5>
                            <input type="hidden" id="ticket_id" name="ticket_id">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Status</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
{{--        modal end--}}
        </div>
    </div>
</x-layout>

</body>
</html>
