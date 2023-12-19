<?php

namespace HoldMyGlass\ZapCraft\Services\Traits;

trait ZapCraftServiceTrait
{
    use ZapCraftHelperTrait;

    // generate model
    public function craftService(string $name, string $module): array
    {
        $placeholders = [
            '{{ namespace }}' => $this->getNamespace($name, 'service', $module),
            '{{ class }}' => $this->getEntityname($name),
            '{{ classLower }}' => $this->getClassLower($this->getEntityname($name)),
            '{{ subFolderNamespace }}' => $this->getSubNameSpaceToImport($name),
            '{{ module }}' => $module,
        ];
        $stub = $this->getStub($name, 'service');
        $path = $this->getDestination($name, 'service', $module);
        $path = $this->makeDirectory($path);
        if ($this->checkIfFileExist($path)) {
            return [
                'status' => 'error',
                'message' => 'Service file already exist at: '.$path,
            ];
        }
        if ($this->generateFromStub($stub, $path, $placeholders)) {
            return [
                'status' => 'info',
                'message' => 'Service file created at: '.$path,
            ];
        }
    }
}
