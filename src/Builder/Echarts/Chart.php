<?php

namespace HeFengbao\Charts\Builder\ECharts;

use HeFengbao\Charts\Builder\BaseChart;

class Chart extends BaseChart
{

    public function __construct()
    {
        parent::__construct();

        $this->container = 'charts::echarts.container';
        $this->script = 'charts::echarts.script';

        $this->default();
    }

    public function title(bool $show = true, string $text = '', string $subtext = '', array $optional = [])
    {
        return $this->setOptions([
            'title' => [
                'show' => $show,
                'text' => $text,
                'subtext' => $subtext,
                'left' => 'middle'
            ]
        ]);
    }

    public function legend(bool $show = true, string $type = 'plain', array $optional = [])
    {
        return $this->setOptions([
            'legend' => [
                'show' => $show,
                'type' => $type,
                'bottom' => 10
            ]
        ]);
    }

    public function xAxis(bool $show = true, string $type = 'category', string $name = '', array $optional = [])
    {
        return $this->setOptions([
            'xAxis' => [
                'show' => $show,
                'type' => $type,
                'name' => $name
            ]
        ]);
    }

    public function yAxis(bool $show = true, string $type = 'value', string $name = '', array $optional = [])
    {
        return $this->setOptions([
            'yAxis' => [
                'show' => $show,
                'type' => $type,
                'name' => $name
            ]
        ]);
    }

    public function tooltip(bool $show = true, array $optional = [])
    {
        return $this->setOptions([
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

    public function series(array $type = ['line'])
    {
        $temp = [];
        foreach ($type as $value) {
            array_push($temp, ["type" => $value, "seriesLayoutBy" => 'row']);
        }
        return $this->setOptions([
            "series" => $temp
        ]);
    }

    private function default()
    {
        $this->title();
        $this->legend();
        $this->xAxis();
        $this->yAxis();
        $this->tooltip();
        $this->series();
    }
}