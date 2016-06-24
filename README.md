# Performance comparison test of `SymfonyExpressionLanguage` and `OroConfigExpressions` components


It test used **6248** expressions, with same property paths and operations for symfony and oro expression languages.

##For expressions generation below data was used:


###Symfony ExpressionLanguage
####Variables:
```
'context["object"].getTitle()',
'context["object"]',
'context["collection"][0].getTitle()',
'context["collection"][0]',
'context["collection"]',
'context["multidimensional_array_test"]["test"]["1"]["2"]["3"]["4"]["5"]["6"]["7"]["8"]["9"]["0"]',
'context["multidimensional_array_test"]["test"]["1"]["2"]["3"]["4"]["5"]["6"]["7"]["8"]["9"]',
'context["multidimensional_array_test"]["test"]["1"]["2"]["3"]["4"]["5"]["6"]["7"]["8"]',
'context["multidimensional_array_test"]["test"]["1"]["2"]["3"]["4"]["5"]["6"]["7"]',
'context["multidimensional_array_test"]["test"]["1"]["2"]["3"]["4"]["5"]["6"]',
'context["multidimensional_array_test"]["test"]["1"]["2"]["3"]["4"]["5"]',
'context["multidimensional_array_test"]["test"]["1"]["2"]["3"]["4"]',
'context["multidimensional_array_test"]["test"]["1"]["2"]["3"]',
'context["multidimensional_array_test"]["test"]["1"]["2"]',
'context["multidimensional_array_test"]["test"]["1"]',
'context["multidimensional_array_test"]["test"]',
'context["data"]["nested_object"].getChild().getChild().getChild().getChild().getChild().getChild().getTitle()',
'context["data"]["nested_object"].getChild().getChild().getChild().getChild().getChild().getTitle()',
'context["data"]["nested_object"].getChild().getChild().getChild().getChild().getTitle()',
'context["data"]["nested_object"].getChild().getChild().getChild().getTitle()',
'context["data"]["nested_object"].getChild().getChild().getTitle()',
'context["data"]["nested_object"].getChild().getTitle()',
'context["data"]["nested_object"].getTitle()',
'context["string"]',
'context["bool"]'
```
####Operators:
```
'==',
'>',
'>=',
'<',
'<='
'&&',
'||'
```
####Example:
```yaml
- 'context["object"].getTitle() == context["object"] || context["bool"] <= context["string"]'
```

###Oro ExpressionLanguage

####Variables:
```
'$context.object.title',
'$context.object',
'$context.collection.0.title',
'$context.collection.0',
'$context.collection',
'$context.multidimensional_array_test.test.1.2.3.4.5.6.7.8.9.0',
'$context.multidimensional_array_test.test.1.2.3.4.5.6.7.8.9',
'$context.multidimensional_array_test.test.1.2.3.4.5.6.7.8',
'$context.multidimensional_array_test.test.1.2.3.4.5.6.7',
'$context.multidimensional_array_test.test.1.2.3.4.5.6',
'$context.multidimensional_array_test.test.1.2.3.4.5',
'$context.multidimensional_array_test.test.1.2.3.4',
'$context.multidimensional_array_test.test.1.2.3',
'$context.multidimensional_array_test.test.1.2',
'$context.multidimensional_array_test.test.1',
'$context.multidimensional_array_test.test',
'$context.data.nested_object.child.child.child.child.child.child.title',
'$context.data.nested_object.child.child.child.child.child.title',
'$context.data.nested_object.child.child.child.child.title',
'$context.data.nested_object.child.child.child.title',
'$context.data.nested_object.child.child.title',
'$context.data.nested_object.child.title',
'$context.data.nested_object.title',
'$context.string',
'$context.bool'
```
####Operators:
```
'@eq',
'@gt',
'@gte',
'@lt',
'@lte'
'@and',
'@or'
```
####Example:
```yaml
-
    '@or': [{ '@eq': [{ '@value': $context.object.title }, { '@value': $context.object }] }, { '@lte': [{ '@value': $context.bool }, { '@value': $context.string }] }]
```
###RESULT: Benchmark of parsing expressions from YML file and executing them (calculated by Blackfire).
Environment:
[MacBook Pro 11.5](http://www.everymac.com/systems/apple/macbook_pro/specs/macbook-pro-core-i7-2.5-15-dual-graphics-mid-2015-retina-display-specs.html)
(PHP 7.0.7 with Zend OPcache v7.0.6-dev)

|             | OroConfigExpressions  | SymfonyExpressionLanguage  | SymfonyExpressionLanguage with FileCache enabled  |
|-------------|-----------------------|----------------------------|---------------------------------------------------|
| Expressions | 6248                  | 6248                       | 6248                                              |
| Durations   | 2.98 s                | 8.12 s                     | 1.29 s                                            |
| Memory      | 32 MB                 | 222 MB                     | 5.99 MB                                           |
