# Setup
Add `rp_translationhelper` in `perch/config/apps.php`.
The app requires a variable `lang` (returning a language code such as `en`, `fr`, `de`, etc.) to be available in template.

# Usage
## Static string
`<perch:translate id="myTranslation1" en="Static string" fr="Contenu static" />`


## perch:content
To use dynamic content coming from `<perch:content>`, add an id surouded by pipes.

`<perch:content id="content_en" type="text" />`
`<perch:content id="content_fr" type="text" />`

Can then be used:
`<perch:translate id="myTranslation2" en="|content_en|" fr="|content_fr|" />`