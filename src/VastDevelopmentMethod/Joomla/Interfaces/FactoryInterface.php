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


use Joomla\DI\Container;


/**
 * The Container Factory Interface
 * 
 * @since 0.0.0
 */
interface FactoryInterface
{
	/**
	 * Get any class from the container
	 *
	 * @param   string  $key  The container class key
	 *
	 * @return  Mixed
	 * @since 0.0.0
	 */
	public static function _(string $key);

	/**
	 * Get the global container
	 *
	 * @return  Container
	 * @since 0.0.0
	 */
	public static function getContainer(): Container;
}

