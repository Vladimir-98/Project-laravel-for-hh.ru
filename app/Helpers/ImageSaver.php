<?php


namespace App\Helpers;

use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class ImageSaver
{

    public function upload($img_arr, $id): array
    {
        $date = (string) preg_replace('~[\\\\/.: *?"<>|+-]~', '-', microtime(true));

        $name_arr = array();

        foreach ($img_arr as $img) {
            $path = $img['path'];
            $file = $img['file'];
            $name = $img['name'];

            if ($file) {
                $filename = pathinfo($file->getClientOriginalName())['filename'];

                $image = Image::make($file)->encode('webp', 90);

                if (!empty($img['big'])) {

                    $image->fit($img['big']['width'], $img['big']['height'], function ($img_size) {
                        $img_size->upsize();
                    });

                    $image->save(public_path($path . $filename . '-'.$date . '.webp',));

                    $name_arr[$name] = $filename . '-'.$date . '.webp';

                }

                if (!empty($img['medium'])) {

                    $image->fit($img['medium']['width'], $img['medium']['height'], function ($img_size) {
                        $img_size->upsize();
                    });

                    $image->save(public_path($path . $filename . '-'.$date . '_medium' . '.webp'));

                    $name_arr[$name . '_medium'] = $filename . '-'.$date . '_medium' . '.webp';
                }


                if (!empty($img['small'])) {

                    $image->fit($img['small']['width'], $img['small']['height'], function ($img_size) {
                        $img_size->upsize();
                    });

                    $image->save(public_path($path . $filename . '-'.$date . '_small' . '.webp'));

                    $name_arr[$name . '_small'] = $filename . '-'.$date . '_small' . '.webp';

                }
            }
        }
        return $name_arr;
    }

    public function update($img_arr, $project_images): array
    {
        $name_arr = array();

        foreach ($img_arr as $img) {

            $path = $img['path'];
            $file = $img['file'];
            $name = $img['name'];

            if (!empty($file)) {
                if (array_key_exists('big', $img) && file_exists($path . $project_images[$name])) {
                    unlink($path . $project_images[$name]);
                }
                if (array_key_exists('medium', $img) && file_exists($path . $project_images[$name . '_medium'])) {
                    unlink($path . $project_images[$name . '_medium']);
                }
                if (array_key_exists('small', $img) && file_exists($path . $project_images[$name . '_small'])) {
                    unlink($path . $project_images[$name . '_small']);
                }
            }
        }
        return $name_arr;
    }

    public function delete($img_arr, $project_images): bool
    {
        $result = false;
        foreach ($img_arr as $img) {

            $path = $img['path'];
            $file = $img['file'];
            $name = $img['name'];

            if (array_key_exists('big', $img) && file_exists($path . $project_images[$name])) {
                unlink($path . $project_images[$name]);
                $result = true;
            }
            if (array_key_exists('medium', $img) && file_exists($path . $project_images[$name . '_medium'])) {
                unlink($path . $project_images[$name . '_medium']);
                $result = true;
            }
            if (array_key_exists('small', $img) && file_exists($path . $project_images[$name . '_small'])) {
                unlink($path . $project_images[$name . '_small']);
                $result = true;
            }
        }
        return $result;
    }
}
