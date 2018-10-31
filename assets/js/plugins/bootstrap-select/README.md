bootstrap-select
================

A custom select/multiselect for Bootstrap using button dropdown, designed to behave like regular Bootstrap selects.

## Demo and Documentation

See Bootstrap 3 examples [here](http://thdoan.github.io/bootstrap-select/examples.html) and [here](http://silviomoreto.github.io/bootstrap-select).

## Authors

- [Silvio Moreto](https://github.com/silviomoreto)
- [Ana Carolina](https://github.com/anacarolinats)
- [caseyjhol](https://github.com/caseyjhol)
- [Matt Bryson](https://github.com/mattbryson)
- [t0xicCode](https://github.com/t0xicCode)

## Modifications by [thdoan](https://github.com/thdoan)

- Added option for custom caret icon class
- Added option for thumbnails in `<option>`
- Added title for `<option>` element
- Added aria-hidden="true" for all icons
- Added logic to sync disabled state on 'change' event
- Changed cursor for optgroup headers to 'default'
- Suppressed checkmark element if not multi-select
- Decoupled iconBase class so you can mix and match
- Removed using `<option>` value as title (uses `<select>` title)
- Removed showContent option (add data attribute to show)
- Removed showIcon option (add data attribute to show)
- Removed showSubtext option (add data attribute to show)
- Minor code optimizations

## Usage

Create your `<select>` with the `.selectpicker` class.
```html
<select class="selectpicker">
  <option>Mustard</option>
  <option>Ketchup</option>
  <option>Barbecue</option>
</select>
```

If you use a 1.6.3 or newer, you don't need to to anything else, as the data-api automatically picks up the `<select>`s with the `selectpicker` class.

If you use an older version, you need to add the following either at the bottom of the page (after the last selectpicker), or in a [`$(document).ready()`](http://api.jquery.com/ready/) block.
```js
// To style only <select>s with the selectpicker class
$('select.selectpicker').selectpicker();
```
Or
```js
// To style all <select>s
$('select').selectpicker();
```
If you want to use a custom caret icon:
```js
// Set custom caret icon
$('select.selectpicker').selectpicker({
  caretIcon: 'fa fa-angle-down'
});
```

Check out the [documentation](http://silviomoreto.github.io/bootstrap-select) for further information.

## Copyright and License

Copyright (C) 2013-2015 bootstrap-select

Licensed under [the MIT license](LICENSE).