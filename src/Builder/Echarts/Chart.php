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

    public function xAxis(string $name = '', string $type = 'category')
    {
        $this->setOptions([
            'xAxis' => [
                'type' => $type,
                'name' => $name
            ]
        ]);

        return $this;
    }

    public function yAxis(string $name = '', string $type = 'value')
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
     * @param string $trigger
     * @return $this
     */
    public function tooltip(string $trigger = 'item')
    {
        $this->setOptions([
            'tooltip' => [
                'trigger' => $trigger,
                'axisPointer' => [
                    'type' => 'cross',
                    'label' => [
                        'backgroundColor' => '#6a7985'
                    ]
                ]
            ],
        ]);

        return $this;
    }


    /**
     * Set the chart type.
     * @param string|array $type
     * @param array $optional
     * @return $this
     */
    public function series($type = 'line', array $optional = [])
    {
        $temp = [];
        if (is_array($type)) {
            foreach ($type as $key => $value) {
                if (array_key_exists($key, $optional)) {
                    array_push($temp, array_replace_recursive(['type' => $value, 'seriesLayoutBy' => 'row'],
                        $optional[$key]));
                } else {
                    array_push($temp, ['type' => $value, 'seriesLayoutBy' => 'row']);
                }
            }
        } else {
            for ($i = 0; $i < count($this->dataset); $i++) {
                if (count($optional)) {
                    array_push($temp, array_replace_recursive(['type' => $type, 'seriesLayoutBy' => 'row'],
                        $optional));
                } else {
                    array_push($temp, ['type' => $type, 'seriesLayoutBy' => 'row']);
                }

            }
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