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


use Joomla\DI\Container;
use VastDevelopmentMethod\Joomla\Service\Table;
use VastDevelopmentMethod\Joomla\Service\Database;
use VastDevelopmentMethod\Joomla\Service\Model;
use VastDevelopmentMethod\Joomla\Service\Data;
use VastDevelopmentMethod\Joomla\Interfaces\FactoryInterface;
use VastDevelopmentMethod\Joomla\Abstraction\Factory as ExtendingFactory;


/**
 * Data Factory
 * 
 * @since 3.2.2
 */
abstract class Factory extends ExtendingFactory implements FactoryInterface
{
	/**
	 * Create a container object
	 *
	 * @return  Container
	 * @since 3.2.2
	 */
	protected static function createContainer(): Container
	{
		return (new Container())
			->registerServiceProvider(new Table())
			->registerServiceProvider(new Database())
			->registerServiceProvider(new Model())
			->registerServiceProvider(new Data());
	}
}

