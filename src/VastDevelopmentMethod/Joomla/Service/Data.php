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

namespace VastDevelopmentMethod\Joomla\Service;


use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use VastDevelopmentMethod\Joomla\Data\Action\Load;
use VastDevelopmentMethod\Joomla\Data\Action\Insert;
use VastDevelopmentMethod\Joomla\Data\Action\Update;
use VastDevelopmentMethod\Joomla\Data\Action\Delete;
use VastDevelopmentMethod\Joomla\Data\Item;
use VastDevelopmentMethod\Joomla\Data\Items;
use VastDevelopmentMethod\Joomla\Data\Subform;
use VastDevelopmentMethod\Joomla\Data\MultiSubform;


/**
 * Data Service Provider
 * 
 * @since 3.2.0
 */
class Data implements ServiceProviderInterface
{
	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  void
	 * @since 3.2.0
	 */
	public function register(Container $container)
	{
		$container->alias(Load::class, 'Data.Load')
			->share('Data.Load', [$this, 'getLoad'], true);

		$container->alias(Insert::class, 'Data.Insert')
			->share('Data.Insert', [$this, 'getInsert'], true);

		$container->alias(Update::class, 'Data.Update')
			->share('Data.Update', [$this, 'getUpdate'], true);

		$container->alias(Delete::class, 'Data.Delete')
			->share('Data.Delete', [$this, 'getDelete'], true);

		$container->alias(Item::class, 'Data.Item')
			->share('Data.Item', [$this, 'getItem'], true);

		$container->alias(Items::class, 'Data.Items')
			->share('Data.Items', [$this, 'getItems'], true);

		$container->alias(Subform::class, 'Data.Subform')
			->share('Data.Subform', [$this, 'getSubform'], true);

		$container->alias(MultiSubform::class, 'Data.MultiSubform')
			->share('Data.MultiSubform', [$this, 'getMultiSubform'], true);
	}

	/**
	 * Get The Load Class.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  Load
	 * @since 3.2.0
	 */
	public function getLoad(Container $container): Load
	{
		return new Load(
			$container->get('Model.Load'),
			$container->get('Load')
		);
	}

	/**
	 * Get The Insert Class.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  Insert
	 * @since 3.2.0
	 */
	public function getInsert(Container $container): Insert
	{
		return new Insert(
			$container->get('Model.Upsert'),
			$container->get('Insert')
		);
	}

	/**
	 * Get The Update Class.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  Update
	 * @since 3.2.0
	 */
	public function getUpdate(Container $container): Update
	{
		return new Update(
			$container->get('Model.Upsert'),
			$container->get('Update')
		);
	}

	/**
	 * Get The Delete Class.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  Delete
	 * @since 3.2.0
	 */
	public function getDelete(Container $container): Delete
	{
		return new Delete(
			$container->get('Delete')
		);
	}

	/**
	 * Get The Item Class.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  Item
	 * @since 3.2.0
	 */
	public function getItem(Container $container): Item
	{
		return new Item(
			$container->get('Data.Load'),
			$container->get('Data.Insert'),
			$container->get('Data.Update'),
			$container->get('Data.Delete'),
			$container->get('Load')
		);
	}

	/**
	 * Get The Items Class.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  Items
	 * @since 3.2.0
	 */
	public function getItems(Container $container): Items
	{
		return new Items(
			$container->get('Data.Load'),
			$container->get('Data.Insert'),
			$container->get('Data.Update'),
			$container->get('Data.Delete'),
			$container->get('Load')
		);
	}

	/**
	 * Get The Subform Class.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  Subform
	 * @since 3.2.0
	 */
	public function getSubform(Container $container): Subform
	{
		return new Subform(
			$container->get('Data.Items')
		);
	}

	/**
	 * Get The MultiSubform Class.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  MultiSubform
	 * @since 3.2.0
	 */
	public function getMultiSubform(Container $container): MultiSubform
	{
		return new MultiSubform(
			$container->get('Data.Subform')
		);
	}
}

