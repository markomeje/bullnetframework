<?php declare(strict_types=1);

namespace Bullnet\Models;
use Bullnet\Core\Model;
use Bullnet\Library\{Generate, Database, Mailer};
use Respect\Validation\Validator as v;
use Ramsey\Uuid\Uuid;


class Signup extends Model {


    public function __construct() {
        parent::__construct();
    }

    public static function handle($data) {
        if (!v::email()->validate($data['email'])) {
    		return ['status' => 0, 'field' => 'email', 'info' => 'Invalid email address.'];
        }elseif (Users::find('email', $data['email']) !== false) {
            return ['status' => 0, 'field' => 'email', 'info' => 'Email already in use. Try another.'];
        }elseif (!v::notEmpty()->length(11)->validate($data['phone'])) {
            return ['status' => 0, 'field' => 'phone', 'info' => 'Invalid phone number.'];
    	}elseif (!v::notEmpty()->validate($data['password'])) {
    		return ['status' => 0, 'field' => 'password', 'info' => 'Please fill in your password.'];
    	}elseif ($data['password'] !== $data['confirmpassword']) {
            return ['status' => 0, 'field' => 'confirmpassword', 'info' => 'Passwords do not match.'];
        }

        try {
            unset($data['confirmpassword']);
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $token = Generate::string(32);
            $fields = array_merge($data, ['uuid' => Uuid::uuid4()->toString(), 'firstname' => null, 'lastname' => null, 'status' => 'inactive', 'role' => 'admin', 'token' => $token]);
            $result = Users::create($fields);
            Mailer::mail(EMAIL_VERIFICATION, $data['email'], ['token' => $token]);
            return $result > 0 ? ['status' => 1, 'info' => 'Operation Successful.', 'redirect' => DOMAIN.'/signup/thanks'] : ['status' => 0, 'info' => 'Operation failed. Try again']; 
        } catch (Exception $error) {
            Logger::log("USER SIGNUP ERROR", $error->getMessage(), __FILE__, __LINE__);
            return ['status' => 0, 'info' => 'Operation failed. Try again']; 
        }

    }

}