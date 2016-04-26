<?php

/**
 * Copyright 2016 Arrorn
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

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
