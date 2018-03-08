<?php

namespace HeFengbao\Charts\Builder\Echarts;

use HeFengbao\Charts\Builder\BaseChart;

class Chart extends BaseChart
{

    public function __construct()
    {
        parent::__construct();

        $this->container = 'charts::echarts.container';
        $this->script = 'charts::echarts.script';
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

    public function title(string $text = '', string $subtext = '', array $optional = [])
    {
        return $this->setOptions([
            'title' => [
                'text' => $text,
                'subtext' => $subtext,
                'left' => 'middle'
            ]
        ]);
    }

    public function legend(string $type = 'plain', array $optional = [])
    {
        return $this->setOptions([
            'legend' => [
                'type' => $type,
                'bottom' => 10
            ]
        ]);
    }

    public function xAxis(string $type = 'category', string $name = '', array $optional = [])
    {
        return $this->setOptions([
            'xAxis' => [
                'type' => $type,
                'name' => $name
            ]
        ]);
    }

    public function yAxis(string $type = 'value', string $name = '', array $optional = [])
    {
        return $this->setOptions([
            'yAxis' => [
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

    public function formatDatasets()
    {
        $data = [];
        if (count($this->dataset) && count($this->dataset) != count($this->dataset, 1)) {
            $diemensions = [];
            foreach ($this->dataset as $item) {
                $diemensions = array_replace_recursive($diemensions, array_keys($item));
                array_push($data, array_values($item));
            }
            array_unshift($data, $diemensions);
        } else {
            array_push($data, array_keys($this->dataset));
            array_push($data, array_values($this->dataset));
        }

        return json_encode($data);
    }
}