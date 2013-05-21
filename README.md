AngularTransBundle
=======================

The AngularTranslator Bundle ( Symfony2 ) provides a translator in the client side. 
This translator can be accessed via an angular filter or a service.

Install
====

Include the Bundle from packagist in your composer.json file:
```
require: { "undf/angular-utrans": "dev-master" }
```

Include the javascript :

``` jinja
  @UndfAngularTransBundle/Resources/public/js/services/uTrans.js
```

Pass a json with all the exposed message keys that will feed your translator from a certain Catalogue. 

Just include the twig function, in the first argument and the name of the 
catalogue Domain in the second argument.

``` jinja
  {{ utrans_expose_translations('NameOfTheCatalogueYouWantToExpose', 'locale') }}
```
*utrans_expose_translations* reads the Catalogue "NameOfTheCatalogueYouWantToExpose", using the "translator" service  and creates a { json object } which exposes all the translations to the client side.
So, you don't have to worry about creating this configuration, the Twig function does it for you. This is what the twig helper will do for you:
```` html
<script type="text/javascript">
                    angular.module("uTrans").value("translations", {
                            "key-to-translate" : "Translated String"
           });
</script>
```

This bundle uses an Angular Module called "uTrans"
Don't forget to include this module as a dependency of your AngularJS application.

Example:
```html
<html ng-app="mainModule">
...
</html>
````

```javascript
// You must add the uTrans module in your app's dependencies
angular.module('mainModule', [ 'ng', 'uTrans' , '...' ]);
```
Usage
=====

from a *.html.twig file:

``` jinja

{% raw %}

  {{ 'key_to_translate' | trans  }}  

{# Note that the curly braces are a string that will be interpreted by angularJS #}
  
{% endraw %}

```

if you need to pass parameters pass them with a placeholder %myVariable%


``` html
  {{ 'key_to_translate' | trans: { '%myVariable%' : javascriptVar }  }}

```

You can also use the uTrans Service and allow AngularJS to inject the service for you, wherever you need it:

``` javascript
angular.module('aModule', [ 'uTrans' ]).
    factory('aService', function( uTrans ){ 
    //  uTrans is the service injected by Angular I will use in my 'aService';

        var foo = 'bar';
        var message = uTrans.trans('myKey', { '%param%' : foo })
        alert( message );

});
```
