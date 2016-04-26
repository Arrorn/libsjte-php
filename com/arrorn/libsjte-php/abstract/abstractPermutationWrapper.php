<?php

abstract class abstractPermutationWrapper implements Iterator{
    protected $perm = null;

    public function current(){
        return Permutation::current($this->perm);
    }
    public function key(){
        return Permutation::key($this->perm);
    }
    public function next(){
        Permutation::next($this->perm);
    }
    public function rewind(){
        Permutation::rewind($this->perm);
    }
    public function valid(){
        return Permutation::valid($this->perm);
    }

}

 ?>
