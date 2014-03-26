# Oxygen Front-End Development 

### Bundler
Command line tool to manage Ruby Gem dependencies. We use a few interrelated gems, including Sass, Compass, and a few Compass extensions.

In Terminal

1. cd to aurora_usa theme directory
1. `$ sudo gem install bundler` - only need to run first time only 

### Compiling Sass
Since we're using Bundler to manage our gems it will control our Sass compiles. Prepend `bundle exec` to every Compass command. __Tip:__ Create a bash alias to reduce your keystrokes.

Some Commands:  
(from the same directory as 'config.rb')

- `$ bundle exec compass watch` (watch for sass changes and recompile every time it sees changes (will keep going until you stop it (control C)) 
- `$ bundle exec compass compile` (compile and stop checking for changes)

#### [OPTIONAL] Advanced Sass Compilation  
You may want to use Grunt to compile your Sass. Grunt will also live reload your browser when the css changes and JSHint your javascript. See setup docs [here](http://snugug.github.io/Aurora/features/#advanced).

### Partials
Our Sass is set up to use one main 'styles.scss' file that controls many partials in specific directories. They are: 

Directories:

1. global/ 
    - variables/
        - _all.scss - imports the other partials
        - _colors.scss - variables for colors and color schemes
        - _fonts.scss - variables for fonts
        - _settings.scss - variables for global and component defaults
    - extends/
        - _all.scss - imports the other partials
        - _helpers.scss - extends that are globally useful
        - _typography.scss - extends that address typography and are globally useful
2. bases/
    - a117/
        - _extends.scss - extends for a117 componenet
        - _mixins.scss - mixins for a117 componenet
    - _a11y.scss - controller for a11y component
    - _all.scss - imports the other partials
    - _common.scss - write css for html, body, and ::selection
3. components/
    - controllers, mixins, and extends for components. SEE BELOW FOR COMPONENT DETAILS
4. layouts/
    - scss for template and page layouts

### Components

You should create a Sass component using the structure below for each html and design component. Import each component from the 'styles.scss' file. See the 'stub' component in the components directory for a template.

- _component-name.scss - imports the partials in the 'component-name' directory and any other dependencies; implements specific uses of the component  
    - component-name/  
        - _mixins.scss - defines mixins for use by the component  
        - _extends.scss - defines extends for use by the component  

### Fonts

Fonts licensed from fonts.com  
Must be included when fonts used  
- `@import url("//fast.fonts.com/t/1.css?apiType=css&projectid=03088502-7de4-47f9-9df2-1271bd959096");`  
- Current production [http://features.oxygen.com/fonts/fonts.css](http://features.oxygen.com/fonts/fonts.css")

### Icons

All single-color icons should be added to our icon font. 
- go to [icomoon.io](http://icomoon.io/app/#/select)
- click the menu icon (three lines, top left of screen)
- choose "Import Project". Upload the file, 'oxygen-font.json', currently in our 'fonts' directory
- Add icons to font: choose social icons from 'Entypo' group or click, "Import Icons" to add your own svg files
- Export your font: Click the "Font" button at the bottom
- add keywords in the 'ligature' field for each glyph
- click download to download. 

Add the new font to the theme: 
- unzip the downloaded file
- move the font files to our font folder. 
- rename 'selection.json' and also move it to the font folder
- move liga.js to our javascripts folder
- rename 'style.css' to '_typography-oxygen-font.scss' and move to 'sass/global/variables'

Usage: 
### ligature text replace
```scss
.my-selector {
  @extend %oxygen-font;
}
```

### :before
```scss
@mixin icon-replace($icon-size) {
  @include squish-text;
  width: $icon-size;
  height: $icon-size;
  &:before {
    @extend %oxygen-font;
    display: block;
    font-size: $icon-size;
    line-height: 1;
  }
}

%icon--FACEBOOK {
  @include icon-replace(16px);
  &:before { content: "facebook"; }
}
```

#### Fallbacks

We're using [Jacket](https://github.com/Team-Sass/jacket) to serve extra fallback assets to legacy browsers on an as-needed basis. 
