<?php

namespace HeFengbao\ECharts\Charts;

use HeFengbao\Charts\BaseChart;

class Chart extends BaseChart
{

    public function __construct()
    {
        parent::__construct();

        $this->container = 'charts::echarts.container';
        $this->script = 'charts::echarts.script';
    }

    public function title(bool $show = true, string $text = '', string $subtext = '')
    {
        return $this->options([
            'title' => [
                'show' => $show,
                'text' => $text,
                'subtext' => $subtext,
            ]
        ]);
    }

    public function legend(bool $show, string $type = 'plain')
    {
        return $this->options([
            'legend' => [
                'show' => $show,
                'type' => $type,
                'bottom' => 10
            ]
        ]);
    }

    public function tooltip(bool $show = true)
    {
        return $this->options([
            'tooltip' => [
                'show' => $show,
            ],
        ]);
    }

    public function dataset($data)
    {
        if ($data instanceof Collection) {
            $data = $data->toArray();
        }
        return $this->dataset = $data;
    }

    public function build()
    {
        $this->title();
        $this->legend();
    }

}