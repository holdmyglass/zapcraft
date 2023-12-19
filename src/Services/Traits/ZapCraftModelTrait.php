<?php

namespace HoldMyGlass\ZapCraft\Services\Traits;

trait ZapCraftModelTrait
{
    use ZapCraftHelperTrait;

    // generate model
    public function craftModel(string $name, string $module): array
    {
        $placeholders = [
            '{{ namespace }}' => $this->getNamespace($name, 'model', $module),
            '{{ class }}' => $this->getClassName($name, 'model', $module),
            '{{ module }}' => $module,
        ];
        $stub = $this->getStub($name, 'model', $module);
        $path = $this->getDestination($name, 'model', $module);
        $path = $this->makeDirectory($path);
        if ($this->checkIfFileExist($path)) {
            return [
                'status' => 'error',
                'message' => 'Model already exist at: '.$path,
            ];
        }
        if ($this->generateFromStub($stub, $path, $placeholders)) {
            return [
                'status' => 'info',
                'message' => 'Model created at: '.$path,
            ];
        }
    }
}
