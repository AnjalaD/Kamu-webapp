<?php

class UserModel extends Model
{
    private $_is_logged_in, $_session_name, $_cookie_name;
    public static $current_logged_user = null;
    public $id, $first_name, $last_name, $email, $password, $hash;
    public $acl, $active='0', $deleted='0';

    public function __construct($user='')
    {
        $table = 'users';
        $user_model = 'UserModel';
        parent::__construct($table,$user_model);
        $this->_session_name = CURRENT_USER_SESSION_NAME;
        $this->_cookie_name = REMEMBER_ME_COOKIE_NAME;
        $this->_soft_del = true;

        if(is_int($user))
        {
            $u = $this->_db->find_first($table,['conditions' => 'id=?', 'bind' => [$user]], 'UserModel');
        }else
        {
            $u = $this->_db->find_first($table,['conditions' => 'email=?', 'bind' => [$user]], 'UserModel');
        }

        if($u)
        {
            foreach($u as $key => $value)
            {
                $this->$key = $value;
            }
        }
    }


    public function find_by_email($email)
    {
        return $this->find_first(['conditions' => 'email=?', 'bind' => [$email]]);
    }


    public static function current_user()
    {
        if(!isset(self::$current_logged_user) && Session::exists(CURRENT_USER_SESSION_NAME))
        {
            $u = new UserModel((int)Session::get(CURRENT_USER_SESSION_NAME));
            self::$current_logged_user = $u;
        }
        return self::$current_logged_user;
    }


    public static function login_from_cookie()
    {
        $user_session = UserSession::get_from_cookie();
        if($user_session->user_id != '')
        {
            $user = new self((int)$user_session->user_id);
        }
        if($user)
        {
            $user->login();
        }
        return $user;
    }


    public function login($remember_me = false)
    {
        Session::set($this->_session_name, $this->id);
        if($remember_me)
        {
            $hash = md5(uniqid() + rand(1,100));
            $user_agent = Session::uagent_no_version();
            Cookie::set($this->_cookie_name, $hash, REMEMBER_ME_COOKIE_EXPIRY);
            $fields = ['session' => $hash, 'agent' => $user_agent, 'user_id' => $this->id];
            $this->_db->query("DELETE FROM users WHERE user_id=? AND user_agent=?", [$this->id, $user_agent]);
            $this->_db->insert('user_sessions', $fields);
        }
    }


    public function logout()
    {
        $user_session = UserSession::get_from_cookie();
        $user_session->delete();
        Session::delete(CURRENT_USER_SESSION_NAME);
        if(Cookie::exists(REMEMBER_ME_COOKIE_NAME))
        {
            Cookie::delete(REMEMBER_ME_COOKIE_NAME);
        }
        self::$current_logged_user = null;
        return true;
    }

    public function register_new_user($params){
        $this->assign($params);
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->hash = hash('md5', rand(1,100));
        $this->save();
    }

    public function acls()
    {
        if(empty($this->acl)) return [];
        return json_decode($this->acl, true);
    }

    public function validator()
    {
        $this->run_validation(new MinValidator($this, ['field'=>'username', 'rule'=>6, 'msg'=>'Username must be at least 6 characters']));
    }
} 
