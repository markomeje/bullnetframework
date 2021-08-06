 <?php

declare(strict_types=1);
namespace Bullnet\Interfaces;


Interface CrudInterface
{

    /**
     * @return string
     */
    public function create() : string;

    /**
     * @return string
     */
    public function delete() : string;

    /**
     * @return string
     */
    public function read() : string;

    /**
     * @return string
     */
    public function update() : string;

}