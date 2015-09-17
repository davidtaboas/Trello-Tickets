<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


use Trello\Client;
class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    protected $api_key    = "5a74c1310f7d58fd4daf07a6df84b25d";
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $api;
    protected $token = "";

    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.
        $this->api = new \Trello\Client();
        $this->token = $attributes["token"];
        $this->api->authenticate($this->api_key, $this->token, Client::AUTH_URL_CLIENT_ID);
    }

    public function setToken($input){
        $this->token = $input;
    }

    public function auth(){

    }

    public function get_boards(){
        $params = array('filter' => 'open' );
        $token = $this->token;
        $boards = $this->api->members()->boards()->all('me', $params);
        return $boards;
    }

    public function get_lists($idBoard){
        $params = array('cards' => 'open',
                        'card_fields' => 'name');
        return $this->api()->boards()->lists()->all($idBoard, $params);
    }

    public function create_card($params){

        $response = $this->api()->cards()->create($params);
        return $response;
    }

    public function get_card($id){
        return $this->api()->cards()->show($id);
    }
    /**
     * Function for get api variable
     * @return $api
     *
     */
    public function api(){
        return $this->api;
    }

    /**
     * Function for return all members from board
     * @return array
     */
    public function get_members_board($idBoard){
        return $this->api->boards()->members()->all($idBoard);
    }


}
