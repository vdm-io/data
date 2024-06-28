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

namespace VastDevelopmentMethod\Joomla\Abstraction;


use Joomla\CMS\Factory as JoomlaFactory;
use VastDevelopmentMethod\Joomla\Utilities\Component\Helper;


/**
 * Database
 * 
 * @since 3.2.0
 */
abstract class Database
{
	/**
	 * Database object to query local DB
	 *
	 * @since 3.2.0
	 */
	protected $db;

	/**
	 * Core Component Table Name
	 *
	 * @var   string
	 * @since 3.2.0
	 */
	protected string $table;

	/**
	 * Constructor
	 *
	 * @throws \Exception
	 * @since 3.2.0
	 */
	public function __construct()
	{
		$this->db = JoomlaFactory::getDbo();

		// set the component table
		$this->table = '#__' . Helper::getCode();
	}

	/**
	 * Set a value based on data type
	 *
	 * @param   mixed  $value   The value to set
	 *
	 * @return  mixed
	 * @since   3.2.0
	 **/
	protected function quote($value)
	{
		if ($value === null) // hmm the null does pose an issue (will keep an eye on this)
		{
			return 'NULL';
		}

		if (is_numeric($value))
		{
			if (filter_var($value, FILTER_VALIDATE_INT))
			{
				return (int) $value;
			}
			elseif (filter_var($value, FILTER_VALIDATE_FLOAT))
			{
				return (float) $value;
			}
		}
		elseif (is_bool($value)) // not sure if this will work well (but its correct)
		{
			return $value ? 'TRUE' : 'FALSE';
		}

		// For date and datetime values
		if ($value instanceof \DateTime)
		{
			return $this->db->quote($value->format('Y-m-d H:i:s'));
		}

		// For other data types, just escape it
		return $this->db->quote($value);
	}

	/**
	 * Set a table name, adding the
	 *     core component as needed
	 *
	 * @param   string  $table   The table string
	 *
	 * @return  string
	 * @since   3.2.0
	 **/
	protected function getTable(string $table): string
	{
		if (strpos($table, '#__') === false)
		{
			return $this->table . '_' . $table;
		}

		return $table;
	}
}

