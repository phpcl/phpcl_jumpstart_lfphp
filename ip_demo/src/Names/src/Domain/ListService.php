<?php
declare(strict_types=1);
namespace Names\Domain;
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\TableGateway\TableGateway;

class ListService
{
	 const USERS_TABLE_NAME = 'users';
    /**
     * @var Adapter
     */
    protected $adapter;
	/**
	 * @var TableGateway
	 */
	protected $usersTable;
	/**
	 * @param Adapter $adapter
	 * @param TableGateway $table
	 */
    public function __construct(Adapter $adapter)
    {
        $this->adapter    = $adapter;
        $this->usersTable = new TableGateway(self::USERS_TABLE_NAME, $adapter);
    }
	/**
	 * Returns JSON response with list of first and last names
	 *
	 * @return string $json
	 */
    public function getNames()
    {
		$list = [];
		$result = $this->usersTable->select();
		foreach ($result as $row) {
			$list[] = [
				$row->last_name,
				$row->first_name,
			];
		}
		return $list;
    }
}
