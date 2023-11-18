<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * Model AdminRolePermissionModel
 * 
 * @property int $id 
 * @property int $admin_role_id 
 * @property int $admin_permission_id 
 *
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminRolePermissionModel where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminRolePermissionModel whereIn($column, $values, $boolean = 'and', $not = false)
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminRolePermissionModel leftJoin($table, $first, $operator = null, $second = null)
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminRolePermissionModel rightJoin($table, $first, $operator = null, $second = null)
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminRolePermissionModel get($columns = ['*'])
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminRolePermissionModel paginate($perPage = 15, $columns = ['*'], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminRolePermissionModel find($id, $columns = ['*'])
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminRolePermissionModel first($columns = ['*'])
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminRolePermissionModel select($columns = ['*'])
 * @method static \Illuminate\Database\Query\Builder | \App\Model\AdminRolePermissionModel orderBy($column, $direction = 'asc')
 * @package App\Model
 */
class AdminRolePermissionModel extends Model
{
    protected $table = 'admin_role_permission';

}