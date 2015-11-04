<?php
/**
 * VisualPaginator Control extension
 *
 * @author    Ing. Radek Dostál, Ph.D. <radek.dostal@gmail.com>
 * @copyright Copyright (c) 2015 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      http://www.radekdostal.cz
 */

namespace RadekDostal\NetteComponents\VisualPaginator;

use Nette\DI\CompilerExtension;

/**
 * VisualPaginator Control extension
 *
 * @author Radek Dostál
 */
class VisualPaginatorExtension extends CompilerExtension
{
  /**
   * Processes configuration data
   *
   * @return void
   */
  public function loadConfiguration()
  {
    $builder = $this->getContainerBuilder();

    $config = $this->getConfig([
      'template' => NULL,
      'viewButtonAll' => NULL
    ]);

    $paginator = $builder->addDefinition($this->prefix('paginator'))
      ->setClass('\RadekDostal\NetteComponents\VisualPaginator\VisualPaginator');

    $paginator->addSetup('$service->setTranslator(?)', [$config['translator']]);

    if ($config['template'])
      $paginator->addSetup('$service->setTemplate(?)', [$config['template']]);

    if (isset($config['viewButtonAll']))
      $paginator->addSetup('$service->setViewButtonAll(?)', [$config['viewButtonAll']]);
  }
}