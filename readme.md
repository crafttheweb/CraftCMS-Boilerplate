CraftCMS Boilerplate
==============================

### Installation
1. First create local database
2. Create db.php and general.php files within /craft/config/local/

```php
    db.php
    // Local database info
    return array(
      'server'    => 'localhost',
      'user'      => 'username',
      'password'  => 'password',
      'database'  => 'local-db-name'
    );

    general.php
    /*
     * Local Config Override
     *
     * Overrides added here will get appended to the end of the
     * custom config array for all environments: '*'
     */
    return array(
      // Give us more useful error messages
      'devMode' => true,

      // Route ALL of the emails that Craft
      // sends to a single email address.
      'testToEmailAddress'  => 'testingemail@example.com',

      'translationDebugOutput'      => false,
      'useCompressedJs'             => true,
      'cacheDuration'               => 'P1D',
      'cooldownDuration'            => 'PT5M',
      'maxInvalidLogins'            => 5,
      'invalidLoginWindowDuration'  => 'PT1H',
      'phpMaxMemoryLimit'           => '256M',

      // Member login info duration
      // http://www.php.net/manual/en/dateinterval.construct.php
      'userSessionDuration'           => 'P101Y',
      'rememberedUserSessionDuration' => 'P101Y',
      'rememberUsernameDuration'      => 'P101Y',
    );
```

Now that you've put the correct database credentials in db.php, head on over to /admin and if all is well will start the installation process


### Brunch
If you don't already have Node installed head over to http://nodejs.org/download/
via the command line:

1. Install gulp `npm install -g brunch`
2. Install gulp modules defined in package.json `npm install`
3. Brunch away by running `brunch`


### .htaccess and .gitignore
The default .htaccess is packed with a bunch of goodies, again feel free to modify to your hearts content. Just make sure to add a period before the file name to make sure its read properly.
The default .gitignore file is setup to track unecessary folders and files, most of it involves not tracking random config files computers will add, as well as node_modules and some stuff within the craft/storage folder

### Templates
- Place each page or main section in a subfolder
   - Inside, use subfolders `detail/` and `index/` for master/child views and place all corresponding templates and partials inside
- Put shared components under `_partials/`
- Name all directly accessible components with a normal filename template.twig and all non-standalone partials with a underscore prefix: `_share-button.twig`

Example:

    templates/
      _helpers/
      _partials/
        _share-button.twig
        _gallery-item.twig
      products/
        index/
          index.twig
          _item.twig
        detail/
          entry.twig
          _product-image.twig
      _html.twig
      _layout.twig
      index.twig

### Sass
Use the [7-1 principle](http://sass-guidelin.es/#the-7-1-pattern).

Example:

    sass/
    |
    |– abstracts/
    |   |– _variables.scss    # Sass Variables
    |   |– _functions.scss    # Sass Functions
    |   |– _mixins.scss       # Sass Mixins
    |   |– _placeholders.scss # Sass Placeholders
    |
    |– base/
    |   |– _reset.scss        # Reset/normalize
    |   |– _typography.scss   # Typography rules
    |   …                     # Etc.
    |
    |– components/
    |   |– _buttons.scss      # Buttons
    |   |– _carousel.scss     # Carousel
    |   |– _cover.scss        # Cover
    |   |– _dropdown.scss     # Dropdown
    |   …                     # Etc.
    |
    |– layout/
    |   |– _navigation.scss   # Navigation
    |   |– _grid.scss         # Grid system
    |   |– _header.scss       # Header
    |   |– _footer.scss       # Footer
    |   |– _sidebar.scss      # Sidebar
    |   |– _forms.scss        # Forms
    |   …                     # Etc.
    |
    |– pages/
    |   |– _home.scss         # Home specific styles
    |   |– _contact.scss      # Contact specific styles
    |   …                     # Etc.
    |
    |– themes/
    |   |– _theme.scss        # Default theme
    |   |– _admin.scss        # Admin theme
    |   …                     # Etc.
    |
    |– vendors/
    |   |– _bootstrap.scss    # Bootstrap
    |   |– _jquery-ui.scss    # jQuery UI
    |   …                     # Etc.
    |
    `– main.scss              # Main Sass file