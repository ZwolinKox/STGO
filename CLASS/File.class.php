<?php 

class File {

    public function read($filename) {
        $file = file_get_contents($filename, true);
        return $file;
    }

    public function readSingleLine($filename) {
        $file = fopen($filename, 'r', true) or self::throw();

        $return = fgets($file);
        fclose($file);
        return $return;
    }

    public function readSingleCharacter($filename) {
        $file = fopen($filename, 'r', true) or self::throw();

        $return = fgetc($file);
        fclose($file);
        return $return;
    }

    private function throw() {
        throw new Exception("Unable to open file!");
    }

    public function write($fileName, $value) {
        $file = fopen($fileName, "w", true) or self::throw();
        fwrite($file, $value);
        fclose($file);
    }
}