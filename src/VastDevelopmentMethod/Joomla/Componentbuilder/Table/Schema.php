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

namespace VastDevelopmentMethod\Joomla\Componentbuilder\Table;


use VastDevelopmentMethod\Joomla\Componentbuilder\Table;
use VastDevelopmentMethod\Joomla\Interfaces\SchemaInterface;
use VastDevelopmentMethod\Joomla\Abstraction\Schema as ExtendingSchema;


/**
 * Componentbuilder Tables Schema
 * 
 * @since 3.2.1
 */
final class Schema extends ExtendingSchema implements SchemaInterface
{
	/**
	 * Constructor.
	 *
	 * @param Table   $table   The Table Class.
	 *
	 * @since 3.2.1
	 */
	public function __construct(?Table $table = null)
	{
		$table ??= new Table;

		parent::__construct($table);
	}

	/**
	 * Get the targeted component code
	 *
	 * @return  string
	 * @since 3.2.1
	 */
	protected function getCode(): string
	{
		return 'componentbuilder';
	}
}

