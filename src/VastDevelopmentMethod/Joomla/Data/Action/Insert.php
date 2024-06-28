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


use VastDevelopmentMethod\Joomla\Interfaces\ModelInterface as Model;
use VastDevelopmentMethod\Joomla\Interfaces\InsertInterface as Database;
use VastDevelopmentMethod\Joomla\Interfaces\Data\InsertInterface;


/**
 * Data Insert (GUID)
 * 
 * @since 3.2.2
 */
class Insert implements InsertInterface
{
	/**
	 * Model
	 *
	 * @var    Model
	 * @since 3.2.0
	 */
	protected Model $model;

	/**
	 * Database
	 *
	 * @var    Database
	 * @since 3.2.0
	 */
	protected Database $database;

	/**
	 * Table Name
	 *
	 * @var    string
	 * @since 3.2.1
	 */
	protected string $table;

	/**
	 * Constructor
	 *
	 * @param Model       $model       The set model object.
	 * @param Database    $database    The insert database object.
	 * @param string|null $table       The table name.
	 *
	 * @since 3.2.2
	 */
	public function __construct(Model $model, Database $database, ?string $table = null)
	{
		$this->model = $model;
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
	 * Insert a value to a given table
	 *          Example: $this->value(Value, 'value_key', 'GUID');
	 *
	 * @param   mixed     $value      The field value
	 * @param   string    $field      The field key
	 * @param   string    $keyValue   The key value
	 * @param   string    $key        The key name
	 *
	 * @return  bool
	 * @since 3.2.0
	 */
	public function value($value, string $field, string $keyValue, string $key = 'guid'): bool
	{
		// build the array
		$item = [];
		$item[$key] = $keyValue;
		$item[$field] = $value;

		// Insert the column of this table
		return $this->row($item);
	}

	/**
	 * Insert single row with multiple values to a given table
	 *          Example: $this->item(Array);
	 *
	 * @param   array    $item   The item to save
	 *
	 * @return  bool
	 * @since 3.2.0
	 */
	public function row(array $item): bool
	{
		// check if object could be modelled
		if (($item = $this->model->row($item, $this->getTable())) !== null)
		{
			// Insert the column of this table
			return $this->database->row($item, $this->getTable());
		}
		return false;
	}

	/**
	 * Insert multiple rows to a given table
	 *          Example: $this->items(Array);
	 *
	 * @param   array|null   $items  The items updated in database (array of arrays)
	 *
	 * @return  bool
	 * @since 3.2.0
	 */
	public function rows(?array $items): bool
	{
		// check if object could be modelled
		if (($items = $this->model->rows($items, $this->getTable())) !== null)
		{
			// Insert the column of this table
			return $this->database->rows($items, $this->getTable());
		}
		return false;
	}

	/**
	 * Insert single item with multiple values to a given table
	 *          Example: $this->item(Object);
	 *
	 * @param   object    $item   The item to save
	 *
	 * @return  bool
	 * @since 3.2.0
	 */
	public function item(object $item): bool
	{
		// check if object could be modelled
		if (($item = $this->model->item($item, $this->getTable())) !== null)
		{
			// Insert the column of this table
			return $this->database->item($item, $this->getTable());
		}
		return false;
	}

	/**
	 * Insert multiple items to a given table
	 *          Example: $this->items(Array);
	 *
	 * @param   array|null   $items  The items updated in database (array of objects)
	 *
	 * @return  bool
	 * @since 3.2.0
	 */
	public function items(?array $items): bool
	{
		// check if object could be modelled
		if (($items = $this->model->items($items, $this->getTable())) !== null)
		{
			// Update the column of this table using guid as the primary key.
			return $this->database->items($items, $this->getTable());
		}
		return false;
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

