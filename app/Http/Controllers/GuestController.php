<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    public function index()
    {
        return view('guest.ticket');
    }

    public function getTicketDetails(Request $request){
        $ticket_status = Ticket::where('ticket_id',$request->ticket_number)->first();
        if($ticket_status){
            return redirect('ticket-status')->with('status',"Your ticket is currently ".$ticket_status->status->name);
        }
        return redirect('ticket-status')->with('status',"Ticket not found!");
    }


    public function queryTask()
    {
        return view('guest.queryTask',['data'=>null]);
    }

    public function fileTask()
    {
        return view('guest.fileTask',['data'=>null]);
    }

    public function getData(Request $request){
        if($request->qry == 'animal_lovers'){
            $data = DB::select("SELECT *  FROM personal_details
                                        WHERE id IN(
                                        SELECT user_id
                                            FROM interests
                                            WHERE id in(
                                            SELECT mt.interest_id
                                                FROM (
                                            SELECT count(interest_id) AS intr, interest_id
                                                FROM documents WHERE interest_id in(
                                            SELECT id
                                                FROM interests WHERE name = 'Animals')
                                        GROUP BY interest_id) mt
                                        WHERE mt.intr = 1)
                                        )");
        }elseif ($request->qry == 'children_sport_lovers'){
            $data = DB::select("SELECT * FROM personal_details
                                        WHERE id IN(
                                            SELECT user_id
                                                FROM interests
                                            WHERE name IN('Children','Sport'))");
        }else{
            $data = DB::select("SELECT * FROM personal_details
                                        WHERE id IN(
                                            SELECT user_id
                                                FROM interests
                                                WHERE id IN(
                                                    SELECT DISTINCT(interest_id)
                                                    FROM documents WHERE interest_id IN(
                                                        SELECT id interest_id
                                                        FROM interests
                                                        WHERE user_id IN(
                                                            SELECT mt.id
                                                            FROM (
                                                                SELECT pd.id, count(ints.user_id) u_cnt
                                                                FROM personal_details pd, interests ints
                                                        WHERE
                                                        ints.user_id = pd.id
                                                        GROUP BY ints.user_id,pd.id)mt
                                                    WHERE mt.u_cnt IN(5,6)
                                                    )
                                                )
                                            )
                                        )");
        }

        return view('guest.queryTask',['data'=>$data]);
    }
}
