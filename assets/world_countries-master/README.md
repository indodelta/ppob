<img src="https://raw.githubusercontent.com/stefangabos/zebrajs/master/docs/images/logo.png" alt="zebrajs" align="right">

# World countries &nbsp;[![Tweet](https://img.shields.io/twitter/url/http/shields.io.svg?style=social)](https://twitter.com/intent/tweet?text=Constantly%20updated%20lists%20of%20world%20countries%20and%20their%20ISO%203166%20codes,%20available%20in%20MySQL,%20JSON%20and%20CSV%20formats,%20in%20multiple%20languages%20and%20with%20national%20flags%20included&url=https://github.com/stefangabos/world_countries&via=stefangabos&hashtags=countries,flags,iso-3166)

*available in multiple languages, in SQL, JSON and CSV formats, with associated codes as defined by the ISO 3166 standard, and with national flags included*

[![License](https://img.shields.io/github/license/stefangabos/world_countries.svg)](https://github.com/stefangabos/world_countries/blob/master/LICENSE.md)

Constantly updated lists of world countries and associated *alpha-2*, *alpha-3* and *numeric codes* as defined by the **ISO 3166** standard published and maintained by the [International Organization for Standardization](https://www.iso.org/iso-3166-country-codes.html), available in `MySQL`, `JSON` and `CSV` formats, in multiple languages and with national flags included.

The files contain:

- the **ISO 3166-1 numeric** country codes
- the **ISO 3166** official short names in *English*<small><sup>[1](#footnote)</sup></small>
- the **ISO 3166-1 alpha-2** two-letter country codes
- the **ISO 3166-1 alpha-3** three-letter country codes

<small><a name="footnote"><sup>1</sup></a> for other languages the country names are in that particular language</small>

The lists are currently available in **21 languages**:

- Arabic
- Chinese
- Czech
- Dutch
- English
- French
- German
- Greek
- Hungarian
- Italian
- Japanese
- Lithuanian
- Norwegian
- Polish
- Portuguese
- Romanian
- Russian
- Slovak
- Spanish
- Thai
- Ukrainian

Excerpt from the `data/en/countries.sql` file:

```sql
...
(250, 'France', 'fr', 'fra'),
(254, 'French Guiana', 'gf', 'guf'),
(258, 'French Polynesia', 'pf', 'pyf'),
(260, 'French Southern Territories', 'tf', 'atf'),
(266, 'Gabon', 'ga', 'gab'),
(270, 'Gambia', 'gm', 'gmb'),
(268, 'Georgia', 'ge', 'geo'),
(276, 'Germany', 'de', 'deu'),
...
```

Excerpt from the `data/en/countries.csv` file:

```csv
...
250,France,fr,fra
254,"French Guiana",gf,guf
258,"French Polynesia",pf,pyf
260,"French Southern Territories",tf,atf
266,Gabon,ga,gab
270,Gambia,gm,gmb
268,Georgia,ge,geo
276,Germany,de,deu
...
```

Excerpt from the `data/en/countries.json` file:

```json
...
{"id":250,"name":"France","alpha2":"fr","alpha3":"fra"},
{"id":254,"name":"French Guiana","alpha2":"gf","alpha3":"guf"},
{"id":258,"name":"French Polynesia","alpha2":"pf","alpha3":"pyf"},
{"id":260,"name":"French Southern Territories","alpha2":"tf","alpha3":"atf"},
{"id":266,"name":"Gabon","alpha2":"ga","alpha3":"gab"},
{"id":270,"name":"Gambia","alpha2":"gm","alpha3":"gmb"},
{"id":268,"name":"Georgia","alpha2":"ge","alpha3":"geo"},
{"id":276,"name":"Germany","alpha2":"de","alpha3":"deu"},
...
```

The package also contains the national flags of each country as a 16x16, 24x24, 32x32, 48x48, 64x64 and 128x128 PNG images, courtesy of [IconDrawer](http://icondrawer.com/free.php). The image files are named using the ISO 3166-1-alpha-2 code of the country they represent, for easily pairing flags with countries.

## Sources

Country names in all languages are taken from [Wikipedia](https://en.wikipedia.org/wiki/ISO_3166-1).

## Support the development of this project

[![Donate](https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=BPBPYP293BRLC)
