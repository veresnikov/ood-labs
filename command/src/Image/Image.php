<?php
declare(strict_types=1);

namespace App\Image;

use App\Command\ResizeImageCommand;
use App\Document\HistoryInterface;

class Image implements ImageInterface
{
    private const FILENAME_PREFIX = "image_";

    private const DIRECTORY = "images";

    private const AVAILABLE_EXTENSION = ["jpg", "png", "svg"];

    private string $path;

    /**
     * @throws ImageNotExistException
     * @throws InvalidImageTypeException
     */
    public function __construct(string $path, private int $width, private int $height, private HistoryInterface $history)
    {
        if (!file_exists($path)) {
            throw new ImageNotExistException();
        }
        self::AssertExtension($path);

        if (!file_exists(self::DIRECTORY)) {
            if (!mkdir(self::DIRECTORY)) {
                throw new \RuntimeException("Failed create images directory");
            }
        }
        $this->path = self::DIRECTORY . '/' . self::GenerateImageID();
        if (!copy($path, $this->path)) {
            throw new \RuntimeException("Failed to copy file. $path to $this->path");
        }
    }

    public function GetPath(): string
    {
        return $this->path;
    }

    public function GetWidth(): int
    {
        return $this->width;
    }

    public function GetHeight(): int
    {
        return $this->height;
    }

    public function Resize(int $width, int $height): void
    {
        $this->history->Execute(new ResizeImageCommand($this->width, $this->height, $width, $height));
    }

    /**
     * @throws InvalidImageTypeException
     */
    public static function AssertExtension(string $path): void
    {
        foreach (Image::AVAILABLE_EXTENSION as $extension) {
            if (str_contains($path, $extension)) {
                return;
            }
        }
        throw new InvalidImageTypeException();
    }

    public static function GenerateImageID(): string
    {
        return uniqid(Image::FILENAME_PREFIX);
    }
}