<?php

namespace HoldMyGlass\ZapCraft\Services\Traits;

trait ZapCraftRequestTrait
{
    use ZapCraftHelperTrait;

    // generate model
    public function craftRequest(string $element, string $name, string $module): array
    {

        $placeholders = [
            '{{ namespace }}' => $this->getNamespace($name, $element, $module),
            '{{ class }}' => $this->getClassName($name, $element, $module),
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
                'message' => 'Request file already exist at: '.$path,
            ];
        }
        if ($this->generateFromStub($stub, $path, $placeholders)) {
            return [
                'status' => 'info',
                'message' => 'Request file created at: '.$path,
            ];
        }
    }
}
