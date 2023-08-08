<?php

namespace FoxyMVC\Lib\Foxy\Core;

class Response {
    public static int $code = 200;

    public static function checkMethod(string $method) {
        if ($_SERVER['REQUEST_METHOD'] != $method) {
            Response::status(405)->end("El método indicado no esta permitido para esta url.");
        }
    }

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
        header('HTTP/1.1 ' . self::$code);
        exit;
    }

    public static function blob(string $filename) {
        header('HTTP/1.1 ' . self::$code);
        header("Content-Type: application/octet-stream");
        header("Content-Length: " . filesize($filename));
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');

        readfile($filename);
        exit;
    }

    public static function image(string $filename) {
        header('HTTP/1.1 ' . self::$code);
        header('Content-Type: image/jpeg');
        header("Content-Length: " . filesize($filename));
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');

        readfile($filename);
        exit;
    }

    public static function audio(string $filename) {
        header('HTTP/1.1 ' . self::$code);
        header('Content-Type: audio/mp3');
        header("Content-Length: " . filesize($filename));
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');

        readfile($filename);
        exit;
    }

    public static function end(string $text = "") {
        header("Content-Type: text/plain");
        header("Content-Length: " . strlen($text));
        header('HTTP/1.1 ' . self::$code);

        ob_implicit_flush();
        echo $text;

        exit;
    }
}
