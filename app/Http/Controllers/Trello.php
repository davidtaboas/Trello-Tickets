<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use GuzzleHttp\Client;

class Trello extends Controller
{

    protected $user;
    protected $token;

    public function __construct(Request $request)
    {

        $user = $request->session()->get('user');
        $token = $request->session()->get('token');
        $this->user = new \App\User(array("token"=>$token));


    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $boards = $this->user->get_boards();
        return view('trello.index',
                    [
                    "boards" => $boards
                    ] );
    }

    public function userBoard($idBoard){

        $lists = $this->user->get_lists($idBoard);

        $projects = head(array_where($lists, array($this,"filter_list_projects")));


        $backlog = head(array_where($lists,array($this,"filter_list_backlog")));

        $topics  = $projects["cards"];


        $members = $this->user->get_members_board($idBoard);


        return view('trello.board', [
                    'topics' => $topics,
                    'members' => $members,
                    'backlog' => $backlog["id"]
                    ]);
    }

    public function setToken(Request $request){
        $request->session()->flush();
        $request->session()->put('token', $request->input('token'));
        $this->token = $request->input('token');
        return redirect('trello');


    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {

    }

    public function createNewTicket(Request $request){
        //
        $params = array(
                        'name' => "[{$request->input('topic')}] {$request->input('title')}",
                        'desc' => $request->input('description'),
                        'idMembers' => $request->input('member'),
                        'labels' => '',
                        'idList' => $request->input('backlog'),
                        'pos' => $request->input('priority'), // top, bottom, or a positive number.
                        'suscribed' => true
                         );

        $response = $this->user->create_card($params);

        if($response){
            return redirect()->action('Trello@showTicket', $response["id"]);
        }
        else
            return "Invalid Data";
    }

    public function showTicket($id){

        $response = $this->user->get_card($id);
        return view('trello.newticket',[
                    "ticketTitle" => $response["name"],
                    "ticketURL" => $response["shortUrl"]
                    ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function filter_list_projects($key,$value){

      if($value["name"] == "Projects")
        return true;
      else
        return false;
    }

    public function filter_list_backlog($key,$value){

      if($value["name"] == "Backlog")
        return true;
      else
        return false;
    }
}
