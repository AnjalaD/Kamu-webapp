<?php
namespace app\models;
use core\Model;
use core\validators\MaxValidator;
use core\validators\RequiredValidator;
use core\validators\EmailValidator;
use core\validators\UniqueValidator;
use core\validators\MatchValidator;
use core\validators\MinValidator;
use app\models\UserSessionModel;
use core\Session;
use core\Cookie;
use core\H;

abstract class UserModel extends Model
{
    protected $_is_logged_in, $_session_id, $_session_type, $_cookie_name, $_confirm;
    public static $current_logged_user = null;
    public $first_name, $last_name, $email, $password, $hash;
    public $verified='0', $deleted='0';

    public function __construct($table,$user_model)
    {
        parent::__construct($table,$user_model);
        $this->_session_id = CURRENT_USER_SESSION_ID;
        $this->_session_type = CURRENT_USER_SESSION_TYPE;
        $this->_cookie_name = REMEMBER_ME_COOKIE_NAME;
        $this->_soft_del = true;
    }

    
    public function find_by_email($email)
    {
        return $this->find_first(['conditions' => 'email=?', 'bind' => [$email]]);
    }


    public static function current_user()
    {
        if(!isset(self::$current_logged_user) && Session::exists(CURRENT_USER_SESSION_ID) && Session::exists(CURRENT_USER_SESSION_TYPE))
        {
            $model = 'app\models\\' . Session::get(CURRENT_USER_SESSION_TYPE);
            $u = new $model((int)Session::get(CURRENT_USER_SESSION_ID));
            
            self::$current_logged_user = $u;
            // H::dnd(self::$current_logged_user);
        }
        return self::$current_logged_user;
    }


    public static function login_from_cookie()
    {
        $user_session = UserSessionModel::get_from_cookie();
        if($user_session && $user_session->user_id != '')
        {
            $model = 'app\models\\' . $user_session->user_type;
            $user = new $model((int)$user_session->user_id);
            if($user)
            {
                $user->login();
            }
            return $user;
        }
        return false;
        
    }

    public static function send_password_reset_link($type, $user)
    {
        $to = $user->email;
        $subject = 'Account Verification' ;
        $message_body = '
        Hello '.$user->first_name.',
        Please click this link to reset your password:'
        .WEB_ADDRESS.'register/reset_password/'.$type.'/'.$to.'/'.$user->hash;
        mail($to, $subject, $message_body);
    }

    public function send_verify_email(){}

    public function verify_email($user, $type)
    {
        $to = $user->email;
        $subject = 'Account Verification' ;
        $message_body = '
        Hello '.$user->first_name.',
        Thank you for signing up.
        Please click this link to activate your account:'
        .WEB_ADDRESS.'register/verify/'.$type.'/'.$to.'/'.$user->hash;
        mail($to, $subject, $message_body);
    }


    public function login($remember_me = false)
    {
        Session::set($this->_session_id, $this->id);
        Session::set($this->_session_type, $this->_model_name);
        if($remember_me)
        {
            $hash = md5(uniqid() + rand(1,100));
            $user_agent = Session::uagent_no_version();
            Cookie::set($this->_cookie_name, $hash, REMEMBER_ME_COOKIE_EXPIRY);
            $fields = ['session' => $hash, 'user_agent' => $user_agent, 'user_id' => $this->id, 'user_type' => $this->_model_name];
            $this->_db->query("DELETE FROM users WHERE user_id=? AND user_agent=?", [$this->id, $user_agent]);
            $this->_db->insert('user_sessions', $fields);
        }
    }


    public function logout()
    {
        $user_session = UserSessionModel::get_from_cookie();
        $user_session->delete();
        Session::delete(CURRENT_USER_SESSION_ID);
        Session::delete(CURRENT_USER_SESSION_TYPE);
        Session::delete('items');
        if(Cookie::exists(REMEMBER_ME_COOKIE_NAME))
        {
            Cookie::delete(REMEMBER_ME_COOKIE_NAME);
        }
        self::$current_logged_user = null;
        return true;
    }

    public function acls()
    {
        return [];
    }

    public function validator()
    {
        // H::dnd($this->_confirm);
        $this->run_validation(new MinValidator($this, ['field'=>'password', 'rule'=>3, 'msg'=>'Password must be at least 3 characters']));
        $this->run_validation(new MaxValidator($this, ['field'=>'first_name', 'rule'=>50, 'msg'=>'First Name must be maximum of 50 characters']));
        $this->run_validation(new MaxValidator($this, ['field'=>'last_name', 'rule'=>50, 'msg'=>'Last Name must be maximum of 50 characters']));
        $this->run_validation(new MaxValidator($this, ['field'=>'email', 'rule'=>100, 'msg'=>'Email must be maximum of 100 characters']));

        $this->run_validation(new RequiredValidator($this, ['field'=>'first_name', 'rule'=>true, 'msg'=>'First Name is required!']));
        $this->run_validation(new RequiredValidator($this, ['field'=>'last_name', 'rule'=>true, 'msg'=>'Last Name is required!']));
        $this->run_validation(new RequiredValidator($this, ['field'=>'email', 'rule'=>true, 'msg'=>'Email is required!']));
        $this->run_validation(new RequiredValidator($this, ['field'=>'password', 'rule'=>true, 'msg'=>'Password is required!']));

        $this->run_validation(new EmailValidator($this, ['field'=>'email', 'rule'=>true, 'msg'=>'Please enter a valid email!']));

        $this->run_validation(new UniqueValidator($this, ['field'=>'email', 'rule'=>true, 'msg'=>'Email already used!']));
    
        if($this->is_new())
        {
            $this->run_validation(new MatchValidator($this, ['field'=>'password', 'rule'=>$this->_confirm, 'msg'=>'Password and Confirm Password should match!']));

        }
    }

    
    public function login_validator()
    {
        $this->run_validation(new EmailValidator($this, ['field'=>'email', 'rule'=>true, 'msg'=>'Please enter a valid email!']));
        $this->run_validation(new RequiredValidator($this, ['field'=>'email', 'rule'=>true, 'msg'=>'Email is required!']));
        $this->run_validation(new RequiredValidator($this, ['field'=>'password', 'rule'=>true, 'msg'=>'Password is required!']));
    }

    public function before_save()
    {
        $this->hash = hash('md5', rand(0,100));
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function set_confirm($value){
        $this->_confirm = $value;
    }

    public function get_confirm(){
        return $this->_confirm;
    }

} 
