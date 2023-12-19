<?php

namespace HoldMyGlass\ZapCraft\Services\Traits;

trait ZapCraftResourceTrait
{
    use ZapCraftHelperTrait;

    // generate model
    public function craftResource(string $name, string $module): array
    {
        $placeholders = [
            '{{ namespace }}' => $this->getNamespace($name, 'resource', $module),
            '{{ class }}' => $this->getEntityname($name),
            '{{ classLower }}' => $this->getClassLower($this->getEntityname($name)),
            '{{ subFolderNamespace }}' => $this->getSubNameSpaceToImport($name),
            '{{ module }}' => $module,
        ];
        $stub = $this->getStub($name, 'resource');
        $path = $this->getDestination($name, 'resource', $module);
        $path = $this->makeDirectory($path);
        if ($this->checkIfFileExist($path)) {
            return [
                'status' => 'error',
                'message' => 'Resource file already exist at: '.$path,
            ];
        }
        if ($this->generateFromStub($stub, $path, $placeholders)) {
            return [
                'status' => 'info',
                'message' => 'Resource file created at: '.$path,
            ];
        }
    }
}
