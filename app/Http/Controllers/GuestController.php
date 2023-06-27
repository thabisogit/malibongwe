<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Ticket;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        return view('guest.ticket');
    }

    public function getTicketDetails(Request $request){
//        dd($request->ticket_number);
        $ticket_status = Ticket::where('ticket_id',$request->ticket_number)->first();
        if($ticket_status){
            return redirect('ticket-status')->with('status',"Your ticket is currently ".$ticket_status->status->name);
        }
        return redirect('ticket-status')->with('status',"Ticket not found!");
    }
}
