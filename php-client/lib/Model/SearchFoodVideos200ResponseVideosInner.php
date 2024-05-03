<?php
/**
 * SearchFoodVideos200ResponseVideosInner
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
 * SearchFoodVideos200ResponseVideosInner Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class SearchFoodVideos200ResponseVideosInner implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'searchFoodVideos_200_response_videos_inner';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'title' => 'string',
        'length' => 'int',
        'rating' => 'float',
        'short_title' => 'string',
        'thumbnail' => 'string',
        'views' => 'int',
        'you_tube_id' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'title' => null,
        'length' => null,
        'rating' => null,
        'short_title' => null,
        'thumbnail' => null,
        'views' => null,
        'you_tube_id' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'title' => false,
        'length' => false,
        'rating' => false,
        'short_title' => false,
        'thumbnail' => false,
        'views' => false,
        'you_tube_id' => false
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
        'title' => 'title',
        'length' => 'length',
        'rating' => 'rating',
        'short_title' => 'shortTitle',
        'thumbnail' => 'thumbnail',
        'views' => 'views',
        'you_tube_id' => 'youTubeId'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'title' => 'setTitle',
        'length' => 'setLength',
        'rating' => 'setRating',
        'short_title' => 'setShortTitle',
        'thumbnail' => 'setThumbnail',
        'views' => 'setViews',
        'you_tube_id' => 'setYouTubeId'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'title' => 'getTitle',
        'length' => 'getLength',
        'rating' => 'getRating',
        'short_title' => 'getShortTitle',
        'thumbnail' => 'getThumbnail',
        'views' => 'getViews',
        'you_tube_id' => 'getYouTubeId'
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
        $this->setIfExists('title', $data ?? [], null);
        $this->setIfExists('length', $data ?? [], null);
        $this->setIfExists('rating', $data ?? [], null);
        $this->setIfExists('short_title', $data ?? [], null);
        $this->setIfExists('thumbnail', $data ?? [], null);
        $this->setIfExists('views', $data ?? [], null);
        $this->setIfExists('you_tube_id', $data ?? [], null);
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

        if ($this->container['title'] === null) {
            $invalidProperties[] = "'title' can't be null";
        }
        if ((mb_strlen($this->container['title']) < 1)) {
            $invalidProperties[] = "invalid value for 'title', the character length must be bigger than or equal to 1.";
        }

        if ($this->container['length'] === null) {
            $invalidProperties[] = "'length' can't be null";
        }
        if ($this->container['rating'] === null) {
            $invalidProperties[] = "'rating' can't be null";
        }
        if ($this->container['short_title'] === null) {
            $invalidProperties[] = "'short_title' can't be null";
        }
        if ((mb_strlen($this->container['short_title']) < 1)) {
            $invalidProperties[] = "invalid value for 'short_title', the character length must be bigger than or equal to 1.";
        }

        if ($this->container['thumbnail'] === null) {
            $invalidProperties[] = "'thumbnail' can't be null";
        }
        if ((mb_strlen($this->container['thumbnail']) < 1)) {
            $invalidProperties[] = "invalid value for 'thumbnail', the character length must be bigger than or equal to 1.";
        }

        if ($this->container['views'] === null) {
            $invalidProperties[] = "'views' can't be null";
        }
        if ($this->container['you_tube_id'] === null) {
            $invalidProperties[] = "'you_tube_id' can't be null";
        }
        if ((mb_strlen($this->container['you_tube_id']) < 1)) {
            $invalidProperties[] = "invalid value for 'you_tube_id', the character length must be bigger than or equal to 1.";
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
     * Gets title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     *
     * @param string $title title
     *
     * @return self
     */
    public function setTitle($title)
    {
        if (is_null($title)) {
            throw new \InvalidArgumentException('non-nullable title cannot be null');
        }

        if ((mb_strlen($title) < 1)) {
            throw new \InvalidArgumentException('invalid length for $title when calling SearchFoodVideos200ResponseVideosInner., must be bigger than or equal to 1.');
        }

        $this->container['title'] = $title;

        return $this;
    }

    /**
     * Gets length
     *
     * @return int
     */
    public function getLength()
    {
        return $this->container['length'];
    }

    /**
     * Sets length
     *
     * @param int $length length
     *
     * @return self
     */
    public function setLength($length)
    {
        if (is_null($length)) {
            throw new \InvalidArgumentException('non-nullable length cannot be null');
        }
        $this->container['length'] = $length;

        return $this;
    }

    /**
     * Gets rating
     *
     * @return float
     */
    public function getRating()
    {
        return $this->container['rating'];
    }

    /**
     * Sets rating
     *
     * @param float $rating rating
     *
     * @return self
     */
    public function setRating($rating)
    {
        if (is_null($rating)) {
            throw new \InvalidArgumentException('non-nullable rating cannot be null');
        }
        $this->container['rating'] = $rating;

        return $this;
    }

    /**
     * Gets short_title
     *
     * @return string
     */
    public function getShortTitle()
    {
        return $this->container['short_title'];
    }

    /**
     * Sets short_title
     *
     * @param string $short_title short_title
     *
     * @return self
     */
    public function setShortTitle($short_title)
    {
        if (is_null($short_title)) {
            throw new \InvalidArgumentException('non-nullable short_title cannot be null');
        }

        if ((mb_strlen($short_title) < 1)) {
            throw new \InvalidArgumentException('invalid length for $short_title when calling SearchFoodVideos200ResponseVideosInner., must be bigger than or equal to 1.');
        }

        $this->container['short_title'] = $short_title;

        return $this;
    }

    /**
     * Gets thumbnail
     *
     * @return string
     */
    public function getThumbnail()
    {
        return $this->container['thumbnail'];
    }

    /**
     * Sets thumbnail
     *
     * @param string $thumbnail thumbnail
     *
     * @return self
     */
    public function setThumbnail($thumbnail)
    {
        if (is_null($thumbnail)) {
            throw new \InvalidArgumentException('non-nullable thumbnail cannot be null');
        }

        if ((mb_strlen($thumbnail) < 1)) {
            throw new \InvalidArgumentException('invalid length for $thumbnail when calling SearchFoodVideos200ResponseVideosInner., must be bigger than or equal to 1.');
        }

        $this->container['thumbnail'] = $thumbnail;

        return $this;
    }

    /**
     * Gets views
     *
     * @return int
     */
    public function getViews()
    {
        return $this->container['views'];
    }

    /**
     * Sets views
     *
     * @param int $views views
     *
     * @return self
     */
    public function setViews($views)
    {
        if (is_null($views)) {
            throw new \InvalidArgumentException('non-nullable views cannot be null');
        }
        $this->container['views'] = $views;

        return $this;
    }

    /**
     * Gets you_tube_id
     *
     * @return string
     */
    public function getYouTubeId()
    {
        return $this->container['you_tube_id'];
    }

    /**
     * Sets you_tube_id
     *
     * @param string $you_tube_id you_tube_id
     *
     * @return self
     */
    public function setYouTubeId($you_tube_id)
    {
        if (is_null($you_tube_id)) {
            throw new \InvalidArgumentException('non-nullable you_tube_id cannot be null');
        }

        if ((mb_strlen($you_tube_id) < 1)) {
            throw new \InvalidArgumentException('invalid length for $you_tube_id when calling SearchFoodVideos200ResponseVideosInner., must be bigger than or equal to 1.');
        }

        $this->container['you_tube_id'] = $you_tube_id;

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


