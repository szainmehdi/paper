<?php namespace Paper\Support;

use ArrayAccess;
use Paper\Contracts\Support\Collection as CollectionContract;

class Collection implements ArrayAccess, CollectionContract
{

    /**
     * @var array
     */
    protected $items = [];

    public function __construct(array $items = [])
    {
        $this->merge($items);
    }

    public function push($item)
    {
        $this->items[] = $item;
    }

    public function set($key, $value)
    {
        $this->items[$key] = $value;
    }

    public function get($key)
    {
        return ($this->exists($key) ? $this->items[$key] : $this->getNested($key));
    }

    public function getNested($key){

        return array_get($this->items, $key);
    }

    public function exists($key)
    {
        return (bool)array_key_exists($key, $this->items);;
    }

    public function remove($key)
    {
        unset($this->items[$key]);
    }

    public function setItems(array $items)
    {
        $this->items = $items;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function toArray()
    {
        return $this->getItems();
    }

    public function merge(array $items)
    {
        $this->items = array_merge($items);
    }


    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Whether a offset exists
     *
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     *
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists($offset)
    {
        return $this->exists($offset);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve
     *
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     *
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to set
     *
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        return $this->set($offset, $value);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to unset
     *
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }
}