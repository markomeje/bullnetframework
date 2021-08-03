<?php

namespace Bullnet\Models;
use Bullnet\Core\{Model, Logger};
use Bullnet\Library\{Database, Generate, Mailer};
use Respect\Validation\Validator as v;
use Bullnet\Models\Users;
use \Exception;


class Password extends Model {

    /**
     * @var string
     */
	private static $table = 'password';
    
    /**
     * @var int
     */
	public static $tokenlength = 12;

	public function __construct() {
		parent::__construct();
	}

	public static function process($post) {
		if (!v::notEmpty()->length(3, 255)->validate($post['processemail'])) {
			return ['status' => 0, 'field' => 'processemail', 'info' => 'Enter your account email.'];
		}

		try {
			self::delete($post['processemail']);
			$user = Users::find('email', $post['processemail']);
			$userid = empty($user->id) ? 0 : $user->id;
			$database = Database::connect();
			$table = self::$table;
			$token = Generate::string(self::$tokenlength);
			$fields = array_merge($post, ['status' => 'pending', 'token' => $token, 'timestamp' => time(), 'expiry' => PASSWORD_RESET_TOKEN_EXPIRY, 'userid' => $userid]);
			$database->query("INSERT INTO {$table} (processemail, token, status, expiry, timestamp, userid) VALUES(:processemail, :token, :status, :expiry, :timestamp, :userid)", $fields);

			Mailer::mail(PASSWORD_RESET, $post['processemail'], ['token' => $token, 'user' => $userid]);
			return ($database->rowCount() > 0) ? ['status' => 1, 'info' => 'A password reset token has been sent to your email.', 'redirect' => DOMAIN.'/password/reset'] : ['status' => 0, 'info' => 'Operation failed. Try again.'];
		} catch (Exception $error) {
			Logger::log("SENDING PASSWORD RESET LINK ERROR", $error->getMessage(), __FILE__, __LINE__);
			return ['status' => 0, 'info' => 'Operation failed. Try again.'];
		}
	}

	public static function reset($data) {
		$result = self::verify($data['token']);
		if (empty($result) || false === $result) {
			return ['status' => 0, 'field' => 'token', 'info' => 'Invalid reset token.'];
		}elseif (isset($result->expiry) && ($result->timestamp + PASSWORD_RESET_TOKEN_EXPIRY) < time()) {
			return ['status' => 0, 'field' => 'token', 'info' => 'Expired reset token.'];
		}elseif (!v::notEmpty()->validate($data['password'])) {
    		return ['status' => 0, 'field' => 'password', 'info' => 'Please fill in your password.'];
    	}elseif ($data['password'] !== $data['confirmpassword']) {
            return ['status' => 0, 'field' => 'confirmpassword', 'info' => 'Passwords do not match.'];
        }
        
        try {
			$updated = Users::updatepassword(['password' => password_hash($data['password'], PASSWORD_DEFAULT), 'id' => $result->userid]);
			if($updated !== false) {
				self::delete($result->processemail);
				return ['status' => 1, 'info' => 'Password reset successful', 'redirect' => DOMAIN.'/login'];
			}else {
				return ['status' => 0, 'info' => 'Operation failed. Try again'];
			}
		} catch (Exception $error) {
			Logger::log("RESETING USER PASSWORD ERROR", $error->getMessage(), __FILE__, __LINE__);
			return ['status' => 0, 'info' => 'Operation failed. Try again'];
		}
	}

	public static function delete($processemail) {
		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("DELETE FROM {$table} WHERE processemail = :processemail", ['processemail' => $processemail]);
            return $database->rowCount() > 0;
		} catch (Exception $error) {
			Logger::log("DELETING PASSWORD RESET DATA ERROR", $error->getMessage(), __FILE__, __LINE__);
			return false;
		}
	}

	public static function verify($token) {
		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("SELECT {$table}.* FROM {$table}, users WHERE users.id = {$table}.userid AND users.email = {$table}.processemail AND {$table}.token = :token LIMIT 1", ['token' => $token]);
            return $database->fetch();
		} catch (Exception $error) {
			Logger::log("VERIFYING PASSWORD RESET DATA ERROR", $error->getMessage(), __FILE__, __LINE__);
			return false;
		}
	}

}