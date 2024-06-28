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

namespace VastDevelopmentMethod\Joomla\Data;


use VastDevelopmentMethod\Joomla\Interfaces\Data\LoadInterface as Load;
use VastDevelopmentMethod\Joomla\Interfaces\Data\InsertInterface as Insert;
use VastDevelopmentMethod\Joomla\Interfaces\Data\UpdateInterface as Update;
use VastDevelopmentMethod\Joomla\Interfaces\Data\DeleteInterface as Delete;
use VastDevelopmentMethod\Joomla\Interfaces\LoadInterface as Database;
use VastDevelopmentMethod\Joomla\Interfaces\Data\ItemsInterface;


/**
 * Data Items
 * 
 * @since 3.2.2
 */
final class Items implements ItemsInterface
{
	/**
	 * The LoadInterface Class.
	 *
	 * @var   Load
	 * @since 3.2.2
	 */
	protected Load $load;

	/**
	 * The InsertInterface Class.
	 *
	 * @var   Insert
	 * @since 3.2.2
	 */
	protected Insert $insert;

	/**
	 * The UpdateInterface Class.
	 *
	 * @var   Update
	 * @since 3.2.2
	 */
	protected Update $update;

	/**
	 * The DeleteInterface Class.
	 *
	 * @var   Delete
	 * @since 3.2.2
	 */
	protected Delete $delete;

	/**
	 * The Load Class.
	 *
	 * @var   Database
	 * @since 3.2.2
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
	 * Constructor.
	 *
	 * @param Load        $load       The LoadInterface Class.
	 * @param Insert      $insert     The InsertInterface Class.
	 * @param Update      $update     The UpdateInterface Class.
	 * @param Delete      $delete     The DeleteInterface Class.
	 * @param Database    $database   The Database Load Class.
	 * @param string|null $table      The table name.
	 *
	 * @since 3.2.2
	 */
	public function __construct(Load $load, Insert $insert, Update $update, Delete $delete,
		Database $database, ?string $table = null)
	{
		$this->load = $load;
		$this->insert = $insert;
		$this->update = $update;
		$this->delete = $delete;
		$this->database = $database;
		if ($table !== null)
		{
			$this->table = $table;
		}
	}

	/**
	 * Set the current active table
	 *
	 * @param string $table The table that should be active
	 *
	 * @return self
	 * @since 3.2.2
	 */
	public function table(string $table): self
	{
		$this->table = $table;

		return $this;
	}

	/**
	 * Get list of items
	 *
	 * @param array     $values    The ids of the items
	 * @param string    $key       The key of the values
	 *
	 * @return array|null The item object or null
	 * @since 3.2.2
	 */
	public function get(array $values, string $key = 'guid'): ?array
	{
		return $this->load->table($this->getTable())->items([
			$key => [
				'operator' => 'IN',
				'value' => array_values($values)
			]
		]);
	}

	/**
	 * Get the values
	 *
	 * @param array   $values    The list of values (to search by).
	 * @param string  $key       The key on which the values being searched.
	 * @param string  $get       The key of the values we want back
	 *
	 * @return array|null   The array of found values.
	 * @since 3.2.2
	 */
	public function values(array $values, string $key = 'guid', string $get = 'id'): ?array
	{
		// Perform the database query
		return $this->load->table($this->getTable())->values([
			$key => [
				'operator' => 'IN',
				'value' => array_values($values)
			]
		], $get);
	}

	/**
	 * Set items
	 *
	 * @param array     $items  The list of items
	 * @param string    $key    The key on which the items should be set
	 *
	 * @return bool
	 * @since 3.2.2
	 */
	public function set(array $items, string $key = 'guid'): bool
	{
		if (($sets = $this->sort($items, $key)) !== null)
		{
			foreach ($sets as $action => $items)
			{
				$this->{$action}($items, $key);
			}
			return true;
		}

		return false;
	}

	/**
	 * Delete items
	 *
	 * @param array    $values  The item key value
	 * @param string   $key     The item key
	 *
	 * @return bool
	 * @since 3.2.2
	 */
	public function delete(array $values, string $key = 'guid'): bool
	{
		return $this->delete->table($this->getTable())->items([$key => ['operator' => 'IN', 'value' => $values]]);
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

	/**
	 * Insert a item
	 *
	 * @param array   $items  The item
	 *
	 * @return bool
	 * @since 3.2.2
	 */
	private function insert(array $items): bool
	{
		return $this->insert->table($this->getTable())->rows($items);
	}

	/**
	 * Update a item
	 *
	 * @param object   $item  The item
	 * @param string   $key   The item key
	 *
	 * @return bool
	 * @since 3.2.2
	 */
	private function update(array $items, string $key): bool
	{
		return $this->update->table($this->getTable())->rows($items, $key);
	}

	/**
	 * Sort items between insert and update.
	 *
	 * @param array  $items The list of items.
	 * @param string $key   The key on which the items should be sorted.
	 *
	 * @return array|null The sorted sets.
	 * @since 3.2.2
	 */
	private function sort(array $items, string $key): ?array
	{
		// Extract relevant items based on the key.
		$values = $this->extractValues($items, $key);
		if ($values === null)
		{
			return null;
		}

		$sets = [
			'insert' => [],
			'update' => []
		];

		// Check for existing items.
		$existingItems = $this->database->values(
			["a.$key" => $key],
			["a" => $this->getTable()],
			["a.$key" => ['operator' => 'IN', 'value' => $values]]
		);

		if ($existingItems !== null)
		{
			$sets['update'] = $this->extractSet($items, $existingItems, $key) ?? [];
			$sets['insert'] = $this->extractSet($items, $existingItems, $key, true) ?? [];
		}
		else
		{
			$sets['insert'] = $items;
		}

		// If either set is empty, remove it from the result.
		$sets = array_filter($sets);

		return !empty($sets) ? $sets : null;
	}

	/**
	 * Extracts values for a given key from an array of items.
	 * Items can be either arrays or objects.
	 *
	 * @param array $items Array of items (arrays or objects)
	 * @param string $key The key to extract values for
	 *
	 * @return array|null Extracted values
	 * @since 3.2.2
	 */
	private function extractValues(array $items, string $key): ?array
	{
		$result = [];

		foreach ($items as $item)
		{
			if (is_array($item) && !empty($item[$key]))
			{
				$result[] = $item[$key];
			}
			elseif (is_object($item) && !empty($item->{$key}))
			{
				$result[] = $item->{$key};
			}
		}

		return ($result === []) ? null : $result;
	}

	/**
	 * Extracts items from an array of items based on a set.
	 * Items can be either arrays or objects.
	 *
	 * @param array  $items   Array of items (arrays or objects)
	 * @param array  $set	 The set to match values against
	 * @param string $key	 The key of the set values
	 * @param bool   $inverse Whether to extract items not in the set
	 *
	 * @return array|null Extracted values
	 * @since 3.2.2
	 */
	private function extractSet(array $items, array $set, string $key, bool $inverse = false): ?array
	{
		$result = [];

		foreach ($items as $item)
		{
			$value = is_array($item) ? ($item[$key] ?? null) : ($item->{$key} ?? null);

			if ($value !== null)
			{
				$inSet = in_array($value, $set);
				if (($inSet && !$inverse) || (!$inSet && $inverse))
				{
					$result[] = is_array($item) ? $item : (array) $item; // convert all to arrays
				}
			}
		}

		return empty($result) ? null : $result;
	}
}

