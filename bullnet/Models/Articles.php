<?php

namespace Bullnet\Models;
use Bullnet\Core\{Model, Logger};
use Bullnet\Library\{Validate, Database, Image, Pagination};
use Respect\Validation\Validator as v;
use \Exception;


class Articles extends Model {

    /**
     * @var string
     */
	private static $table = 'articles';
    
    /**
     * @var array
     */
	public static $statuses = ['published', 'unpublished'];

	public function __construct() {
		parent::__construct();
	}

	public static function create($data) {
		if (!v::notEmpty()->validate($data['title'])) {
			return ['status' => 0, 'field' => 'title', 'info' => 'Please post title is required.'];
		}elseif (self::exists($data['title']) !== false) {
			return ['status' => 0, 'field' => 'title', 'info' => 'Post with this title already exists'];
		}elseif (!v::notEmpty()->validate($data['category'])) {
			return ['status' => 0, 'field' => 'category', 'info' => 'Please select category'];
		}elseif (!v::notEmpty()->length(3, 255)->validate($data['author'])) {
			return ['status' => 0, 'field' => 'author', 'info' => 'Author\'s name must be between 3 - 255 characters'];
		}elseif (!v::notEmpty()->validate($data['status'])) {
			return ['status' => 0, 'field' => 'status', 'info' => 'Please select status'];
		}elseif (!v::notEmpty()->validate($data['content'])) {
			return ['status' => 0, 'field' => 'content', 'info' => 'Please enter content'];
		}

		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("INSERT INTO {$table} (title, category, author, content, status) VALUES(:title, :category, :author, :content, :status)", $data);
			return ($database->rowCount() > 0) ? ['status' => 1, 'info' => 'Post Added Successfully', 'redirect' => DOMAIN.'/articles'] : ['status' => 0, 'info' => 'Operation failed. Try again.'];
		} catch (Exception $error) {
			Logger::log("ADDING POST ERROR", $error->getMessage(), __FILE__, __LINE__);
			return ['status' => 0, 'info' => 'Operation failed'];
		}
	}

	public static function exists($title) {
		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("SELECT * FROM {$table} WHERE title = :title LIMIT 1", ['title' => $title]);
            return $database->fetch();
		} catch (Exception $error) {
			Logger::log("POST TITLE ALREADY EXISTS ERROR", $error->getMessage(), __FILE__, __LINE__);
			return false;
		}
	}

	public static function all($pageNumber = 0) {
		try {
			$database = Database::connect();
			$table = self::$table;
			$pagination = Pagination::paginate("SELECT * FROM {$table}", [], $pageNumber, 6);
			$offset = $pagination->getOffset();
		    $limit = $pagination->itemsPerPage;
			$database->query("SELECT {$table}.*, categories.name as categoryname FROM {$table}, categories WHERE categories.id = {$table}.category ORDER BY date DESC LIMIT {$limit} OFFSET {$offset}");
            return (object)['all' => $database->fetchAll(), 'pagination' => $pagination];
		} catch (Exception $error) {
			Logger::log("GETTING ALL Articles ERROR", $error->getMessage(), __FILE__, __LINE__);
			return false;
		}
	}

	public static function published($pageNumber = 0, $itemsPerPage = 4) {
		try {
			$database = Database::connect();
			$table = self::$table;
			$field = ['status' => 'published'];
			$pagination = Pagination::paginate("SELECT * FROM {$table} WHERE status = :status", $field, $pageNumber, $itemsPerPage);
			$offset = $pagination->getOffset();
		    $limit = $pagination->itemsPerPage;
			$database->query("SELECT {$table}.*, categories.name as categoryname FROM {$table}, categories WHERE categories.id = {$table}.category AND status = :status ORDER BY date DESC LIMIT {$limit} OFFSET {$offset}", $field);
            return (object)['all' => $database->fetchAll(), 'pagination' => $pagination];
		} catch (Exception $error) {
			Logger::log("GETTING ALL Articles ERROR", $error->getMessage(), __FILE__, __LINE__);
			return false;
		}
	}

	public static function edit($data) {
		if (!v::notEmpty()->validate($data['title'])) {
			return ['status' => 0, 'field' => 'title', 'info' => 'Please post title is required.'];
		}elseif (!v::notEmpty()->validate($data['category'])) {
			return ['status' => 0, 'field' => 'category', 'info' => 'Please select category'];
		}elseif (!v::notEmpty()->length(3, 255)->validate($data['author'])) {
			return ['status' => 0, 'field' => 'author', 'info' => 'Author\'s name must be between 3 - 255 characters'];
		}elseif (!v::notEmpty()->validate($data['status'])) {
			return ['status' => 0, 'field' => 'status', 'info' => 'Please select status'];
		}elseif (!v::notEmpty()->length(100)->validate($data['content'])) {
			return ['status' => 0, 'field' => 'content', 'info' => 'Please enter content'];
		}

		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("UPDATE {$table} SET title = :title, category = :category, author = :author, content = :content, status = :status WHERE id = :id LIMIT 1", $data);
			return ($database->rowCount() > 0) ? ['status' => 1, 'info' => 'Post Updated Successfully', 'redirect' => DOMAIN.'/articles'] : ['status' => 0, 'info' => 'Operation Failed. Try Again.'];
		} catch (Exception $error) {
			Logger::log("EDITING POST ERROR", $error->getMessage(), __FILE__, __LINE__);
			return ['status' => 0, 'info' => 'Operation failed. Try again'];
		}
	}

	public static function delete($id) {
		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("DELETE FROM {$table} WHERE id = :id LIMIT 1", ['id' => $id]);
            return ($database->rowCount() > 0) ? ['status' => 1, 'info' => 'Post deleted'] : ['status' => 0, 'info' => 'Operation failed. Try again.'];
		} catch (Exception $error) {
			Logger::log("DELETING CATEGORY ERROR", $error->getMessage(), __FILE__, __LINE__);
			return ['status' => 0, 'info' => 'Operation failed'];
		}
	}

	public static function find($id) {
		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("SELECT * FROM {$table} WHERE id = :id LIMIT 1", ['id' => $id]);
            return $database->fetch();
		} catch (Exception $error) {
			Logger::log("FINDING ARTICLE BY ID ERROR", $error->getMessage(), __FILE__, __LINE__);
			return false;
		}
	}

	public static function category($category, $pageNumber = 0, $itemsPerPage = 4) {
		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("SELECT {$table}.*, categories.name AS categoryname FROM {$table}, categories WHERE category = :category AND categories.id = {$table}.category ORDER BY date DESC", ['category' => $category]);
            return (object)['all' => $database->fetchAll()];
		} catch (Exception $error) {
			Logger::log("FINDING ARTICLE BY CATEGORY ERROR", $error->getMessage(), __FILE__, __LINE__);
			return false;
		}
	}

	public static function upload($data) {
		$image = (new Image($data['image'], PUBLIC_PATH . DS . 'images' . DS . 'articles'))->upload();
		if ($image === false) return ['status' => 0, 'info' => 'Image upload error. Only JPG, PNG, GIF formats allowed. Image size must be less than 1MB'];

		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("UPDATE {$table} SET image = :image WHERE id = :id LIMIT 1", ['image' => $image->filename, 'id' => $data['id']]);
			return ($database->rowCount() > 0) ? ['status' => 1, 'info' => 'Post updated'] : ['status' => 0, 'info' => 'Operation Failed. Try Again.'];
		} catch (Exception $error) {
			Logger::log("UPLOADING POST IMAGE ERROR", $error->getMessage(), __FILE__, __LINE__);
			return ['status' => 0, 'info' => 'Operation Failed. Try Again'];
		}
	}

}