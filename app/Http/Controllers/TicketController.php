<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Models\Category;
use App\Models\Status;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('customAuth');
    }

    public function createTicket()
    {
        $tickets = Ticket::where('user_id',Auth::user()->id)->get();
        $categories = Category::all();
        return view('ticket.create',['tickets'=>$tickets,'categories'=>$categories]);
    }

    public function storeTicket(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required',
            'priority' => 'required',
            'category' => 'required',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("create-ticket")->with('message','Ticket logged Successfully!');
    }

    public function create(array $data)
    {
        $ip_data = request()->ip();
        $location = geoip($ip = $ip_data);

        return Ticket::create([
            'title' => $data['title'],
            'message' => $data['message'],
            'ticket_id' => Str::random(8),
            'priority' => $data['priority'],
            'category_id' => $data['category'],
            'user_id' => Auth::user()->id,
            'status_id' => 1,
            'latitude' => $location->lat,
            'longitude' => $location->lon,
        ]);
    }

    public function editTicket(){
        $tickets = Ticket::paginate(10);
        $status = Status::all();
        $users = DB::select('select name from users where id in(select distinct user_id from tickets)');
        return view('ticket.update',['tickets'=>$tickets,'statuses'=>$status,'users'=>$users]);
    }

    public function updateTicket(Request $request, Mail $mail){
        $is_updated = Ticket::where('ticket_id',$request->ticket_id)
                            ->update(['status_id'=>$request->statusRadios]);


        if($is_updated){
            $user_email = Ticket::where('ticket_id',$request->ticket_id)->first()->user->email;

            $details= ['email'=>$user_email, 'link'=>(isset($_SERVER['HTTPS']) ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].'/ticket-status'];

            dispatch(new SendEmailJob($details));

            return redirect(route('edit.ticket'))->with('message','Ticket Updated Successfully');
        }

    }

    public function getTicketDetails(Request $request){
        return [
            'ticket'=>Ticket::where('ticket_id',$request->ticket_id)->get(),
            'statuses' => Status::all()
        ];
    }
}
