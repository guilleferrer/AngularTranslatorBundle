angular.module('uTrans', ['ng']).value('version', '0.1').value('translations').factory('uTrans', function (translations) {

    if (!angular.isObject(translations)) {

        throw 'uTrans error. If you use the translations module you must set an object of translations as the configuration of the uTrans module. \n' + 'angular.module("uTrans").value("translations", [{ "text %varialbe%" : "Traducción" } ]); ' + '\n});' + '\n\nUse the following format : \n\n' + '\n{\n' + '    "keyToTranslate1" : "Translation1",\n' + '    "keyToTranslate2": "Translation2"\n' + '};';
    }
    // Get them from the config
    var translator = {};

    translator.translations = translations;
    /**
     * Searches a translation for the given 'text'
     * in the object of translations
     *
     **/
    translator.trans = function (text, params) {

        // Validate the arguments
        if (typeof text !== 'string') {
            throw 'uTrans error. The text to translate should be an string. A "' + (typeof text) + '" was given';
        }

        // Validate the arguments
        if (params !== undefined && !angular.isObject(params)) {
            throw 'uTrans error . The parameters provided for the translation of "' + text + '" must be an Object and a "' + (typeof params) + '" has been provided';
        }

        var translated = translations[text];
        // No translation found
        if (translated === undefined) {
            return '_' + text + '_';
        }

        // Translation has been found
        else {
            // I have options
            angular.forEach(params, function (val, key) {
                // Find key in translated
                translated = translated.replace(new RegExp(key, 'g'), val);
            });

            return translated;
        }
    }

    return translator;
}).filter('trans', function (uTrans) {

    return function (text, params) {
        return uTrans.trans(text, params);
    }
});