<?php

namespace Mbright\Validation\Rule\Validate;

class Upload
{
    /**
     * Validates that the value is an array of file-upload information, and if a file is referred to, that is actually
     * an uploaded file.
     *
     * The required keys are 'error', 'name', 'size', 'tmp_name', 'type'. More or fewer or different keys than this will
     * return a "malformed" error.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;

        $wellFormed = $this->preCheck($value);
        if (!$wellFormed) {
            return false;
        }

        // was the upload explicitly ok?
        $err = $value['error'];
        if ($err != UPLOAD_ERR_OK) {
            return false;
        }

        // is it actually an uploaded file?
        if (!$this->isUploadedFile($value['tmp_name'])) {
            return false;
        }

        return true;
    }

    /**
     * Check that the file-upload array is well-formed.
     *
     * @param array $value The file-upload array.
     *
     * @return bool
     */
    protected function preCheck(&$value)
    {
        if (!is_array($value)) {
            return false;
        }

        // presorted list of expected keys
        $expect = ['error', 'name', 'size', 'tmp_name', 'type'];

        // remove unexpected keys
        foreach ($value as $key => $val) {
            if (!in_array($key, $expect)) {
                unset($value[$key]);
            }
        }

        $actual = array_keys($value);
        sort($actual);
        if ($expect != $actual) {
            return false;
        }

        return true;
    }

    /**
     * Check whether the file was uploaded via HTTP POST.
     *
     * @param string $file The file to check.
     *
     * @return bool True if the file was uploaded via HTTP POST, false if not.
     */
    protected function isUploadedFile($file)
    {
        return is_uploaded_file($file);
    }
}
