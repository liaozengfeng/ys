<?php 
namespace app\api\model;

use think\Model;

/**
 * 
 */
class MoveGroup extends Model
{

    protected $table="s_move_group";

    protected $pk = "group_id";

    public function moves(){
        return $this->hasMany("Moves","group_id","group_id");
    }
	
}