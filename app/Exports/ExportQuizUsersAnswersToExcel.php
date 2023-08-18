<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Quiz;
use App\Models\QuizUser;

class ExportQuizUsersAnswersToExcel
{
    public $quiz;
    protected $quizUsers;

    public function __construct($quizId)
    {
        $this->quiz = Quiz::find($quizId);
        $this->quizUsers = $this->quiz->quizUser;
    }

    public function generateExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $questions = $this->quiz->questions;

        // Write question names as headers
        $col = 1;
        foreach ($questions as $question) {
            $sheet->setCellValueByColumnAndRow($col, 1, $question->name);
            $col++;
        }

        $row = 2;

        foreach ($this->quizUsers as $quizUser) {
            $col = 1;

            foreach ($questions as $question) {
                $answer = $quizUser->answers->where('question_id', $question->id)->first();

                if ($answer) {
                        $sheet->setCellValueByColumnAndRow($col, $row, $answer->answer);
                }
                $col++;
            }

            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = $this->quiz->slug . '_responses.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
