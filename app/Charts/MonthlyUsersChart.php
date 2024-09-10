<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($application): \ArielMejiaDev\LarapexCharts\PieChart
    {
        
        $question = $application->test->test_result->where('is_correct','1');
        $question_count_easy = $question->pluck('question')->where('difficult', 'Easy')->count();
        $question_count_medium = $question->pluck('question')->where('difficult', 'Medium')->count();
        $question_count_hard = $question->pluck('question')->where('difficult', 'Hard')->count();
        
        // Gunakan data untuk membangun chart
        return $this->chart->pieChart()
            ->setTitle('Difficulties of Answers')
            ->addData([$question_count_easy,$question_count_medium,$question_count_hard])
            ->setLabels(['Mudah','Sedang','Sulit'])
            ->setHeight(260);

    }

    // public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    // {
    //     return $this->chart->pieChart()
    //         ->setTitle('Top 3 scorers of the team.')
    //         ->setSubtitle('Season 2021.')
    //         ->addData([40, 50, 30])
    //         ->setHeight(280)    
    //         ->setLabels(['Player 7', 'Player 10', 'Player 9']);
    // }
}
