<?php

namespace App\Exports;

use App\Models\Post;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Illuminate\Support\Facades\Response;

class PostsExport
{
    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set column widths
        $sheet->getColumnDimension('A')->setWidth(30);
        $sheet->getColumnDimension('B')->setWidth(50);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(30);
        $sheet->getColumnDimension('E')->setWidth(100); // ✅ Ensure enough space for content

        // Set headers
        $sheet->setCellValue('A1', 'Tiêu đề');
        $sheet->setCellValue('B1', 'Mô tả ngắn');
        $sheet->setCellValue('C1', 'Banner Image');
        $sheet->setCellValue('D1', 'Gallery Images');
        $sheet->setCellValue('E1', 'Nội dung bài viết'); // ✅ Add a new column for content

        // Retrieve posts and populate rows
        $posts = Post::all();
        $row = 2;
        foreach ($posts as $post) {
            $sheet->setCellValue("A$row", $post->title);
            $sheet->setCellValue("B$row", $post->short_description);
            $sheet->setCellValue("E$row", strip_tags($post->content)); // ✅ Ensure content is plain text

            // 🔥 Add the banner image
            if (!empty($post->banner_image)) {
                $bannerPath = storage_path('app/public/' . $post->banner_image);
                if (file_exists($bannerPath)) {
                    $drawing = new Drawing();
                    $drawing->setName('Banner');
                    $drawing->setDescription('Banner Image');
                    $drawing->setPath($bannerPath);
                    $drawing->setHeight(60);
                    $drawing->setCoordinates("C$row");
                    $drawing->setWorksheet($sheet);
                }
            }

            // 🔥 Add gallery images
            $galleryImages = json_decode($post->gallery_images, true);
            if (!empty($galleryImages)) {
                $galleryRow = $row;
                foreach ($galleryImages as $image) {
                    $imagePath = storage_path('app/public/' . $image);
                    if (file_exists($imagePath)) {
                        $drawing = new Drawing();
                        $drawing->setName('Gallery Image');
                        $drawing->setDescription('Gallery Image');
                        $drawing->setPath($imagePath);
                        $drawing->setHeight(60);
                        $drawing->setCoordinates("D$galleryRow");
                        $drawing->setWorksheet($sheet);
                        $galleryRow++;
                    }
                }
            }

            $row++;
        }

        // Create Excel file
        $writer = new Xlsx($spreadsheet);
        $fileName = 'posts.xlsx';
        $filePath = storage_path($fileName);
        $writer->save($filePath);

        return Response::download($filePath)->deleteFileAfterSend(true);
    }
}