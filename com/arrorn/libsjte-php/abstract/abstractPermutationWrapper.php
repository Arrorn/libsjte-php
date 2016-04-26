<?php

abstract class abstractPermutationWrapper implements Iterator{
    protected $perm = null;

    public function current(){
        $perm = $this->perm;
        return $perm::current($this->perm);
    }
    public function key(){
        $perm = $this->perm;
        return $perm::key($this->perm);
    }
    public function next(){
        $perm = $this->perm;
        $perm::next($this->perm);
    }
    public function rewind(){
        $perm = $this->perm;
        $perm::rewind($this->perm);
    }
    public function valid(){
        $perm = $this->perm;
        return $perm::valid($this->perm);
    }

}

 ?>
