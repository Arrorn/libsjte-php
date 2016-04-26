<?php

interface Permutation{
    static public function current($obj);
    static public function key($obj);
    static public function next($obj);
    static public function rewind($obj);
    static public function valid($obj);
}

?>
