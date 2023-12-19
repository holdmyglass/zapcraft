<?php

namespace HoldMyGlass\ZapCraft\Services\Traits;

trait ZapCraftCollectionTrait
{
    use ZapCraftHelperTrait;

    // generate model
    public function craftCollection(string $name, string $module): array
    {
        $placeholders = [
            '{{ namespace }}' => $this->getNamespace($name, 'collection', $module),
            '{{ class }}' => $this->getEntityname($name),
            '{{ classLower }}' => $this->getClassLower($this->getEntityname($name)),
            '{{ subFolderNamespace }}' => $this->getSubNameSpaceToImport($name),
            '{{ module }}' => $module,
        ];
        $stub = $this->getStub($name, 'collection');
        $path = $this->getDestination($name, 'collection', $module);
        $path = $this->makeDirectory($path);
        if ($this->checkIfFileExist($path)) {
            return [
                'status' => 'error',
                'message' => 'Collection file already exist at: '.$path,
            ];
        }
        if ($this->generateFromStub($stub, $path, $placeholders)) {
            return [
                'status' => 'info',
                'message' => 'Collection file created at: '.$path,
            ];
        }
    }
}
