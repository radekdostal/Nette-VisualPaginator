# VisualPaginator for Nette Framework

VisualPaginator Control for Nette Framework

- Author: Radek Dostál &lt;radek.dostal@gmail.com&gt;
- Copyright: Copyright (c) 2015 - 2016 [Radek Dostál](https://www.radekdostal.cz)
- Licence: [GNU Lesser General Public License](https://www.gnu.org/licenses/)
- Github: [radekdostal/Nette-VisualPaginator](https://github.com/radekdostal/Nette-VisualPaginator)

This add-on creates visual paginator with localizations and with optional "all" button. It supports custom localizations and custom templates (default template is designed for [Bootstrap](http://getbootstrap.com/) 3).

## Requirements

- **[PHP](https://php.net)** 5.4 or later
- **[Nette Application](https://github.com/nette/application)** 2.2 or later
- **[Nette DI](https://github.com/nette/di)** 2.2 or later
- **[Kdyby/Translation](https://github.com/Kdyby/Translation)** 2.2 or later

## GNU Lesser General Public License

LGPL licenses are very very long, so instead of including them here we offer you URLs with full text:

- [LGPL version 2.1](https://www.gnu.org/licenses/lgpl-2.1.html)
- [LGPL version 3](https://www.gnu.org/licenses/lgpl-3.0.html)

## Example

### config.neon

```php
extensions:
  translation: Kdyby\Translation\DI\TranslationExtension
  visualPaginator: RadekDostal\NetteComponents\VisualPaginator\VisualPaginatorExtension

translation:
  default: cs
  fallback: [cs_CZ, cs]
  whitelist: [cs, en]
  resolvers: # optional
    header: off

visualPaginator:
  translator: @translation.default
  #template: '%appDir%/components/VisualPaginator/custom.latte'
  #viewButtonAll: TRUE
```

Kdyby\Translation looks for localizations in the directory app/lang. For example english localization file must be named visualPaginator.en_GB.neon (in case of using the NEON syntax).

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

  // For multiple paginators on the same page
  protected function createComponentVp2()
  {
    $control = $this->visualPaginator->create();
    // $control->setTemplate(...);
    
    // Dynamic change localization
    $control->getTranslator()->setLocale('en');
    
    return $control;
  }
}
```

### Template default.latte

```
{control vp}
```