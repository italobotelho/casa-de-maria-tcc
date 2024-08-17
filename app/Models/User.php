<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable; //necessário para que o Laravel reconheça este modelo como um modelo de usuário autenticável.

    protected $table = 'usuario_adm'; // Nome da tabela no banco de dados

    protected $fillable = [
        'user', 'senha',
    ];

    // Método para definir a senha criptografada
    public function setSenhaAttribute($value)
    {
        $this->attributes['senha'] = Hash::make($value);
    }

    // Métodos necessários para a interface Authenticatable
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->senha;
    }


}
