<?php

namespace HoldMyGlass\ZapCraft\Services\Traits;

trait ZapCraftRouteTrait
{
    use ZapCraftHelperTrait;

    // generate model
    public function craftRoute(string $name, string $module): array
    {
        $placeholders = [
            '{{ class }}' => $this->getEntityname($name),
            '{{ classLower }}' => $this->getClassLower($this->getEntityname($name)),
            '{{ classLowerParam }}' => '{'.lcfirst($this->getClassLower($this->getEntityname($name))).'}',
            '{{ subFolderNamespace }}' => $this->getSubNameSpaceToImport($name),
            '{{ module }}' => $module,
        ];
        $stub = $this->getStub($name, 'route');
        $path = $this->getDestination($name, 'route', $module);
        $path = $this->makeDirectory($path);
        if ($this->checkIfFileExist($path)) {
            return [
                'status' => 'error',
                'message' => 'Route file already exist at: '.$path,
            ];
        }
        if ($this->generateFromStub($stub, $path, $placeholders)) {
            return [
                'status' => 'info',
                'message' => 'Route file created at: '.$path,
            ];
        }
    }

    public function addRoutes(string $name, string $module): void
    {
        $linesToAdd = '

# '.$this->getClassName($name, 'controller', $module)." routes
require __DIR__ . '/api/".$this->getClassLower($name).".php';

        ";
        $apiFilePath = base_path()."/Modules/{$module}/routes/api.php";
        file_put_contents($apiFilePath, file_get_contents($apiFilePath).$linesToAdd);
    }
}
