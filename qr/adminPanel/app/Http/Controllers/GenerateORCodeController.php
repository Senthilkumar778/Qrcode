<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use BaconQrCode\Writer\ImageWriter;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Encoder\Encoder;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Writer;

use Imagick;

class GenerateORCodeController extends Controller
{

    public function addQRCode()
    {
        $folderPath = public_path('qrcodes');

        // Check if the folder exists
        if (File::isDirectory($folderPath)) {
            // Get all files in the folder
            $files = File::files($folderPath);
            // Filter image files (you can adjust this as per your requirements)
            $imageFiles = [];
            foreach ($files as $file) {
                $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                    $imageFiles[] =  asset('qrcodes/' . basename($file));
                }
            }
            // Return the list of image files
            $data['images'] = $imageFiles;
        } else {
            $data['images'] = [];
        }
        return view('generateQRCode.add', $data);
    }


    public function listAllQRCode()
    {
        $folderPath = public_path('qrcodes');

        // Check if the folder exists
        if (File::isDirectory($folderPath)) {
            // Get all files in the folder
            $files = File::files($folderPath);
            // Filter image files (you can adjust this as per your requirements)
            $imageFiles = [];
            foreach ($files as $file) {
                $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                    $imageFiles[] =  asset('qrcodes/' . basename($file));
                }
            }
            // Return the list of image files
            $images = $imageFiles;
        } else {
            $images = [];
        }
        $response = [
            "data" => $images,
            "message" => "List all images",
            'status' => "error"
        ];

        return response()->json($response);
    }

    public function generateQRCodeSample(Request $request){
        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new ImagickImageBackEnd()
        );
        $writer = new Writer($renderer);
        $writer->writeFile('Hello World!', 'qrcode.png');
    }


    public function generateQRCode(Request $request, $type)
    {
        // Define the URL to be encoded in the QR code
        $redirectUrl = 'https://qr.aisrv.in/qr';

        if($type == "live"){
            $redirectUrl = 'https://support.kewauneeapps.com/qr/';
        }
        // Define the path to the center image
            $imagePath = public_path('assets/logo/logo3.jpg');
        // $imagePath = public_path('assets/logo/logo2.jpg');
        // $imagePath = public_path('assets/logo/logo1.png');
        // Define the sizes for the QR codes
        // $sizes = [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000];
        $sizes = ['small' => 150, 'medium' => 300, 'large' => 450];
        $centerImageSizes = ['small' => 25, 'medium' => 50, 'large' => 75];

        // Define the directory to save the QR codes
        $directory = public_path('qrcodes');
        // Array to store file paths of generated QR codes
        $filePaths = [];
        $content = 'URL:' . $redirectUrl;
        try {
            // Create directory if it doesn't exist
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true, true);
            }

            // Loop through each size and generate QR code
            // foreach ($sizes as $size) {
            foreach ($sizes as $sizeName => $size) {

                $qrCode = Encoder::encode($content, ErrorCorrectionLevel::valueOf('L'));

                // Get matrix from QR code
                $qrCodeMatrix = $qrCode->getMatrix();

                // Create renderer
                $renderer = new ImageRenderer(
                    new RendererStyle($size),
                    new ImagickImageBackEnd()
                );

                // Render QR code image
                $image = $renderer->render($qrCode);
                $centerImageSize = $centerImageSizes[$sizeName];
                // Overlay center image (if exists)
                if (file_exists($imagePath) && getimagesize($imagePath) !== false) {
                    $image = $this->overlayCenterImage($image, $imagePath, $centerImageSize);
                }

                // Save image to file
                $filename = 'test_qr_code_' . $sizeName . '.png';
                if($type == "live"){
                    $filename = 'qr_code_' . $sizeName . '.png';
                }
                $filePath = $directory . '/' . $filename;
                // $image->setImageFormat('png');
                file_put_contents($filePath, $image);
                $filePaths[] = $filePath;
            }

            // Return success response with file paths
            $response = [
                "data" => $filePaths,
                "message" => 'QR codes generated successfully!',
                'status' => "success"
            ];
        } catch (\Exception $e) {
            // Return error response if an exception occurs
            $response = [
                "data" => [],
                "message" => $e->getMessage(),
                'status' => "error"
            ];
        }
        return response()->json($response);
    }

    // Function to overlay center image on QR code
    // Function to overlay center image on QR code
    // Function to overlay center image on QR code
    private function overlayCenterImage($qrCodeImage, $imagePath, $centerImageSize)
    {
        // Create Imagick objects for both images
        $qrImage = new \Imagick();
        $qrImage->readImageBlob($qrCodeImage);

        // $color = new \ImagickPixel('rgb(255, 0, 0)'); // Red color
        // $qrImage->setImageBackgroundColor($color);

        // Set the image type to TrueColor if needed
        $qrImage->setImageType(\Imagick::IMGTYPE_TRUECOLOR);

        // Ensure the image is in RGB color space
        $qrImage->setImageColorspace(\Imagick::COLORSPACE_RGB);

        // Optionally, set the color depth
        $qrImage->setImageDepth(8);


        $centerImage = new \Imagick($imagePath);
        $centerImage->resizeImage($centerImageSize, $centerImageSize, \Imagick::FILTER_LANCZOS, 1);

        // Get dimensions of the QR code image
        $qrWidth = $qrImage->getImageWidth();
        $qrHeight = $qrImage->getImageHeight();

        // Get dimensions of the center image
        $centerWidth = $centerImage->getImageWidth();
        $centerHeight = $centerImage->getImageHeight();

        // Calculate position to overlay the center image
        $destX = ($qrWidth - $centerWidth) / 2;
        $destY = ($qrHeight - $centerHeight) / 2;

        // Composite the center image onto the QR code image
        $qrImage->compositeImage($centerImage, \Imagick::COMPOSITE_DEFAULT, $destX, $destY);

        // Return the composite image as a binary string
        return $qrImage->getImageBlob();
    }



    public function generateQRCodeOld(Request $request)
    {
        try {
            // $url = 'https://qr.aisrv.in/qr';
            $url = 'https://support.kewaunee.in/qr';
            // Define sizes for each QR code
            $sizes = [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000];
            $directory = public_path('qrcodes');


            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true, true);
            }

            $filePaths = [];
            foreach ($sizes as $size) {
                $filename = 'qr_code_' . $size . 'x' . $size . '.png';
                $filePath = $directory . '/' . $filename;

                // Check if directory is writable
                if (!is_writable($directory)) {
                    throw new Exception("Directory '$directory' is not writable!");
                }

                $filePaths[] = $filePath;
                QrCode::size($size)->generate($url, $filePath);
            }

            $return =array(
                "data" => $filePaths,
                "message" => 'QR code generated successfully!!!',
                'status' => "success"
            );
        } catch(\Exception $e){
            $return =array(
                "data" => "",
                "message" => $e->getMessage(),
                'status' => "error"
            );
        }
        return response()->json($return);
    }

    public function listQRCode(Request $request, $type="live")
    {
        $folderPath = public_path('qrcodes');

        // Check if the folder exists
        if (File::isDirectory($folderPath)) {
            // Get all files in the folder
            $files = File::files($folderPath);
            // Filter image files (you can adjust this as per your requirements)
            $imageFiles = [];
            foreach ($files as $file) {
                $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                    $imageFiles[] =  asset('qrcodes/' . basename($file));
                }
            }
            // Return the list of image files
            $data['images'] = $imageFiles;
        } else {
            $data['images'] = [];
        }
        if($type == "live"){
            return view('generateQRCode.add', $data);
        }else{
            return view('generateQRCode.addTest', $data);
        }
    }


}
