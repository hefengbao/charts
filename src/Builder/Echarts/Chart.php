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
        $this->default();
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

    /**
     * Set chart title.
     * See detail http://echarts.baidu.com/option.html#title
     * @param string $text
     * @param string $subtext
     * @return array
     */
    public function title(string $text = '', string $subtext = '')
    {
        return $this->setOptions([
            'title' => [
                'text' => $text,
                'subtext' => $subtext,
                'left' => 'middle'
            ]
        ]);
    }

    /**
     * See more http://echarts.baidu.com/option.html#legend
     * @param string $type
     * @return array
     */
    public function legend(string $type = 'plain')
    {
        return $this->setOptions([
            'legend' => [
                'type' => $type,
                'bottom' => 10
            ]
        ]);
    }

    public function xAxis(string $type = 'category', string $name = '')
    {
        return $this->setOptions([
            'xAxis' => [
                'type' => $type,
                'name' => $name
            ]
        ]);
    }

    public function yAxis(string $type = 'value', string $name = '')
    {
        return $this->setOptions([
            'yAxis' => [
                'type' => $type,
                'name' => $name
            ]
        ]);
    }

    /**
     * @param string $formatter http://echarts.baidu.com/option.html#tooltip.formatter
     * @return array
     */
    public function tooltip(string $formatter = '')
    {
        return $this->setOptions([
            'tooltip' => [
                'show' => true,
                'formatter' => $formatter
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

    /**
     * Set more option.
     * @param string $option Option name.
     * @param array $value Option value.
     * @return $this
     */
    public function option(string $option, array $value)
    {
        $this->options = array_replace_recursive($this->options, $this->setOptions([
            "$option" => $value
        ]));

        return $this;
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