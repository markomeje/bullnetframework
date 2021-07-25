<?php

namespace Bullnet\Library;
use Bullnet\Core\Logger;
use Bullnet\Library\Database;
use \Exception;


class Pagination {
    
    /**
     * Used to track the current page
     * @var int
     */
	public $currentPage;

    /**
     * The number of items that is displayed on a page
     * @var int
     */ 
    public $itemsPerPage;

    /**
     * The total count of data to be paginated
     * @var int
     */
    public $totalCount;


	public function __construct($currentPage = 1, $totalCount = 0, $itemsPerPage = 0) {
		$this->currentPage = empty($currentPage) ? 1 : (int)$currentPage;
		$this->totalCount = empty($totalCount) ? 0 : (int)$totalCount;
        $this->itemsPerPage = empty($itemsPerPage) ? PAGINATION_DEFAULT_LIMIT : (int)$itemsPerPage;
	}

	public static function paginate($sql, $fields = [], $pageNumber, $itemsPerPage, $extraOffset = 0) {
        try {
            $database = Database::connect();
            $database->query($sql, $fields);
            $totalCount = ($database->rowCount() > 0) ? $database->rowCount() : 0;
            $extraOffset = (int)$extraOffset > $totalCount ? 0 : (int)$extraOffset;
            return new Pagination((int)$pageNumber, ($totalCount - $extraOffset), $itemsPerPage);
        } catch (Exception $error) {
            Logger::log('GETTING PAGINATION DATA ERROR', $error->getMessage(), __FILE__, $error->getLine());
            return false;
        }
    }

	public function getOffset() {
        return ($this->currentPage - 1) * $this->itemsPerPage;
    }

    public function totalPages() {
        return ceil($this->totalCount/$this->itemsPerPage);
    }

    public function previousPage() {
        return $this->currentPage - 1;
    }

    public function nextPage() {
        return $this->currentPage + 1;
    }

    public function hasPreviousPage() {
        return $this->previousPage() >= 1 ? true : false;
    }

    public function hasNextPage() {
        return $this->totalPages() >= $this->nextPage() ? true : false;
    }

}
