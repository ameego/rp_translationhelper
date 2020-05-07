# Setup
- Copy `rp_translationhelper` folder to `perch/apps/`
- Add `rp_translationhelper` in `perch/config/apps.php`.
- The app requires a variable `lang` (returning a language code such as `en`, `fr`, `de`, etc.) to be set through PerchSystem::set_var (see https://docs.grabaperch.com/templates/passing-variables-into-templates/).

# Usage
## Static string
```html
<perch:translate id="myTranslation1" en="Static string" fr="Contenu static" />
```

## perch:content
To use dynamic content coming from `<perch:content />`, specify the id in `<perch:translate />`.

```html
<perch:content id="content_en" type="text" />
<perch:content id="content_fr" type="text" />
```

Can then be used:
```html
<perch:translate id="myTranslation2" en="content_en" fr="content_fr" />
```


## Explicit mode
By default if the app doesn't find dynamic content matching the ID giving in a language attribute, it will assume it's static content and output it as is.

If you're on `/fr` and attempt to output `name` but you haven't added the `fr` translation:

```html
<perch:translate id="name_en" en="name_en" fr="name_fr" />
```

The app outputs "name_fr".

In explicit mode, you tell the app which ID is for dynamic content by wrapping it in `{}`:

```html
<perch:translate id="name_en" en="{name_en}" fr="{name_fr}" explicit />
```

If no dynamic content with ID `name_fr` is found, the app then falls back to the `id` attribute and output the dynamic content with ID `name_en` in this case.


You can also mix between dynamic and static content:

```html
<perch:translate id="name" en="Some static content" fr="{name_fr}" explicit />
```

### Turning on explicit mode

You can turn explicit mode per tag by adding the `explicit` attribute. If you are using an older version of Perch, you also need to give it a value `explicit="true"`.

If you prefer to have explicit mode turned on globally for all your `perch:translate` tags, add the following to your Perch configuration file `perch/config/config.php`:

```php
define('RP_TRANSLATION_HELPER_EXPLICIT_MODE', true);
```