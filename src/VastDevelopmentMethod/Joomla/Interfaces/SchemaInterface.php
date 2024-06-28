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

namespace VastDevelopmentMethod\Joomla\Interfaces;


/**
 * Schema Checking Interface
 * 
 * @since 3.2.1
 */
interface SchemaInterface
{
	/**
	 * Check and update database schema for missing fields or tables.
	 *
	 * @return array   The array of successful updates/actions, if empty no update/action was taken.
	 * @since  3.2.1
	 * @throws \Exception If there is an error during the update process.
	 */
	public function update(): array;

	/**
	 * Create a table with all necessary fields.
	 *
	 * @param string $table The name of the table to create.
	 *
	 * @return void
	 * @since  3.2.1
	 * @throws \Exception If there is an error creating the table.
	 */
	public function createTable(string $table): void;

	/**
	 * Update the schema of an existing table.
	 *
	 * @param string $table  The table to update.
	 *
	 * @return void
	 * @since  3.2.1
	 * @throws \Exception If there is an error while updating the schema.
	 */
	public function updateSchema(string $table): void;
}

