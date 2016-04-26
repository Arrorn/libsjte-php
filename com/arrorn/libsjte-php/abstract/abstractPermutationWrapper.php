<?php

abstract class abstractPermutationWrapper implements Iterator{
    protected $perm = null;

    public function current(){
        return $perm::current($this->perm);
    }
    public function key(){
        return $perm::key($this->perm);
    }
    public function next(){
        $perm::next($this->perm);
    }
    public function rewind(){
        $perm::rewind($this->perm);
    }
    public function valid(){
        return $perm::valid($this->perm);
    }

}

 ?>
