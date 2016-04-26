<?php

class sjtePermutationWrapper extends abstractPermutationWrapper{

    public function __construct(array &$permute){
        $this->perm = new sjtePermutation($permute);
    }

}

?>
