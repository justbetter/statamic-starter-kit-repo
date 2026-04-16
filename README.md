# JustBetter Statamic Starter Kit Repo

This is the repo project that is used for creating the JustBetter Statamic Starter Kit which can be found on https://github.com/justbetter/statamic-starter-kit.

## Fieldsets
- [Accordion](https://github.com/justbetter/statamic-starter-kit-repo/blob/master/resources/views/components/fieldset/accordion.blade.php)
- [Button](https://github.com/justbetter/statamic-starter-kit-repo/blob/master/resources/views/components/fieldset/button.blade.php)
- [Buttons](https://github.com/justbetter/statamic-starter-kit-repo/blob/master/resources/views/components/fieldset/buttons.blade.php)
- [Content](https://github.com/justbetter/statamic-starter-kit-repo/blob/master/resources/views/components/fieldset/content.blade.php)
- [Icon](https://github.com/justbetter/statamic-starter-kit-repo/blob/master/resources/views/components/fieldset/icon.blade.php)
- [Link](https://github.com/justbetter/statamic-starter-kit-repo/blob/master/resources/views/components/fieldset/link.blade.php)
- [Media](https://github.com/justbetter/statamic-starter-kit-repo/blob/master/resources/views/components/fieldset/media.blade.php)
- [Title](https://github.com/justbetter/statamic-starter-kit-repo/blob/master/resources/views/components/fieldset/title.blade.php)

The idea with these fieldsets is to have a good starting point with basic configuration that you can use inside components for your page builder for example you can use it
inside the [text_image](https://github.com/justbetter/statamic-starter-kit-repo/blob/master/resources/views/page_builder/text_image.blade.php) component.

## Usage

All fieldsets can be used in the components where you need these fieldsets. The fieldsets are prefixed with `x-fieldset`

### Basic examples

#### Accordion

```blade
<x-fieldset.accordion :accordion="$accordion->value()" />
```

#### Button

```blade
<x-fieldset.button :button="$button->value()" />
```

#### Buttons

```blade
<x-fieldset.buttons :buttons="$buttons?->value()" />
```

#### Content

```blade
<x-fieldset.content :content="$content?->value()" />
```

#### Icon

```blade
<x-fieldset.icon :icon="$icon?->value()"/>
```

#### Link

```blade
<x-fieldset.link :link="$link->value()">
    This is a link
</x-fieldset.link>
```

#### Media

```blade
<x-fieldset.media :media="$media?->value()" />
```

#### Title

```blade
<x-fieldset.title :title="$title?->value()" />
```

## Changing fieldset

If you need to change fieldsets you overwrite them inside your project add them inside `resources/views/components/fieldset`

## Credits

- [Kevin Meijer](https://github.com/kevinmeijer97)
- [All Contributors](../../contributors)

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

<a href="https://justbetter.nl" title="JustBetter">
    <img src="./art/footer.svg" alt="JustBetter logo">
</a>
