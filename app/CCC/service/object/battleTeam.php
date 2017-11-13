<?php


namespace App\CCC\service\object;

/**
 * Description of battleTeam
 *
 * @author s-yoshihara
 */
class battleTeam {
    
    private $members;
    public function __construct($members=[]){
        
        $this->members=$members;
    }
    public function leader(){
        return $this->members[0];
    }
    
}
