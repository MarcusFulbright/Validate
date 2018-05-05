<?php

namespace Mbright\Validation\Tests\Rule\Validate;

use Mbright\Validation\Rule\Validate\Upload;

class FakeUpload extends Upload
{
    public $is_uploaded_file = true;

    protected function isUploadedFile($file)
    {
        // hit the parent method ...
        parent::isUploadedFile($file);
        // ... but ignore its results.
        return $this->is_uploaded_file;
    }
}
