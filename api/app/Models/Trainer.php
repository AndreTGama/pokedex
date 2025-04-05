<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Trainer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The $fillable property specifies which attributes are mass assignable.
     * This is used to protect against mass-assignment vulnerabilities by
     * explicitly defining the fields that can be filled via user input.
     *
     * @var array
     * @property string $name The name of the trainer.
     * @property string $email The email address of the trainer.
     * @property string $phone The phone number of the trainer.
     * @property \Illuminate\Support\Carbon|null $email_verified_at The timestamp when the email was verified.
     * @property \Illuminate\Support\Carbon|null $created_at The timestamp when the trainer record was created.
     * @property \Illuminate\Support\Carbon|null $updated_at The timestamp when the trainer record was last updated.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'email_verified_at',
        'created_at',
        'updated_at',
    ];

    protected $hidden = ['password'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     * 
     * - 'email_verified_at': Casts the attribute to a datetime instance.
     * - 'deleted_at': Casts the attribute to a datetime instance.
     * - 'created_at': Casts the attribute to a datetime instance.
     * - 'updated_at': Casts the attribute to a datetime instance.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    /**
     * Mutator to hash the user's password before saving it to the database.
     *
     * @param string $value The plain text password to be hashed.
     * @return void
     */
    function setPasswordAttribute(string $value): void
    {
        $this->attributes['password'] = bcrypt($value);
    }
    
    /**
     * Get the password attribute.
     *
     * @return string
     */
    function getAuthPassword(): string
    {
        return $this->attributes['password'];
    }
}
