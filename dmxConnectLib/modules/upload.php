<?php

namespace modules;

use \lib\App;
use \lib\core\Scope;
use \lib\core\FileSystem;
use \lib\core\Path;

class upload
{
    public $app;
    public $uploaded;

    public function __construct(App $app) {
        $this->app = $app;
    }

    public function upload($options) {
        option_default($options, 'fields', '{{$_POST}}');
        option_default($options, 'path', '/');
        option_default($options, 'overwrite', FALSE);
        option_default($options, 'createPath', TRUE);
        option_default($options, 'throwErrors', FALSE);
        option_default($options, 'template', '');

        $options = $this->app->parseObject($options);

        $this->uploaded = array();

        if ($options->throwErrors) {
            foreach ($_FILES as $file) {
                $error = $file['error'];

                if (is_array($error)) {
                    foreach ($error as $err) {
                        if ($err > 0 && $err != 4) {
                            throw new \Exception("Some files failed to upload. Error code: " . $err);
                        }
                    }
                } elseif ($error > 0 && $error != 4) {
                    throw new \Exception("Some files failed to upload. Error code: " . $error);
                }
            }
        }

        $options->path = Path::toSystemPath($options->path);

        if (!FileSystem::isdir($options->path)) {
            if ($options->createPath) {
                if (!FileSystem::mkdir($options->path, 0777, TRUE)) {
                    throw new \Exception("Upload path could not be created.");
                }
            } else {
                throw new \Exception("Upload path doesn't exist.");
            }
        }

        if (is_array($options->fields)) {
            $this->parse($options->fields, $options);
        }

        return (isset($options->fields['isFile']) && $options->fields['isFile'] === TRUE)
            ? (isset($this->uploaded[0]) ? $this->uploaded[0] : NULL)
            : $this->uploaded;
    }

    private function parse(&$fields, $options) {
        if (isset($fields['isFile']) && $fields['isFile'] === TRUE) {
            if ($fields['error'] == 0 && !isset($fields['processed'])) {
                $path = $options->path . DIRECTORY_SEPARATOR . $fields['name'];

                if ($options->template) {
                    $path = Path::parseTemplate($path, $options->template);
                }

                if (FileSystem::exists($path)) {
                    if ($options->overwrite) {
                        FileSystem::unlink($path);
                    } else {
                        $path = Path::getUniqFile($path);
                    }
                }

                try {
                    if (is_uploaded_file($fields['tmp_name'])) {
                        FileSystem::move_uploaded_file($fields['tmp_name'], $path);
                        $fields['processed'] = TRUE;
                        $fields['name'] = basename($path);
                        $fields['path'] = Path::toAppPath($path);
                        $this->uploaded[] = $fields;
                        //unset($fields['tmp_name']);
                    } else {
                        throw new \Exception('Possible file upload attack.');
                    }
                } catch(\Exception $e) {
                    if ($options->throwErrors) {
                        throw $e;
                    }
                }
            }
        } else {
            foreach ($fields as $key => $value) {
                if (is_array($value)) {
                    $this->parse($fields[$key], $options);
                }
            }
        }
    }
}
