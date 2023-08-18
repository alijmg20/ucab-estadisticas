<?php
namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizUser;

class ExportQuestionsToExcel
{
    public $quiz;
    protected $questions;
    public function __construct($quiz)
    {
        $this->quiz = Quiz::find($quiz);
        $this->questions = $this->quiz->questions;
    }

    public function generateExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $row = 1;
        $col = 1;

        foreach ($this->questions as $question) {
            $sheet->setCellValueByColumnAndRow($col, $row, $question->name);
            
            foreach ($question->answers as $answers) {
                $row++;
                $sheet->setCellValueByColumnAndRow($col, $row, $answers->answer);
            }
            
            $col++;
            $row = 1;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = $this->quiz->slug.'.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}