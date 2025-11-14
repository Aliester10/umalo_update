class JobDepartment extends Model
{
    protected $fillable = ['name', 'slug'];

    public function positions()
    {
        return $this->hasMany(JobPosition::class, 'department_id');
    }
}
