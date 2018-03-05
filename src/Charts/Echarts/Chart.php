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

    public function title(bool $show = true, string $text = '', string $subtext = '', array $optional = [])
    {
        return $this->options([
            'title' => [
                'show' => $show,
                'text' => $text,
                'subtext' => $subtext,
            ]
        ]);
    }

    public function legend(bool $show, string $type = 'plain', array $optional = [])
    {
        return $this->options([
            'legend' => [
                'show' => $show,
                'type' => $type,
                'bottom' => 10
            ]
        ]);
    }

    public function xAxis(bool $show = true, string $type = 'category', string $name = '', array $optional = [])
    {
        return $this->options([
            'xAxis' => [
                'show' => $show,
                'type' => $type,
                'name' => $name
            ]
        ]);
    }

    public function yAxis(bool $show = true, string $type = 'value', string $name = '', array $optional = [])
    {
        return $this->options([
            'yAxis' => [
                'show' => $show,
                'type' => $type,
                'name' => $name
            ]
        ]);
    }

    public function tooltip(bool $show = true, array $optional = [])
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
        return $this;
    }
}