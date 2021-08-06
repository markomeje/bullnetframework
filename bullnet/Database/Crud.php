 <?php
 
declare(strict_types=1);
namespace Bullnet\Database;
use Bullnet\Interfaces\CrudInterface;


class Crud implements CrudInterface
{

    /**
     * @var array
     */
    private $crud;


    /**
     * @return void
     */
    public function __construct() 
    {}

    /**
     * @return string
     */
    public function create() : string
    {
        return $this->crud = 'INSERT';
    }

    /**
     * @return string
     */
    public function delete() : string
    {
        return $this->crud = 'DELETE';
    }

    /**
     * @return string
     */
    public function read() : string
    {
        return $this->crud = 'SELECT';
    }

    /**
     * @return string
     */
    public function update() : string
    {
        return $this->crud = 'UPDATE';
    }

}