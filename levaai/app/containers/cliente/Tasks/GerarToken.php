<?php

namespace Cliente\Tasks;

use Cliente\Models\Usuario;

class GerarToken
{
    public function executar(Usuario $usuario, string $dispositivo): string
    {
        return $usuario->createToken($dispositivo)->plainTextToken;
    }
}
