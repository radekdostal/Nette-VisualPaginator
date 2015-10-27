# VisualPaginator for Nette Framework

VisualPaginator Control for Nette Framework

- Author: Radek Dostál &lt;radek.dostal@gmail.com&gt;
- Copyright: Copyright (c) 2015 [Radek Dostál](http://www.radekdostal.cz)
- Licence: [GNU Lesser General Public License](http://www.gnu.org/licenses/)
- Github: [http://github.com/radekdostal/Nette-VisualPaginator](http://github.com/radekdostal/Nette-VisualPaginator)

This add-on creates visual paginator with support for custom templates (default template is designed for [Bootstrap](http://getbootstrap.com/) 3).

## Requirements

- **[PHP](http://php.net)** 5.4 or later
- **[Nette Application](https://github.com/nette/application)** 2.2 or later
- **[Nette DI](https://github.com/nette/di)** 2.2 or later

## GNU Lesser General Public License

LGPL licenses are very very long, so instead of including them here we offer you URLs with full text:

- [LGPL version 2.1](http://www.gnu.org/licenses/lgpl-2.1.html)
- [LGPL version 3](http://www.gnu.org/licenses/lgpl-3.0.html)

## Example

### config.neon

```php
extensions:
  visualPaginator: RadekDostal\NetteComponents\VisualPaginator\VisualPaginatorExtension

# Optional
visualPaginator:
  template: '%appDir%/components/VisualPaginator/custom.latte'
  viewButtonAll: TRUE
```

### Presenter

```php
class DefaultPresenter extends BasePresenter
{
  use \RadekDostal\NetteComponents\VisualPaginator\TVisualPaginator;

  public function renderDefault()
  {
    $paginator = $this['vp']->getPaginator();
    $paginator->setItemsPerPage(1);
    $paginator->setItemCount(10);
  }

  /**
   * Creates the visual paginator
   *
   * @return \RadekDostal\NetteComponents\VisualPaginator\VisualPaginator
   */
  protected function createComponentVp()
  {
    return $this->visualPaginator;
  }
}
```

### Template default.latte

```
{control vp}
```