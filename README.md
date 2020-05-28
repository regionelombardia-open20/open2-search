# Amos Search #

Plugin to allow global search on several models. Global search can be extended, possibly, to any module.
To enable global search for a model:
- make the model search class implement the open20\amos\core\interfaces\SearchModelInterface;
- make the model implement the ModelLabelsInterface

### Installation ###

1. The preferred way to install this extension is through [composer](http://getcomposer.org/download/).
    
    Either run
    
    ```bash
    composer require open20/amos-search
    ```
    
    or add
    
    ```
    "open20/amos-search": "~1.0"
    ```
    
    to the require section of your `composer.json` file.
    
2.  Add module to your modules-amos config in backend:
        
    ```php
    <?php
    $config = [
        'modules' => [
            'search' => [
                'class' => 'open20\amos\search\AmosSearch'
            ],
        ],
    ];
    ```
    
3. Enable the search bar add to backend/params-local  

search navbar menu
```php
'searchNavbar' => true
```  

### Module configurations ###

* **enableNetworkScope** - boolean, default = false  
If true, when the scope is within a network (eg. in a community) only the network contents results are shown

