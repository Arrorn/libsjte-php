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

class sjtePermutation implements Permutation{
    protected $permIndex = 1;
    protected $permutation = array();
    protected $directions = array();
    protected $moving = 0;
    protected $count = 0;
    protected $total = 1;

    public function __construct(array &$permute){
        $count = &$this->count;
        $count = count($permute);
        $dir = &$this->directions;
        $perm = &$this->permutation;
        $total = &$this->total;
        for($i=1;$i<=$count;++$i){
            $total = $total * $i;
            $perm[$i-1] = $permute[$i-1];
            $dir[$i-1] = -1;
        }
        $total = ceil($total / 2);
        $dir[0] = 0;
        $this->moving = $count - 1;
    }

    static public function current($obj){
        $return = array();
        $count = $obj->count;
        $perm = $obj->permutation;
        for($i = 0; $i < $count; ++$i){
            $return[$i] = $perm[$i];
        }
        return $return;
    }

    static public function key($obj){
        return $obj->permIndex;
    }

    static public function next($obj){
        $moving = &$obj->moving;
        $directions = &$obj->directions;
        $permutation = &$obj->permutation;
        $count = &$obj->count;
        $cur = $moving;
        $swap = $cur + $directions[$cur];
        $temp = $permutation[$swap];
        $tempDir = $directions[$swap];
        $permutation[$swap] = $permutation[$cur];
        $directions[$swap] = $directions[$cur];
        $permutation[$cur] = $temp;
        $directions[$cur] = $tempDir;
        $next = $swap + $directions[$swap];
        if($swap == 0 || $swap == ($count-1) || $permutation[$next] > $permutation[$swap]){
            $directions[$swap] = 0;
        }
        for($i = 0; $i < $count; ++$i){
            if($i < $swap && $permutation[$i] > $permutation[$swap]){
                $directions[$i] = 1;
            }
            elseif($i > $swap && $permutation[$i] > $permutation[$swap]){
                $directions[$i] = -1;
            }
            if($directions[$moving] == 0 || ($directions[$i] != 0 && $permutation[$i] > $permutation[$moving])){
                $moving = $i;
            }
        }
        ++$obj->permIndex;
    }

    static public function rewind($obj){
        $permutation = &$obj->permutation;
        $directions = &$obj->directions;
        $count = $obj->count;
        sort($permutation);
        $directions = array_fill(1,$count-1,-1);
        $directions[0] = 0;
        $obj->permIndex = 1;
        $obj->moving = $count - 1;
    }

    static public function valid($obj){
        return $obj->permIndex <= $obj->total;
    }

}
?>
