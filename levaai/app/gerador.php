<?php

$container = 'Cotacao';

$artefatos = [
    'UI\API\Controllers\CotarFrete' => [
        'Actions0' => 'CotaFrete'
    ],
    'Actions\CotaFrete' => [
        'Tasks0' => 'BuscaBlocos',
        'Tasks1' => 'CalculaPeso',
        'Tasks2' => 'CalculaPrecoPeso',
        'Tasks3' => 'CalculaPrecoAdvaloremEGris',
        'Tasks4' => 'CalculaDificilAcesso',
        'Tasks5' => 'CalculaDespachoEColeta',
        'Tasks6' => 'CalculaPedagio',
    ],
    'Tasks\BuscaBlocos' => [
        'Repositories0' => 'CidadeRepository',
        'Repositories1' => 'BlocoRepository'
    ],
    'Repositories\CidadeRepository' => [
        'Models0' => 'Cidade' 
    ],
    'Repositories\BlocoRepository' => [
        'Models1' => 'Bloco' 
    ],
    'Models\Bloco' => [
        
    ],
    'Models\Cidade' => [
        
    ],
    'Tasks\CalculaPeso' => [
        
    ],
    'Tasks\CalculaPrecoPeso' => [
        
    ],
    'Tasks\CalculaPrecoAdvaloremEGris' => [
        
    ],
    'Tasks\CalculaDificilAcesso' => [
        
    ],
    'Tasks\CalculaDespachoEColeta' => [
        
    ],
    'Tasks\CalculaPedagio' => [
        
    ],

];

foreach ($artefatos as $clase => $dependencias) {

    $namespace = $container . '\\' . $clase;
    
    $importacoes = '';
    foreach ($dependencias as $namespaceRelativo => $classeDependencia) {
        $importacoes .= 'use ' . $container . '\\' . substr($namespaceRelativo, 0, -1) . '\\' . $classeDependencia . ';' . PHP_EOL;
    }

    $propriedades = '';
    foreach ($dependencias as $namespaceDependencia => $tipo) {
        $propriedades .= 'private ' . $tipo . ' $' . lcfirst($tipo) . substr($namespaceDependencia, 0, -2) . ';'  . PHP_EOL;
    }

    $parametrosConstrutor = '';
    foreach ($dependencias as $namespaceDependencia => $tipo) {
        $parametrosConstrutor .= $tipo . ' $' . lcfirst($tipo) . substr($namespaceDependencia, 0, -2);

        if ($namespaceDependencia !== array_key_last($dependencias)) {
            $parametrosConstrutor .= ','  . PHP_EOL;
        }
    }

    $atribuicoesConstrutor = '';
    foreach ($dependencias as $namespaceDependencia => $tipo) {
        $atribuicoesConstrutor .= '$this->' . lcfirst($tipo). substr($namespaceDependencia, 0, -2) .  ' = $' . lcfirst($tipo) . substr($namespaceDependencia, 0 , -2) . ';'  . PHP_EOL;
    }

    $caminho = __DIR__ . '/containers/' . strtolower($container) . '/' . str_replace('\\', '/', $clase) . '.php';

    $clase = explode('\\', $clase);
    $clase = $clase[array_key_last($clase)];

    $conteudo = <<<EOT
<?php

namespace $namespace;

$importacoes

class $clase
{
    $propriedades

    public function __construct(
        $parametrosConstrutor
    )
    {
        $atribuicoesConstrutor
    }

    public function nome() 
    {
        //
    }
}
EOT;

$recursoArquivo = fopen($caminho, 'w');
fwrite($recursoArquivo, $conteudo);
fclose($recursoArquivo);

}

exec('chmod -R 777 ' . __DIR__ . '/containers/');
