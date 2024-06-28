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

namespace VastDevelopmentMethod\Joomla\Interfaces\Data;


/**
 * Data Subform Interface
 * 
 * @since 3.2.2
 */
interface SubformInterface
{
	/**
	 * Set the current active table
	 *
	 * @param string $table The table that should be active
	 *
	 * @return self
	 * @since 3.2.2
	 */
	public function table(string $table): self;

	/**
	 * Get a subform items
	 *
	 * @param string   $linkValue  The value of the link key in child table.
	 * @param string   $linkKey    The link key on which the items where linked in the child table.
	 * @param string   $field      The parent field name of the subform in the parent view.
	 * @param array    $set        The array SET of the keys of each row in the subform.
	 *
	 * @return array|null   The subform
	 * @since 3.2.2
	 */
	public function get(string $linkValue, string $linkKey, string $field, array $set): ?array;

	/**
	 * Set a subform items
	 *
	 * @param array    $items      The list of items from the subform to set
	 * @param string   $indexKey   The index key on which the items should be observed as it relates to insert/update/delete.
	 * @param string   $linkKey    The link key on which the items where linked in the child table.
	 * @param string   $linkValue  The value of the link key in child table.
	 *
	 * @return bool
	 * @since 3.2.2
	 */
	public function set(array $items, string $indexKey, string $linkKey, string $linkValue): bool;

	/**
	 * Get the current active table
	 *
	 * @return  string
	 * @since 3.2.2
	 */
	public function getTable(): string;
}

