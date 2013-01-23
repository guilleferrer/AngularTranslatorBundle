AngularTranslatorBundle
=======================

The AngularTranslator Bundle provides a translator in the client side. 
This translator can be accessed via an angular filter or a service, using service container injection.

Usage

Include the javascript :

```
  @UndfAngularTranslatorBundle/Resources/public/js/services/uTranslator.js
```

Pass a json with all the exposed message keys that will feed your translator from a certain Catalogue.

Just include the twig function, with the name of your Angular module in the first argument and the name of the 
catalogue Domain in the second argument.

```
  {{ utranslator_expose_translations('app', 'UndfExposed') }}
```


Usage:

from a *.html.twig file:

```

{% raw %}

  {{ 'my_key_to_be_translated_existing_in_UndfExposed_catalogue' | trans  }}
  
{% endraw %}

```

if you need to pass parameters pass them with a placeholder %myVariable%


```

{% raw %}

  {{ 'my_key_to_be_translated_existing_in_UndfExposed_catalogue_with_vars' | trans  }}
  
{% endraw %}

```
