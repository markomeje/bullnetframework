<?php declare(strict_types=1);

namespace Bullnet\Models;
use Bullnet\Core\{Model, Logger};
use Bullnet\Http\{Cookie};
use Bullnet\Library\{Generate, Database, Authentication, Session, Authenticated};
use Respect\Validation\Validator as v;
use \Exception;


class Login extends Model 
{
    
    /**
     * @var string
     */
    private static $table = 'login';
    
    /**
     * @param $table [string]
     * @return void
     */
    public function __construct($table) : void
    {
        self::$table = $table
        parent::__construct($table);
    }


    public static function handle($post) 
    {
        if (!v::email()->validate($post['email'])) {
            return ['status' => 0, 'field' => 'email', 'info' => 'Please fill in your email.'];
        }elseif (!v::notEmpty()->validate($post['password'])) {
            return ['status' => 0, 'field' => 'password', 'info' => 'Please fill in your password'];
        }

        try {
            $user = Users::find('email', $post['email']);
            if (empty($user) || !password_verify($post['password'], $user->password)) {
                return ['status' => 0, 'info' => 'Invalid Login Details.'];
            }elseif (strtolower($user->status) !== 'active') {
                return ['status' => 0, 'info' => 'Your email is not verified. Please use the link sent to your email during registration to verify your email.'];
            }
            
            $token = Generate::string(64);
            Authentication::authenticate(['id' => $user->id, 'uuid' => $user->uuid, 'role' => $user->role, 'status' => true, 'token' => $token, 'iat' => time()]);
            if(!empty($post['rememberme']) && $post['rememberme'] === 'on') {
                Rememberme::log(Authenticated::user()->id);
            }

            $database = Database::connect();
            $table = self::$table;
            $database->query("INSERT INTO {$table} (userid, token) VALUES(:userid, :token)", ['userid' => $user->id, 'token' => $token]);
            Activity::log(['browser' => getallheaders()['User-Agent'], 'ip' => '127.0.0.1', 'timestamp' => time(), 'userid' => $user->id, 'type' => 'login']);
            return ['status' => 1, 'info' => 'Operation Successful.', 'redirect' => '']; 
        } catch (Exception $error) {
            Logger::log("USER SIGNIN ERROR", $error->getMessage(), __FILE__, __LINE__);
            return ['status' => 0, 'info' => 'Operation Failed. Try again.']; 
        }
    }

    public static function logout() 
    {
        try {
            $database = Database::connect();
            $table = self::$table;
            $database->query("DELETE FROM {$table} WHERE userid = :userid", ['userid' => Authenticated::user()->id]);
            Rememberme::remove(Authenticated::user()->id);
            Authentication::unauthenticate();
            return ['status' => 1, 'redirect' => DOMAIN.'/login']; 
        } catch (Exception $error) {
            Logger::log("USER LOGOUT ERROR", $error->getMessage(), __FILE__, __LINE__);
            return ['status' => 0, 'info' => 'Operation Failed.']; 
        }
    }

    public static function remember() : bool
    {
        try {
            $rememberme = Rememberme::find(Cookie::get(REMEMBER_ME_COOKIE_NAME));
            $remembered = empty($rememberme->user) ? 0 : $rememberme->user;
            $user = Users::find('id', $remembered);
            if($user === false || empty($user)) return;
            Activity::log(['browser' => getallheaders()['User-Agent'], 'ip' => '127.0.0.1', 'timestamp' => time(), 'userid' => $user->id, 'type' => 'rememberme']);
            Authentication::authenticate(['id' => $user->id, 'uuid' => $user->uuid, 'role' => $user->role, 'status' => true, 'token' => Generate::string(32), 'iat' => time()]);
            Rememberme::log(Authenticated::user()->id);
            return true;
        } catch (Exception $error) {
            Logger::log("LOGIN FROM REMEMBER ME COOKIE ERROR", $error->getMessage(), __FILE__, __LINE__);
            return false; 
        }
    }

}