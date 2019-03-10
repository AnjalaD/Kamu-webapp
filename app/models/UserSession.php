<?php
namespace app\models;
use core\Model;
use core\Session;
use core\Cookie;
class UserSession extends Model
{
    public $id, $user_id, $session, $agent;

    public function __construct()
    {
        $table = 'user_sessions';
        $model_name = 'UserSession';
        parent::__construct($table, $model_name);
    }

    public static function get_from_cookie()
    {
        $user_session = new self();

        if(Cookie::exists(REMEMBER_ME_COOKIE_NAME))
        {
            $user_session = $user_session->find_first([
                'conditions' => "agent=? AND session=?",
                'bind' => [Session::uagent_no_version(), Cookie::get(REMEMBER_ME_COOKIE_NAME)]
            ]);
        }
        return $user_session;
    }
}