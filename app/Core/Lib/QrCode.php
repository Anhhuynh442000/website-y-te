<?php

declare(strict_types=1);

namespace App\Core\Lib;

use App\Core\Helper\Helper;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

class QrCode
{
    public function create(string $content, string $fileName) {
        $helper = new Helper();
        $directory = $helper->getDirectoryUpload();
        $result = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data($content)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(300)
            ->margin(10)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->build();
        $result->saveToFile($directory . 'qr_images/' . $fileName . '.png');
    }
}
