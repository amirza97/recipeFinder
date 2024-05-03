<?php
/**
 * SearchSiteContent200Response
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * spoonacular API
 *
 * The spoonacular Nutrition, Recipe, and Food API allows you to access over thousands of recipes, thousands of ingredients, 800,000 food products, over 100,000 menu items, and restaurants. Our food ontology and semantic recipe search engine makes it possible to search for recipes using natural language queries, such as \"gluten free brownies without sugar\" or \"low fat vegan cupcakes.\" You can automatically calculate the nutritional information for any recipe, analyze recipe costs, visualize ingredient lists, find recipes for what's in your fridge, find recipes based on special diets, nutritional requirements, or favorite ingredients, classify recipes into types and cuisines, convert ingredient amounts, or even compute an entire meal plan. With our powerful API, you can create many kinds of food and especially nutrition apps.  Special diets/dietary requirements currently available include: vegan, vegetarian, pescetarian, gluten free, grain free, dairy free, high protein, whole 30, low sodium, low carb, Paleo, ketogenic, FODMAP, and Primal.
 *
 * The version of the OpenAPI document: 1.1
 * Contact: mail@spoonacular.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 7.3.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace OpenAPI\Client\Model;

use \ArrayAccess;
use \OpenAPI\Client\ObjectSerializer;

/**
 * SearchSiteContent200Response Class Doc Comment
 *
 * @category Class
 * @description 
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class SearchSiteContent200Response implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'searchSiteContent_200_response';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'articles' => '\OpenAPI\Client\Model\SearchSiteContent200ResponseArticlesInner[]',
        'grocery_products' => '\OpenAPI\Client\Model\SearchSiteContent200ResponseGroceryProductsInner[]',
        'menu_items' => '\OpenAPI\Client\Model\SearchSiteContent200ResponseGroceryProductsInner[]',
        'recipes' => '\OpenAPI\Client\Model\SearchSiteContent200ResponseGroceryProductsInner[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'articles' => null,
        'grocery_products' => null,
        'menu_items' => null,
        'recipes' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'articles' => false,
        'grocery_products' => false,
        'menu_items' => false,
        'recipes' => false
    ];

    /**
      * If a nullable field gets set to null, insert it here
      *
      * @var boolean[]
      */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'articles' => 'Articles',
        'grocery_products' => 'Grocery Products',
        'menu_items' => 'Menu Items',
        'recipes' => 'Recipes'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'articles' => 'setArticles',
        'grocery_products' => 'setGroceryProducts',
        'menu_items' => 'setMenuItems',
        'recipes' => 'setRecipes'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'articles' => 'getArticles',
        'grocery_products' => 'getGroceryProducts',
        'menu_items' => 'getMenuItems',
        'recipes' => 'getRecipes'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->setIfExists('articles', $data ?? [], null);
        $this->setIfExists('grocery_products', $data ?? [], null);
        $this->setIfExists('menu_items', $data ?? [], null);
        $this->setIfExists('recipes', $data ?? [], null);
    }

    /**
    * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
    * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
    * $this->openAPINullablesSetToNull array
    *
    * @param string $variableName
    * @param array  $fields
    * @param mixed  $defaultValue
    */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['articles'] === null) {
            $invalidProperties[] = "'articles' can't be null";
        }
        if ((count($this->container['articles']) < 0)) {
            $invalidProperties[] = "invalid value for 'articles', number of items must be greater than or equal to 0.";
        }

        if ($this->container['grocery_products'] === null) {
            $invalidProperties[] = "'grocery_products' can't be null";
        }
        if ((count($this->container['grocery_products']) < 0)) {
            $invalidProperties[] = "invalid value for 'grocery_products', number of items must be greater than or equal to 0.";
        }

        if ($this->container['menu_items'] === null) {
            $invalidProperties[] = "'menu_items' can't be null";
        }
        if ((count($this->container['menu_items']) < 0)) {
            $invalidProperties[] = "invalid value for 'menu_items', number of items must be greater than or equal to 0.";
        }

        if ($this->container['recipes'] === null) {
            $invalidProperties[] = "'recipes' can't be null";
        }
        if ((count($this->container['recipes']) < 0)) {
            $invalidProperties[] = "invalid value for 'recipes', number of items must be greater than or equal to 0.";
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets articles
     *
     * @return \OpenAPI\Client\Model\SearchSiteContent200ResponseArticlesInner[]
     */
    public function getArticles()
    {
        return $this->container['articles'];
    }

    /**
     * Sets articles
     *
     * @param \OpenAPI\Client\Model\SearchSiteContent200ResponseArticlesInner[] $articles articles
     *
     * @return self
     */
    public function setArticles($articles)
    {
        if (is_null($articles)) {
            throw new \InvalidArgumentException('non-nullable articles cannot be null');
        }


        if ((count($articles) < 0)) {
            throw new \InvalidArgumentException('invalid length for $articles when calling SearchSiteContent200Response., number of items must be greater than or equal to 0.');
        }
        $this->container['articles'] = $articles;

        return $this;
    }

    /**
     * Gets grocery_products
     *
     * @return \OpenAPI\Client\Model\SearchSiteContent200ResponseGroceryProductsInner[]
     */
    public function getGroceryProducts()
    {
        return $this->container['grocery_products'];
    }

    /**
     * Sets grocery_products
     *
     * @param \OpenAPI\Client\Model\SearchSiteContent200ResponseGroceryProductsInner[] $grocery_products grocery_products
     *
     * @return self
     */
    public function setGroceryProducts($grocery_products)
    {
        if (is_null($grocery_products)) {
            throw new \InvalidArgumentException('non-nullable grocery_products cannot be null');
        }


        if ((count($grocery_products) < 0)) {
            throw new \InvalidArgumentException('invalid length for $grocery_products when calling SearchSiteContent200Response., number of items must be greater than or equal to 0.');
        }
        $this->container['grocery_products'] = $grocery_products;

        return $this;
    }

    /**
     * Gets menu_items
     *
     * @return \OpenAPI\Client\Model\SearchSiteContent200ResponseGroceryProductsInner[]
     */
    public function getMenuItems()
    {
        return $this->container['menu_items'];
    }

    /**
     * Sets menu_items
     *
     * @param \OpenAPI\Client\Model\SearchSiteContent200ResponseGroceryProductsInner[] $menu_items menu_items
     *
     * @return self
     */
    public function setMenuItems($menu_items)
    {
        if (is_null($menu_items)) {
            throw new \InvalidArgumentException('non-nullable menu_items cannot be null');
        }


        if ((count($menu_items) < 0)) {
            throw new \InvalidArgumentException('invalid length for $menu_items when calling SearchSiteContent200Response., number of items must be greater than or equal to 0.');
        }
        $this->container['menu_items'] = $menu_items;

        return $this;
    }

    /**
     * Gets recipes
     *
     * @return \OpenAPI\Client\Model\SearchSiteContent200ResponseGroceryProductsInner[]
     */
    public function getRecipes()
    {
        return $this->container['recipes'];
    }

    /**
     * Sets recipes
     *
     * @param \OpenAPI\Client\Model\SearchSiteContent200ResponseGroceryProductsInner[] $recipes recipes
     *
     * @return self
     */
    public function setRecipes($recipes)
    {
        if (is_null($recipes)) {
            throw new \InvalidArgumentException('non-nullable recipes cannot be null');
        }


        if ((count($recipes) < 0)) {
            throw new \InvalidArgumentException('invalid length for $recipes when calling SearchSiteContent200Response., number of items must be greater than or equal to 0.');
        }
        $this->container['recipes'] = $recipes;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


