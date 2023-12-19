<?php

namespace HoldMyGlass\ZapCraft\Services\Traits;

trait ZapCraftDtoTrait
{
    use ZapCraftHelperTrait;

    // generate model
    public function craftDTO(string $name, string $module): array
    {
        $placeholders = [
            '{{ namespace }}' => $this->getNamespace($name, 'dto', $module),
            '{{ class }}' => $this->getEntityname($name),
            '{{ subFolderNamespace }}' => $this->getSubNameSpaceToImport($name),
            '{{ module }}' => $module,
        ];
        $stub = $this->getStub($name, 'dto');
        $path = $this->getDestination($name, 'dto', $module);
        $path = $this->makeDirectory($path);
        if ($this->checkIfFileExist($path)) {
            return [
                'status' => 'error',
                'message' => 'DTO file already exist at: '.$path,
            ];
        }
        if ($this->generateFromStub($stub, $path, $placeholders)) {
            return [
                'status' => 'info',
                'message' => 'DTO file created at: '.$path,
            ];
        }
    }
}
