<?php
/**
 * VisualPaginator Control
 *
 * @author    Ing. Radek Dostál, Ph.D. <radek.dostal@gmail.com>
 * @copyright Copyright (c) 2015 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      http://www.radekdostal.cz
 */

namespace RadekDostal\NetteComponents\VisualPaginator;

use Nette\Application\UI\Control;
use Nette\ComponentModel\IContainer;
use Nette\Utils\Paginator;

/**
 * VisualPaginator Control
 *
 * @author David Grudl
 * @author Radek Dostál
 */
class VisualPaginator extends Control
{
  /**
   * Page
   *
   * @persistent
   */
  public $page = 1;

  /**
   * Paginator
   *
   * @var \Nette\Utils\Paginator
   */
  private $paginator;

  /**
   * Template filename
   *
   * @var string
   */
  private $templateFilename;

  /**
   * Visibility of button to view all records
   *
   * @var bool
   */
  private $viewButtonAll;

  /**
   * Initialization.
   */
  public function __construct(IContainer $parent = NULL, $name = NULL)
  {
    parent::__construct($parent, $name);

    $this->templateFilename = __DIR__.'/templates/bootstrap-3.latte';
    $this->viewButtonAll = FALSE;
  }

  /**
   * Creates and gets paginator
   *
   * @return \Nette\Utils\Paginator
   */
  public function getPaginator()
  {
    if (!$this->paginator)
      $this->paginator = new Paginator();

    return $this->paginator;
  }

  /**
   * Renders paginator
   *
   * @return void
   */
  public function render()
  {
    $paginator = $this->getPaginator();
    $page = $paginator->getPage();

    if ($paginator->getPageCount() < 2)
      $steps = [$page];
    else
    {
      $arr = range(max($paginator->getFirstPage(), $page - 3), min($paginator->getLastPage(), $page + 3));
      $count = 4;
      $quotient = ($paginator->getPageCount() - 1) / $count;

      for ($i = 0; $i <= $count; $i++)
        $arr[] = round($quotient * $i) + $paginator->getFirstPage();

      sort($arr);

      $steps = array_values(array_unique($arr));
    }

    $this->template->paginator = $paginator;
    $this->template->steps = $steps;
    $this->template->viewButtonAll = $this->viewButtonAll;

    $this->template->setFile($this->templateFilename);
    $this->template->render();
  }

  /**
   * Sets template file
   *
   * @param string $template template file
   * @return self
   */
  public function setTemplate($template)
  {
    $this->templateFilename = $template;

    return $this;
  }

  /**
   * Sets visibility of button to view all records
   *
   * @param bool $view visibility
   * @return self
   */
  public function setViewButtonAll($view = TRUE)
  {
    $this->viewButtonAll = $view;

    return $this;
  }

  /**
   * Checks if all records are viewed
   *
   * @return bool
   */
  public function isViewedAll()
  {
    return $this->getParameter('page') == '0';
  }

  /**
   * Loads state informations
   *
   * @param array
   * @return void
   */
  public function loadState(array $params)
  {
    parent::loadState($params);

    $this->getPaginator()->page = $this->page;
  }
}