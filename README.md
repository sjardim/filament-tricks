# Build a global navigation with the Navigation plugin

Ryan Chandler's [Navigation plugin](https://filamentphp.com/plugins/navigation) is powerful, but you may have questions on how to use it, so here I want to show you how to build a global navigation for your front end quickly.

## First, an example of what we are building.

In your Blade template, the navigation will render like this (and you can have total control over the markup):

![Blade view](https://raw.githubusercontent.com/sjardim/filament-tricks/main/screenshots/filament-navigation-00.png)

And here is the navigation built inside the Filament Admin, using the aforemention plugin. 

![Navigation on Filament Admin](https://raw.githubusercontent.com/sjardim/filament-tricks/main/screenshots/filament-navigation-01.png)

## Let's build it!

### Step 1

On you Laravel project using the Filament Admin, install Ryan Chandler's [Navigation plugin](https://filamentphp.com/plugins/navigation).

### Optional Step

If you are using Z3d0X's [Fabrication plugin](https://filamentphp.com/plugins/fabricator), you can create a custom Type for the navigation that renders the pages slugs. But **be aware** that if you change the page slug, you will need also to update the navigation. **It will not update automatically.**

On your ViewServiceProvider.php file, created on Step 2: 

```php
FilamentNavigation::addItemType('Existing Page', [
            Select::make('page_id')
                ->label('Page')
                ->searchable()
                ->options(function () {
                    return Page::pluck('title', 'id', 'slug');
                })
                ->reactive()
                ->afterStateUpdated(function (callable $set, $state) {
                    if($state) {
                        $url = Page::whereId($state)->value('slug');
                        $set('url', $url);
                    } else {
                        $set('url', '');
                    }
                }),
            TextInput::make('url')
                ->label('URL')
                ->disabled()
                ->helperText('This URL is automatically generated based on the page you select above.')
                ->hidden(fn (\Closure $get) => $get('page_id') === null),
        ]);
```

![Navigation on Filament Admin](https://raw.githubusercontent.com/sjardim/filament-tricks/main/screenshots/filament-navigation-01.png)
