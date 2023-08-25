namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
class ValidRole implements Rule
{
    public function passes($attribute, $value)
    {
        return in_array($value, ['teacher', 'manager']);
    }

    public function message()
    {
        return 'The :attribute must be either "teacher" or "manager".';
    }
}