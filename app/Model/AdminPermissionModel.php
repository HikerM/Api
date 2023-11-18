<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * Model AdminPermissionModel
 * 
 * @property int $id 
 * @property string $name 权限名称
 * @property string $code 规则代码
 * @property string $description 描述
 * @property int $parent_id 父级id
 * @property int $level 层级，1级为组，2级为权限
 * @property int $sort 排序(从小到大)
 * @property int $route_id 路由id
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property int $is_on 0为已删除，1为正常
 *
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminPermissionModel where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminPermissionModel whereIn($column, $values, $boolean = 'and', $not = false)
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminPermissionModel leftJoin($table, $first, $operator = null, $second = null)
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminPermissionModel rightJoin($table, $first, $operator = null, $second = null)
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminPermissionModel get($columns = ['*'])
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminPermissionModel paginate($perPage = 15, $columns = ['*'], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminPermissionModel find($id, $columns = ['*'])
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminPermissionModel first($columns = ['*'])
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminPermissionModel select($columns = ['*'])
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminPermissionModel orderBy($column, $direction = 'asc')
 * @package App\Model
 */
class AdminPermissionModel extends Model
{
    protected $table = 'admin_permissions';

}