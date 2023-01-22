<?php

namespace core;

class Cache
{
    use TSingleton;

    public function set(string $key, string $data, int $seconds = 3600): bool
    {
        $content['data'] = $data;
        $content['end_time'] = time() + $seconds;

        return file_put_contents(CACHE . '/' . md5($key) . '.txt', serialize($content));

    }

    public function get(string $key): array|bool
    {
        $file = CACHE . '/' . md5($key) . '.txt';

        if (file_exists($file)) {
            $content = unserialize(file_get_contents($file));
            if (time() <= $content['end_time']) {
                return $content['data'];
            }
            unlink($file);
        }

        return false;
    }

    public function delete(string $key): bool
    {
        $file = CACHE . '/' . md5($key) . '.txt';
        if (file_exists($file)) {
            return unlink($file);
        }

        return false;

    }
}