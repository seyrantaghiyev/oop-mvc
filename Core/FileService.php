<?php

namespace Core;

class FileService
{
    public function hasFile(string $fileName): bool
    {
        return isset($_FILES[$fileName]) && $_FILES[$fileName]['error'] == null;
    }

    public function checkFile(string $fileName): void
    {
        if (!$this->hasFile($fileName)) {
            throw new \Exception('File not found');
        }
    }

    public function validateType(string $fileName, array $extensions): bool
    {
        $this->checkFile($fileName);
        return in_array($this->getFileExtension($fileName), $extensions);
    }

    public function validateSize(string $fileName, string $sizeInKB): bool
    {
        $this->checkFile($fileName);
        $file = $this->file($fileName);
        $size = round($file['size'] / 1024);
        return $size <= $sizeInKB;
    }

    public function getFileExtension(string $fileName): string
    {
        $this->checkFile($fileName);
        return pathinfo($_FILES[$fileName]['full_path'], PATHINFO_EXTENSION);
    }


    public function file(string $fileName)
    {
        $this->checkFile($fileName);
        return $_FILES[$fileName];
    }

    public function upload(string $fileName): false|string
    {
        try {
            $file = $this->file($fileName);
            $extension = $this->getFileExtension($fileName);
            $fileName = generateRandomString() . "." . $extension;
            $destination = UPLOADS_PATH . "/" . $fileName;
            move_uploaded_file($file['tmp_name'], $destination);
            return $fileName;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function delete(string $fileName): void
    {
        $file = UPLOADS_PATH . "/" . $fileName;
        if (file_exists($file)) {
            unlink($file);
        }
    }

    public function replace(string $fileName, ?string $deleteFileName): false|string
    {
        if ($deleteFileName) {
            $this->delete($deleteFileName);
        }
        return $this->upload($fileName);
    }
}
