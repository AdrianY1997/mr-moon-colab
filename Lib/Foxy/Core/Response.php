<?php

namespace FoxyMVC\Lib\Foxy\Core;

class Response {
    public static int $code;

    public static function status(int $code) {
        self::$code = $code;
        return new self;
    }

    public static function send(mixed $arg) {
        $type = match (gettype($arg)) {
            "array" => "json",
            "string" => "end",
        };
        self::$type($arg);
        exit;
    }

    public static function json(array $data) {
        header("Content-Type: application/json");
        echo json_encode($data);
        header('HTTP/1.1 200 OK');
        exit;
    }

    public static function blob(string $filename) {
        header('HTTP/1.1 200 Archivo enviado');
        header("Content-Type: application/octet-stream");
        header("Content-Length: " . filesize($filename));
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');

        readfile($filename);
        exit;
    }

    public static function image(string $filename) {
        header('HTTP/1.1 200 OK');
        header('Content-Type: image/jpeg');
        header("Content-Length: " . filesize($filename));
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');

        readfile($filename);
        exit;
    }

    public static function audio(string $filename) {
        header('HTTP/1.1 200 OK');
        header('Content-Type: audio/mp3');
        header("Content-Length: " . filesize($filename));
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');

        readfile($filename);
        exit;
    }

    public static function end(string $text) {
        header("Content-Type: text/plain");
        header("Content-Length: " . mb_strlen($text));
        header('HTTP/1.1 ' . self::$code ?: 200 . ' ' . $text);

        ob_implicit_flush();
        echo $text;

        exit;
    }
}