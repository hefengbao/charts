<?php

namespace HeFengbao\Charts\Builder;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;

class BaseChart
{
    /**
     * Stores the chart ID.
     * @var string
     */
    public $id;

    /**
     * Stores the chart theme.
     * @var string
     */
    public $theme = 'default';

    /**
     *Stores the chart DataSet.
     * @var array
     */
    public $dataset = [];

    /**
     *Determines if the loader is show.
     * @var bool
     */
    public $loader = true;

    /**
     * Determines if the loader color.
     *
     * @var string
     */
    public $loaderColor = '#22292F';

    /**
     * Stores the API url if the chart is loaded over API.
     * @var string
     */
    public $api_url = '';

    /**
     * Stores the height of the chart.
     *
     * @var string
     */
    public $height = '400px';

    /**
     * Stores the width of the chart.
     *
     * @var string
     */
    public $width = '100 %';

    /**
     * Stores the chart options.
     * @var array
     */
    public $options = [];

    /**
     * Stores the chart container.
     * @var string
     */
    public $container = '';

    /**
     * Stores the chart script.
     * @var string
     */
    public $script = '';

    /**
     * Stores the available chart letters to create the ID.
     *
     * @var string
     */
    private $chartLetters = 'abcdefghijklmnopqrstuvwxyz';

    public function __construct()
    {
        $this->id = substr(str_shuffle(str_repeat($x = $this->chartLetters, ceil(25 / strlen($x)))), 1, 25);
    }

    /**
     *Set the chart theme.
     * @param string $theme
     * @return $this
     */
    public function theme(string $theme)
    {
        $this->theme = $theme;
        return $this;
    }

    /**
     * Set the Api url.
     *
     * @param string $url
     * @return $this
     */
    public function load(string $url)
    {
        $this->api_url = $url;
        return $this;
    }

    /**
     * Set if show loader.
     * @param bool $loader
     * @return $this
     */
    public function loader(bool $loader)
    {
        $this->loader = $loader;
        return $this;
    }

    /**
     * Set the loader color.
     * @param string $color
     * @return $this
     */
    public function loaderColor(string $color)
    {
        $this->loaderColor = $color;
        return $this;
    }

    /**
     * Chart container.
     * @param string|null $container
     * @return $this
     */
    public function container(string $container = null)
    {
        if (!$container) {
            return View::make($this->container, ['chart' => $this]);
        }

        $this->container = $container;
        return $this;
    }

    /**
     * The height of chart container.
     * @param int $height
     * @return $this
     */
    public function height(int $height)
    {
        $this->height = $height . 'px';
        return $this;
    }

    /**
     * The width of chart container.
     * @param int $width
     * @return $this
     */
    public function width(int $width)
    {
        $this->width = $width . 'px';
        return $this;
    }

    /**
     * @param string|null $script
     * @return $this
     * @throws \Exception
     */
    public function script(string $script = null)
    {
        if (count($this->dataset) == 0 && !$this->api_url) {
            throw new \Exception('No datasets provided, please provide dataset to generate a chart');
        }
        if (!$script) {
            return View::make($this->script, ['chart' => $this]);
        }

        $this->script = $script;

        return $this;
    }

    /**
     * Set chart dataset.
     * @param array|Collection $data
     * @return $this
     */
    public function dataset($data)
    {
        if ($data instanceof Collection) {
            $data = $data->toArray();
        }
        $this->dataset = $data;
        return $this;
    }

    /**
     * Set chart options.
     * @param $options
     * @param bool $overwrite
     * @return array
     */
    protected function setOptions($options, bool $overwrite = false)
    {
        if ($options instanceof Collection) {
            $options = $options->toArray();
        }

        if ($overwrite) {
            $this->options = $options;
        } else {
            $this->options = array_replace_recursive($this->options, $options);
        }

        return $this->options;
    }

    /**
     * @return bool|string
     */
    public function formatOptions()
    {
        return $options = substr(json_encode($this->options), 1, -1);
    }

    /**
     * @return string
     */
    public function formatContainerOptions()
    {
        return 'style="height: ' . $this->height . ';width: ' . $this->width . '"';
    }
}