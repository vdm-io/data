<?php
/**
 * @package    vdm/data
 *
 * @created    4th September, 2022
 * @author     Llewellyn van der Merwe <https://dev.vdm.io>
 * @git        VDM Data Library <https://git.vdm.dev/joomla/vdm-data>
 * @copyright  Copyright (C) 2015 Vast Development Method. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace VastDevelopmentMethod\Joomla\Data\Action;


use VastDevelopmentMethod\Joomla\Interfaces\DeleteInterface as Database;
use VastDevelopmentMethod\Joomla\Interfaces\Data\DeleteInterface;


/**
 * Data Delete
 * 
 * @since 3.2.2
 */
class Delete implements DeleteInterface
{
	/**
	 * The Delete Class.
	 *
	 * @var   Database
	 * @since 3.2.2
	 */
	protected Database $database;

	/**
	 * Table Name
	 *
	 * @var    string
	 * @since 3.2.2
	 */
	protected string $table;

	/**
	 * Constructor.
	 *
	 * @param Database   $database   The Delete Class.
	 * @param string|null $table       The table name.
	 *
	 * @since 3.2.2
	 */
	public function __construct(Database $database, ?string $table = null)
	{
		$this->database = $database;
		if ($table !== null)
		{
			$this->table = $table;
		}
	}

	/**
	 * Set the current active table
	 *
	 * @param string|null $table The table that should be active
	 *
	 * @return self
	 * @since 3.2.2
	 */
	public function table(?string $table): self
	{
		if ($table !== null)
		{
			$this->table = $table;
		}

		return $this;
	}

	/**
	 * Delete all items in the database that match these conditions
	 *
	 * @param   array    $conditions    Conditions by which to delete the data in database [array of arrays (key => value)]
	 *
	 * @return  bool
	 * @since   3.2.2
	 **/
	public function items(array $conditions): bool
	{
		return $this->database->items($conditions, $this->getTable());
	}

	/**
	 * Truncate a table
	 *
	 * @return  void
	 * @since   3.2.2
	 **/
	public function truncate(): void
	{
		$this->database->truncate($this->getTable());
	}

	/**
	 * Get the current active table
	 *
	 * @return  string
	 * @since 3.2.2
	 */
	public function getTable(): string
	{
		return $this->table;
	}
}

