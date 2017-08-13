# \\[Lollipop](http://github.com/4ldrich/lollipop-php)\Page

These page will show you on how-to use ```\Lollipop\Page``` 

### reload() ```(void)```
Page reload

### redirect($uri) ```(void)```
Redirect page to a specific URI

### render($view, array $data = array()) ```(mixed)```
Render a view file

```php

// view.php

Hello <?= isset($name) ? $name : 'World'; ?>!

```

```php

// Renderer

use \Lollipop\Page;

echo Page::render('view.php', ['name' => 'John']);

```