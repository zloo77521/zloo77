<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class Nva extends Model
{
    //安全字段
    protected $fillable = ['name','url','permission_id','pid'];
    use HasPermissions;
    protected  $guard_name  =  'web' ;

    //导航菜单  权限   关系： 1对多（反向）
    public function permission(){
        return $this->belongsTo(Permission::class,'permission_id','id');
    }
}
