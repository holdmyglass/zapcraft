<?php

namespace HoldMyGlass\ZapCraft\Services\Traits;

trait ZapCraftInterfaceTrait
{
    use ZapCraftHelperTrait;

    // generate model
    public function craftInterface(string $element, string $name, string $module): array
    {
        $placeholders = [
            '{{ namespace }}' => $this->getNamespace($name, $element, $module),
            '{{ class }}' => $this->getEntityname($name),
            '{{ classLower }}' => $this->getClassLower($this->getEntityname($name)),
            '{{ subFolderNamespace }}' => $this->getSubNameSpaceToImport($name),
            '{{ module }}' => $module,
        ];
        $stub = $this->getStub($name, $element);
        $path = $this->getDestination($name, $element, $module);
        $path = $this->makeDirectory($path);
        if ($this->checkIfFileExist($path)) {
            return [
                'status' => 'error',
                'message' => 'Interface already exist at: '.$path,
            ];
        }
        if ($this->generateFromStub($stub, $path, $placeholders)) {
            return [
                'status' => 'info',
                'message' => 'Interface created at: '.$path,
            ];
        }
    }
}
