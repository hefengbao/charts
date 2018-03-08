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
     * @return $this
     */
    public function title(string $text = '', string $subtext = '')
    {
        $this->setOptions([
            'title' => [
                'text' => $text,
                'subtext' => $subtext,
                'left' => 'middle'
            ]
        ]);

        return $this;
    }

    /**
     * See more http://echarts.baidu.com/option.html#legend
     * @param string $type
     * @return $this
     */
    public function legend(string $type = 'plain')
    {
        $this->setOptions([
            'legend' => [
                'type' => $type,
                'bottom' => 10
            ]
        ]);

        return $this;
    }

    public function xAxis(string $type = 'category', string $name = '')
    {
        $this->setOptions([
            'xAxis' => [
                'type' => $type,
                'name' => $name
            ]
        ]);

        return $this;
    }

    public function yAxis(string $type = 'value', string $name = '')
    {
        $this->setOptions([
            'yAxis' => [
                'type' => $type,
                'name' => $name
            ]
        ]);

        return $this;
    }

    /**
     * @param string $formatter http://echarts.baidu.com/option.html#tooltip.formatter
     * @return $this
     */
    public function tooltip(string $formatter = '')
    {
        $this->setOptions([
            'tooltip' => [
                'show' => true,
                'formatter' => $formatter
            ],
        ]);

        return $this;
    }


    public function series(array $type = ['line'])
    {
        $temp = [];
        foreach ($type as $value) {
            array_push($temp, ["type" => $value, "seriesLayoutBy" => 'row']);
        }
        $this->setOptions([
            "series" => $temp
        ]);

        return $this;
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

    /**
     * Format Dataset.
     * @return string
     */
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