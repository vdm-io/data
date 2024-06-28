# Vdm Data (1.0.0)

VDM Data Library

## Details

- Packager: [OctoPower v2.0](https://git.vdm.dev/octoleo/octopower)
- Author: [Llewellyn van der Merwe](https://io.vdm.dev)
- Creation Date: June 2024

### Installation via Composer

Setup this registry in your `~/.composer/config.json` file:
```
{
	"repositories": [{
			"type": "composer",
			"url": "https://git.vdm.dev/api/packages/joomla/composer"
		}
	]
}
```

To install the package using Composer, run the following command:
```
composer require vdm/data:1.0.0
```

## Joomla Framework Dependencies

>We have added the following framework classes to the required list of this Composer package.

- Joomla/DI "^3.0"
  - [VastDevelopmentMethod\Joomla\Data\Factory](src/VastDevelopmentMethod/Joomla/Data/Factory.php)
  - [VastDevelopmentMethod\Joomla\Abstraction\Factory](src/VastDevelopmentMethod/Joomla/Abstraction/Factory.php)
  - [VastDevelopmentMethod\Joomla\Interfaces\FactoryInterface](src/VastDevelopmentMethod/Joomla/Interfaces/FactoryInterface.php)
  - [VastDevelopmentMethod\Joomla\Service\Table](src/VastDevelopmentMethod/Joomla/Service/Table.php)
  - [VastDevelopmentMethod\Joomla\Componentbuilder\Table\Schema](src/VastDevelopmentMethod/Joomla/Componentbuilder/Table/Schema.php)
  - [VastDevelopmentMethod\Joomla\Service\Database](src/VastDevelopmentMethod/Joomla/Service/Database.php)
  - [VastDevelopmentMethod\Joomla\Database\Load](src/VastDevelopmentMethod/Joomla/Database/Load.php)
  - [VastDevelopmentMethod\Joomla\Service\Model](src/VastDevelopmentMethod/Joomla/Service/Model.php)
  - [VastDevelopmentMethod\Joomla\Model\Load](src/VastDevelopmentMethod/Joomla/Model/Load.php)
  - [VastDevelopmentMethod\Joomla\Abstraction\Model](src/VastDevelopmentMethod/Joomla/Abstraction/Model.php)
  - [VastDevelopmentMethod\Joomla\Service\Data](src/VastDevelopmentMethod/Joomla/Service/Data.php)
  - [VastDevelopmentMethod\Joomla\Data\Action\Load](src/VastDevelopmentMethod/Joomla/Data/Action/Load.php)
  - [VastDevelopmentMethod\Joomla\Interfaces\Data\LoadInterface](src/VastDevelopmentMethod/Joomla/Interfaces/Data/LoadInterface.php)
- Joomla/Filter "^3.0"
  - [VastDevelopmentMethod\Joomla\Utilities\StringHelper](src/VastDevelopmentMethod/Joomla/Utilities/StringHelper.php)
- Joomla/Input "^3.0"
  - [VastDevelopmentMethod\Joomla\Utilities\Component\Helper](src/VastDevelopmentMethod/Joomla/Utilities/Component/Helper.php)
  - [VastDevelopmentMethod\Joomla\Utilities\String\NamespaceHelper](src/VastDevelopmentMethod/Joomla/Utilities/String/NamespaceHelper.php)
- Joomla/Registry "^3.0"
  - [VastDevelopmentMethod\Joomla\Utilities\Component\Helper](src/VastDevelopmentMethod/Joomla/Utilities/Component/Helper.php)
  - [VastDevelopmentMethod\Joomla\Utilities\String\NamespaceHelper](src/VastDevelopmentMethod/Joomla/Utilities/String/NamespaceHelper.php)


## Joomla CMS Dependencies

- Joomla\CMS\Component\ComponentHelper
  - [VastDevelopmentMethod\Joomla\Utilities\Component\Helper](src/VastDevelopmentMethod/Joomla/Utilities/Component/Helper.php)
  - [VastDevelopmentMethod\Joomla\Utilities\String\NamespaceHelper](src/VastDevelopmentMethod/Joomla/Utilities/String/NamespaceHelper.php)
- Joomla\CMS\Date\Date
  - [VastDevelopmentMethod\Joomla\Database\Insert](src/VastDevelopmentMethod/Joomla/Database/Insert.php)
- Joomla\CMS\Factory
  - [VastDevelopmentMethod\Joomla\Abstraction\Schema](src/VastDevelopmentMethod/Joomla/Abstraction/Schema.php)
  - [VastDevelopmentMethod\Joomla\Abstraction\Database](src/VastDevelopmentMethod/Joomla/Abstraction/Database.php)
  - [VastDevelopmentMethod\Joomla\Utilities\Component\Helper](src/VastDevelopmentMethod/Joomla/Utilities/Component/Helper.php)
  - [VastDevelopmentMethod\Joomla\Utilities\String\NamespaceHelper](src/VastDevelopmentMethod/Joomla/Utilities/String/NamespaceHelper.php)
- Joomla\CMS\Language\Language
  - [VastDevelopmentMethod\Joomla\Utilities\StringHelper](src/VastDevelopmentMethod/Joomla/Utilities/StringHelper.php)
- Joomla\CMS\Version
  - [VastDevelopmentMethod\Joomla\Abstraction\Schema](src/VastDevelopmentMethod/Joomla/Abstraction/Schema.php)


### License
> GNU General Public License version 2 or later

