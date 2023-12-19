<?php

namespace HoldMyGlass\ZapCraft\Services\Traits;

trait ZapCraftControllerTrait
{
    use ZapCraftHelperTrait;

    // generate model
    public function craftController(string $name, string $module): array
    {
        $placeholders = [
            '{{ namespace }}' => $this->getNamespace($name, 'controller', $module),
            '{{ class }}' => $this->getEntityName($name),
            '{{ subFolderNamespace }}' => $this->getSubNameSpaceToImport($name),
            // '{{ class }}' => $this->getClassName($name, 'controller', $module),
            '{{ module }}' => $module,
        ];
        $stub = $this->getStub($name, 'controller', $module);
        $path = $this->getDestination($name, 'controller', $module);
        $path = $this->makeDirectory($path);
        if ($this->checkIfFileExist($path)) {
            return [
                'status' => 'error',
                'message' => 'Controller already exist at: '.$path,
            ];
        }
        if ($this->generateFromStub($stub, $path, $placeholders)) {
            return [
                'status' => 'info',
                'message' => 'Controller created at: '.$path,
            ];
        }
    }
}
