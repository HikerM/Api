<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * Model AdminRoleModel
 * 
 * @property int $id 
 * @property string $name 角色名称
 * @property string $description 角色描述
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property int $is_on 0为已删除，1为正常
 *
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminRoleModel where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminRoleModel whereIn($column, $values, $boolean = 'and', $not = false)
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminRoleModel leftJoin($table, $first, $operator = null, $second = null)
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminRoleModel rightJoin($table, $first, $operator = null, $second = null)
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminRoleModel get($columns = ['*'])
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminRoleModel paginate($perPage = 15, $columns = ['*'], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminRoleModel find($id, $columns = ['*'])
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminRoleModel first($columns = ['*'])
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminRoleModel select($columns = ['*'])
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminRoleModel orderBy($column, $direction = 'asc')
 * @package App\Model
 */
class AdminRoleModel extends Model
{
    protected $table = 'admin_role';


    protected $casts = [
        'id' => 'string',   //把id返回字符串
    ];

   /**
     * 角色权限
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany('\App\Model\AdminPermissionModel','admin_role_permission','role_id','permission_id');
    }

    /**
     * 角色对应的管理员
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function admins()
    {
        return $this->belongsToMany('\App\Model\AdminUserModel','admin_user_role','role_id','user_id');
    }

}